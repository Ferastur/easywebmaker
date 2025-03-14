<?php
header('Content-Type: application/json');

// Comprobar que se ha enviado una URL
if (!isset($_GET['url']) || empty($_GET['url'])) {
    echo json_encode(['error' => 'No se proporcionó URL']);
    exit;
}

$url = $_GET['url'];

// Validar la URL
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    echo json_encode(['error' => 'URL inválida']);
    exit;
}

// Intentamos obtener el contenido de la URL
$content = @file_get_contents($url);
if ($content === false) {
    echo json_encode(['error' => 'No se pudo obtener el contenido de la URL']);
    exit;
}

// Cargar el HTML usando DOMDocument (suprimir errores de parsing)
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($content);
libxml_clear_errors();

// Función para obtener el innerHTML de un nodo
function innerHTML($node) {
    $html = "";
    foreach ($node->childNodes as $child) {
        $html .= $node->ownerDocument->saveHTML($child);
    }
    return $html;
}

// Extraer elementos de la estructura
$tags = ['header', 'nav', 'main', 'aside', 'footer'];
$result = [];
foreach ($tags as $tag) {
    $nodes = $doc->getElementsByTagName($tag);
    if ($nodes->length > 0) {
        $result[$tag] = innerHTML($nodes->item(0));
    } else {
        $result[$tag] = "";
    }
}

// Extraer CSS: se recogen estilos en <style> y hojas externas
$cssContent = "";

// Estilos en etiquetas <style>
$styleTags = $doc->getElementsByTagName('style');
foreach ($styleTags as $style) {
    $cssContent .= $style->nodeValue . "\n";
}

// Hojas de estilo externas (<link rel="stylesheet">)
$linkTags = $doc->getElementsByTagName('link');
$parsedUrl = parse_url($url);
$baseUrl = $parsedUrl['scheme'] . "://" . $parsedUrl['host'];
foreach ($linkTags as $link) {
    if (strtolower($link->getAttribute('rel')) === 'stylesheet') {
        $href = $link->getAttribute('href');
        if (strpos($href, 'http') !== 0) {
            $href = rtrim($baseUrl, '/') . '/' . ltrim($href, '/');
        }
        $cssData = @file_get_contents($href);
        if ($cssData !== false) {
            $cssContent .= $cssData . "\n";
        }
    }
}
$result['css'] = $cssContent;

echo json_encode($result);
?>

