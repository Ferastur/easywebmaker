<?php
if (isset($_POST['generate'])) {
    // Recoger datos del formulario
    $siteTitle       = $_POST['site_title'];
    $metaDescription = $_POST['meta_description'];
    $keywords        = $_POST['keywords'];
    $ogImage         = $_POST['og_image'];
    $headerContent   = $_POST['header_content'];
    $navContent      = $_POST['nav_content'];
    $mainContent     = $_POST['main_content'];
    $sidebarContent  = $_POST['sidebar_content'];
    $footerContent   = $_POST['footer_content'];
    $customCSS       = $_POST['custom_css'];
    $template        = $_POST['template_select'] ?? '';
    $tiendaImages    = $_POST['tienda_images'] ?? '';
    
    // Si se usa la plantilla "tienda" y se han ingresado imágenes, se genera un carrusel
    if ($template === 'tienda' && trim($tiendaImages) !== "") {
        $imageUrls = explode("\n", $tiendaImages);
        $carouselItems = "";
        $i = 0;
        foreach ($imageUrls as $url) {
            $url = trim($url);
            if ($url != "") {
                $activeClass = ($i === 0) ? "active" : "";
                $carouselItems .= '<div class="carousel-item ' . $activeClass . '">
                    <img src="' . htmlspecialchars($url) . '" class="d-block w-100" alt="Producto ' . ($i+1) . '">
                </div>';
                $i++;
            }
        }
        if ($carouselItems !== "") {
            $mainContent = '<div id="tiendaCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">' . $carouselItems . '</div>
                <button class="carousel-control-prev" type="button" data-bs-target="#tiendaCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#tiendaCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </button>
            </div>';
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo htmlspecialchars($siteTitle); ?></title>
      <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
      <meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">
      <!-- Meta tags para Open Graph y Twitter -->
      <meta property="og:title" content="<?php echo htmlspecialchars($siteTitle); ?>">
      <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
      <meta property="og:image" content="<?php echo htmlspecialchars($ogImage); ?>">
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="<?php echo htmlspecialchars($siteTitle); ?>">
      <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
      <meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage); ?>">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Fuente futurista -->
      <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
      <style>
        /* Estilo futurista y oscuro */
        body {
          background-color: #121212;
          color: #e0e0e0;
          font-family: 'Orbitron', sans-serif;
          margin: 0;
          padding: 0;
        }
        header {
          background: linear-gradient(45deg, #1f1f1f, #2c2c2c);
          padding: 20px 0;
          text-align: center;
        }
        header .logo {
          max-height: 80px;
          margin-bottom: 10px;
        }
        header h1 {
          margin: 0;
          font-size: 2.5em;
          color: #00ffcc;
        }
        header .header-extra {
          font-size: 1.1em;
          margin-top: 10px;
          color: #b0b0b0;
        }
        nav {
          background-color: #1a1a1a;
          padding: 10px 0;
          text-align: center;
        }
        nav a {
          color: #00ffcc;
          margin: 0 15px;
          text-decoration: none;
          font-size: 1.1em;
        }
        main {
          padding: 20px;
        }
        aside {
          background-color: #1e1e1e;
          padding: 20px;
        }
        footer {
          background-color: #1a1a1a;
          color: #888;
          text-align: center;
          padding: 15px 0;
          margin-top: 20px;
        }
        <?php echo $customCSS; ?>
      </style>
    </head>
    <body>
      <header>
        <?php if (!empty($ogImage)) { ?>
          <img src="<?php echo htmlspecialchars($ogImage); ?>" alt="Logo" class="logo">
        <?php } ?>
        <h1><?php echo htmlspecialchars($siteTitle); ?></h1>
        <div class="header-extra"><?php echo $headerContent; ?></div>
      </header>
      <nav>
        <?php echo $navContent; ?>
      </nav>
      <div class="container my-4">
        <div class="row">
          <?php
          	if (strlen("".$sidebarContent)>0){
          ?>
          	<main class="col-md-8">
          <?php
			} else {
          ?>
          	<main class="col-md-12">
          <?php
			}
          ?>
          	
            <?php echo $mainContent; ?>
          </main>
          <?php
          	if (strlen("".$sidebarContent)>0){
          ?>
          <aside class="col-md-4">
            <?php echo $sidebarContent; ?>
          </aside>
          <?php
			}
          ?>
        </div>
      </div>
      <footer>
        <?php echo $footerContent; ?>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}
?>
<?php
// Protocolo (http o https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

// Dominio y puerto
$host = $_SERVER['HTTP_HOST'];

// URI (path y parámetros de la URL)
$requestUri = $_SERVER['REQUEST_URI'];

// Generación de la URL completa
$currentUrl = $protocol . '://' . $host . $requestUri;

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Meta básicos -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EasyWebMaker - Crea una web rápidamente</title>
	<meta name="description" content="Crea una web rápidamente con esta herramienta gratuita">
	<meta name="keywords" content="creador web, diseño web, herramienta web gratuita, generador de sitios">
	<meta name="author" content="Ferastur3D">
	<link rel="icon" href="<?php echo $currentUrl;?>logo.png" type="image/x-icon">	
	<!-- Open Graph (Facebook, WhatsApp) -->
	<meta property="og:title" content="EasyWebMaker - Crea tu web en minutos">
	<meta property="og:description" content="Crea una web rápidamente con esta herramienta gratuita. Personaliza el diseño, añade contenido y descárgala fácilmente.">
	<meta property="og:image" content="<?php echo $currentUrl;?>logo.png">
	<meta property="og:image:alt" content="EasyWebMaker Logo">
	<meta property="og:url" content="<?php echo $currentUrl;?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="EasyWebMaker">
	
	<!-- Meta para WhatsApp (Usa Open Graph) -->
	
	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="EasyWebMaker - Genera tu web en minutos">
	<meta name="twitter:description" content="Personaliza y descarga tu web de forma rápida y sencilla con EasyWebMaker.">
	<meta name="twitter:image" content="<?php echo $currentUrl;?>logo.png">
	<meta name="twitter:image:alt" content="EasyWebMaker Logo">
	<meta name="twitter:site" content="@FerasturDJ">
	
	<!-- Meta para dispositivos móviles -->
	<meta name="theme-color" content="#00ffcc">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="EasyWebMaker">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  /* Reseteo de estilos CSS */

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box; /* Asegura que el padding y el borde se incluyan en el tamaño total de los elementos */
}
    body { padding: 20px; }
	.title {
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  gap: 20px; /* Espacio entre la imagen y el H1 */
	}
	
	.title h1 {
	  text-align: center;
	  font-size: 3rem;
	  font-weight: bold;
	  color: #00ffcc;
	  text-transform: uppercase;
	  letter-spacing: 2px;
	  margin: 20px 0;
	  padding: 10px;
	  background: linear-gradient(45deg, #1a1a1a, #2c2c2c);
	  border-radius: 10px;
	  box-shadow: 0px 4px 10px rgba(0, 255, 204, 0.3);
	  font-family: "Orbitron", sans-serif;
	}
	
	.title-logo {
	  max-height: 80px; /* Ajusta el tamaño de la imagen */
	  width: auto;
	  transition: transform 0.5s ease;
	}
	
	.title-logo:hover {
	  transform: scale(1.6); /* Aumenta el tamaño de la imagen al hacer hover */
	}

    .preview-area {
      border: 1px solid #444;
      padding: 15px;
      min-height: 400px;
      margin-top: 20px;
      background-color: #1a1a1a;
      color: #e0e0e0;
    }
    .preview-area header { background: #333; color: #00ffcc; padding: 10px; text-align: center; }
    .preview-area nav { background: #222; padding: 10px; text-align: center; }
    .preview-area footer { background: #222; color: #888; padding: 10px; text-align: center; }
  </style>
</head>
<body>
<main>
  <div class="container">
      <div class="title">
        <img src="logo.png" alt="Logo Easy Web Maker" class="title-logo">
        <h1>Easy Web Maker</h1>
      </div>
    <div class="row">
      <!-- Columna izquierda: formulario (33% de ancho) -->
      <div class="col-md-4">
        <!-- Cargar datos de ejemplo desde una web externa -->
        <div class="mb-3">
          <label for="example_url" class="form-label">URL de Ejemplo</label>
          <input type="text" class="form-control" id="example_url" placeholder="https://ejemplo.com">
          <button type="button" class="btn btn-secondary mt-2" onclick="loadExampleSite()">Cargar Datos de Ejemplo</button>
        </div>
        <form method="post">
          <div class="mb-3">
            <label for="site_title" class="form-label">Título del Sitio</label>
            <input type="text" class="form-control" id="site_title" name="site_title" required>
          </div>
          <div class="mb-3">
            <label for="meta_description" class="form-label">Descripción Meta</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="keywords" class="form-label">Palabras Clave</label>
            <input type="text" class="form-control" id="keywords" name="keywords">
          </div>
          <div class="mb-3">
            <label for="og_image" class="form-label">URL de Imagen para Open Graph (Logo)</label>
            <input type="text" class="form-control" id="og_image" name="og_image">
          </div>
          <!-- Select de plantillas -->
          <div class="mb-3">
            <label for="template_select" class="form-label">Plantilla para Header y Navegación</label>
            <select class="form-select" id="template_select" name="template_select">
              <option value="">-- Sin plantilla --</option>
              <option value="login">Menú de Login</option>
              <option value="blog">Plantilla Blog</option>
              <option value="portfolio">Plantilla Portfolio</option>
              <option value="tienda">Plantilla Tienda Virtual</option>
              <option value="slider">Plantilla Slider</option>
            </select>
          </div>
          <!-- Zona de imágenes para Tienda Virtual -->
          <div class="mb-3" id="tienda_images_container" style="display: none;">
            <label for="tienda_images" class="form-label">Imágenes para Tienda Virtual<br><small>Ingresa una URL por línea</small></label>
            <textarea class="form-control" id="tienda_images" name="tienda_images" rows="3"></textarea>
          </div>
          <hr>
          <div class="mb-3">
            <label for="header_content" class="form-label">Contenido del Header</label>
            <textarea class="form-control" id="header_content" name="header_content" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="nav_content" class="form-label">Contenido de la Navegación</label>
            <textarea class="form-control" id="nav_content" name="nav_content" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="main_content" class="form-label">Contenido Principal (Main)</label>
            <textarea class="form-control" id="main_content" name="main_content" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="sidebar_content" class="form-label">Contenido del Sidebar (Opcional)</label>
            <textarea class="form-control" id="sidebar_content" name="sidebar_content" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="footer_content" class="form-label">Contenido del Footer</label>
            <textarea class="form-control" id="footer_content" name="footer_content" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="custom_css" class="form-label">CSS Personalizado</label>
            <textarea class="form-control" id="custom_css" name="custom_css" rows="4"></textarea>
          </div>
          <button type="submit" name="generate" class="btn btn-success">Generar Sitio Web</button>
        </form>
      </div>
      <!-- Columna derecha: vista previa (67% de ancho) -->
      <div class="col-md-8">
        <h2>Vista Previa</h2>
        <div class="preview-area" id="previewContainer">
          <p class="text-muted">La vista previa en vivo se mostrará aquí mientras escribes.</p>
        </div>
      </div>
    </div>
  </div>
</main>
<footer>
  <div class="footer-container">
    <p>© <? echo date("Y");?> Ferastur3D | Todos los derechos reservados</p>
    <div class="footer-social">
      <a href="https://www.facebook.com/ferastur" class="social-link facebook" target="_blank">Facebook</a>
      <a href="https://x.com/FerasturDJ" class="social-link twitter" target="_blank">X (Twitter)</a>
      <a href="https://www.instagram.com/ferastur3d/" class="social-link instagram" target="_blank">Instagram</a>
      <a href="https://github.com/Ferastur" class="social-link github" target="_blank">GitHub</a>
    </div>
  </div>
</footer>

<style>
  footer {
    background: linear-gradient(45deg, #1a1a1a, #2c2c2c);
    color: #e0e0e0;
    text-align: center;
    padding: 20px 0;
    font-family: "Orbitron", sans-serif;
    position: relative;
    margin-top: 30px;
    box-shadow: 0px -4px 10px rgba(0, 255, 204, 0.3);
  }

  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .footer-container p {
    margin: 0;
    font-size: 1rem;
    color: #888;
  }

  .footer-social {
    margin-top: 10px;
  }

  .social-link {
    color: #00ffcc;
    margin: 0 10px;
    text-decoration: none;
    font-size: 1.1rem;
    transition: color 0.3s ease, transform 0.3s ease;
  }

  .social-link:hover {
    color: #ffffff;
    transform: scale(1.1);
  }

  .social-link.facebook:hover {
    color: #1877f2;
  }

  .social-link.twitter:hover {
    color: #1da1f2;
  }

  .social-link.instagram:hover {
    color: #e4405f;
  }

  .social-link.github:hover {
    color: #ffffff;
  }
</style>

  <!-- Script para actualizar la vista previa, aplicar plantillas y cargar datos externos -->
  <script>
    function updatePreview() {
      var siteTitle      = document.getElementById('site_title').value;
      var headerContent  = document.getElementById('header_content').value;
      var navContent     = document.getElementById('nav_content').value;
      var mainContent    = document.getElementById('main_content').value;
      var sidebarContent = document.getElementById('sidebar_content').value;
      var footerContent  = document.getElementById('footer_content').value;
      var customCSS      = document.getElementById('custom_css').value;

      // Si la plantilla es "tienda", se genera el carrusel usando las imágenes
      if(document.getElementById("template_select").value === "tienda"){
          var imagesField = document.getElementById("tienda_images").value;
          var imagesHTML = "";
          if (imagesField.trim() !== "") {
              var urls = imagesField.split("\n");
              for (var i = 0; i < urls.length; i++) {
                  var activeClass = (i === 0) ? "active" : "";
                  imagesHTML += `<div class="carousel-item ${activeClass}">
                      <img src="${urls[i].trim()}" class="d-block w-100" alt="Producto ${i+1}">
                  </div>`;
              }
          } else {
              imagesHTML = `<div class="carousel-item active">
                  <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Producto 1">
              </div>`;
          }
          mainContent = `<div id="tiendaCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">${imagesHTML}</div>
              <button class="carousel-control-prev" type="button" data-bs-target="#tiendaCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#tiendaCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
              </button>
          </div>`;
      }
      
	let extra = '';

	if (sidebarContent.length > 0) {
	  extra = `
	    <div class="col-md-8">
	      <h2>Contenido Principal</h2>
	      <div>${mainContent || "Contenido principal"}</div>
	    </div>
	    <div class="col-md-4">
	      <h3>Sidebar</h3>
	      <div>${sidebarContent || ""}</div>
	    </div>
	  `;
	} else {
	  extra = `
	    <div class="col-md-12">
	      <div>${mainContent || "Contenido principal"}</div>
	    </div>
	  `;
	}

      var previewHTML = `
      <div>
        <header>
          <h1>${siteTitle || "Título del Sitio"}</h1>
          <div>${headerContent || "Contenido del header"}</div>
        </header>
        <nav>${navContent || "Contenido de la navegación"}</nav>
        <div class="my-3">
          <div class="row">
          	${extra || "<h2>Contenido principal</h2>"}
          </div>
        </div>
        <footer><div>${footerContent || "Contenido del footer"}</div></footer>
      </div>
      <style>${customCSS}</style>
      `;
      document.getElementById('previewContainer').innerHTML = previewHTML;
    }
    
    // Mostrar/ocultar el área de imágenes para la plantilla "tienda"
    document.getElementById("template_select").addEventListener("change", function() {
      var value = this.value;
      document.getElementById("tienda_images_container").style.display = (value === "tienda") ? "block" : "none";
      
      if (value === "login") {
         document.getElementById("header_content").value = `<div class="d-flex justify-content-between align-items-center">
  <div><strong>Mi Sitio Web</strong></div>
  <div>
    <button class="btn btn-outline-light btn-sm">Iniciar Sesión</button>
    <button class="btn btn-light btn-sm">Registrarse</button>
  </div>
</div>`;
         document.getElementById("nav_content").value = `<ul class="nav nav-pills">
  <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Acerca de</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
</ul>`;
         document.getElementById("main_content").value = `<p>Bienvenido a la zona principal. Aquí se muestra el contenido destacado.</p>`;
      } else if (value === "blog") {
         document.getElementById("header_content").value = `<div class="text-center">
  <h1>Mi Blog</h1>
  <p>Historias y reflexiones</p>
</div>`;
         document.getElementById("nav_content").value = `<ul class="nav justify-content-center">
  <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Sobre mí</a></li>
</ul>`;
         document.getElementById("main_content").value = `<article>
  <h2>Entrada Destacada</h2>
  <p>Contenido de la entrada...</p>
</article>`;
      } else if (value === "portfolio") {
         document.getElementById("header_content").value = `<div class="text-center">
  <h1>Portafolio</h1>
  <p>Proyectos y colaboraciones</p>
</div>`;
         document.getElementById("nav_content").value = `<ul class="nav justify-content-center">
  <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Proyectos</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
</ul>`;
         document.getElementById("main_content").value = `<section>
  <h2>Mis Proyectos</h2>
  <p>Descripción y detalles de proyectos...</p>
</section>`;
      } else if (value === "tienda") {
         document.getElementById("header_content").value = `<div class="text-center">
  <h1>Tienda Virtual</h1>
  <p>Productos exclusivos</p>
</div>`;
         document.getElementById("nav_content").value = `<ul class="nav justify-content-center">
  <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Carrito</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
</ul>`;
         document.getElementById("sidebar_content").value = "";
         document.getElementById("footer_content").value = `<div class="text-center">
  <p>&copy; 2025 Tienda Virtual</p>
</div>`;
         updatePreview();
      } else if (value === "slider") {
         document.getElementById("header_content").value = `<div class="text-center">
  <h1>Sitio con Slider</h1>
  <p>Explora nuestras imágenes</p>
</div>`;
         document.getElementById("nav_content").value = `<ul class="nav justify-content-center">
  <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Galería</a></li>
  <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
</ul>`;
         document.getElementById("main_content").value = `<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Imagen 1">
    </div>
    <div class="carousel-item">
      <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Imagen 2">
    </div>
    <div class="carousel-item">
      <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Imagen 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>`;
         document.getElementById("sidebar_content").value = "";
      } else {
         document.getElementById("header_content").value = "";
         document.getElementById("nav_content").value = "";
         document.getElementById("main_content").value = "";
      }
      updatePreview();
    });

    function loadExampleSite() {
      var exampleUrl = document.getElementById('example_url').value;
      if (!exampleUrl) {
        alert("Introduce una URL válida.");
        return;
      }
      fetch('fetch_site.php?url=' + encodeURIComponent(exampleUrl))
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            alert("Error: " + data.error);
            return;
          }
          var externalPreview = `
            <div>
              <header>${data.header || "Header no encontrado"}</header>
              <nav>${data.nav || "Navegación no encontrada"}</nav>
              <main>${data.main || "Contenido principal no encontrado"}</main>
              <aside>${data.aside || ""}</aside>
              <footer>${data.footer || "Footer no encontrado"}</footer>
            </div>
            <style>${data.css || ""}</style>
          `;
          document.getElementById('previewContainer').innerHTML = externalPreview;
        })
        .catch(err => {
          alert("Error al cargar la web: " + err);
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
      var inputs = document.querySelectorAll("input, textarea");
      inputs.forEach(function(input) {
         input.addEventListener("input", updatePreview);
      });
      updatePreview();
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

