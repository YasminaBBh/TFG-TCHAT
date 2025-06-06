<?php 
include('config/config.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sidebar Extensible</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />

  <style>
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      
    }

    .carousel-item img {
      object-fit: cover;
      height: 50vh;
    }

    .card-img-top {
      height: 180px;
      object-fit: cover;
    }

    .section-title {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      font-size: 2rem;
      font-weight: 700;
      color: white;
      position: relative;
      text-transform: uppercase;
    }

    .section-title::before,
    .section-title::after {
      content: "";
      flex: 1;
      border-bottom: 2px dashed #bbb;
      margin: 0 1rem;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-size: 70% 70%;
      border-radius: 50%;
      filter: invert(1);
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
    }

    #carouselNoticias {
      position: relative;
    }

    #carouselNoticias .carousel-control-prev,
    #carouselNoticias .carousel-control-next {
      top: 50%;
      transform: translateY(-50%);
      width: 48px;
      height: 48px;
      border-radius: 50%;
      z-index: 100;
      opacity: 1;
    }

    #carouselNoticias .carousel-control-prev {
      left: -60px;
    }

    #carouselNoticias .carousel-control-next {
      right: -60px;
    }

    @media (max-width: 768px) {
      .carousel-item img {
        height: 30vh;
      }
    }
    .card.bg-dark-custom {
  background-color: #121212 !important;
  color: white;
}

.card.bg-dark-custom .card-title,
.card.bg-dark-custom .card-text {
  color: white;
}

.card.bg-dark-custom .btn-outline-primary {
  border-color: blue;
  color: blue;
}

.card.bg-dark-custom .btn-outline-primary:hover {
  background-color: #ffffff;
  color: #121212;
}


  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar collapsed d-flex flex-column" role="complementary">
    <nav class="nav flex-column">
      <a href="#" class="nav-link toggle-btn d-flex justify-content-start" id="sidebar-button">
        <i class="bi bi-chevron-right fs-3"></i>
      </a>
      <a href="home.php" class="nav-link"><i class="bi bi-chat fs-3"></i> <span class="link-text">Chat</span></a>
      <a href="panel.php" class="nav-link"><i class="bi bi-megaphone fs-3"></i> <span class="link-text">Tablón de anuncios</span></a>
      <a href="calendario.php" class="nav-link"><i class="bi bi-calendar-event fs-3"></i> <span class="link-text">Calendario</span></a>
    </nav>
    <nav class="nav flex-column mt-auto">
      <a href="accesiblidades.php" class="nav-link"><i class="bi bi-universal-access fs-3"></i> <span class="link-text">Tema</span></a>
      <a href="ajustes.php" class="nav-link"><i class="bi bi-gear fs-3"></i> <span class="link-text">Ajustes</span></a>
      <a href="perfil.php" class="nav-link"><i class="bi bi-person-circle fs-3"></i> <span class="link-text">Perfil</span></a>
    </nav>
  </aside>

  <!-- Contenido principal -->
  <main class="content">
    <div class="main-content">

      <!-- Carrusel principal -->
      <div id="carruselCentro" class="carousel slide mb-4 position-relative" data-bs-ride="carousel">
  <!-- Texto encima del carrusel -->
  <div class="position-absolute top-50 start-50 translate-middle text-white text-center z-3 w-100">
    <h2 class="fw-bold text-shadow bg-dark bg-opacity-50 d-inline-block px-4 py-2 rounded">
      Noticias Francisco de Goya
    </h2>
  </div>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/assets/img/FondoIESGoyaVistaArea.png" class="d-block w-100" alt="Imagen 1">
    </div>
    <div class="carousel-item">
      <img src="/assets/img/goya pared.jpg" class="d-block w-100" alt="Imagen 2">
    </div>
    <div class="carousel-item">
      <img src="/assets/img/goya patio.jpg" class="d-block w-100" alt="Imagen 3">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carruselCentro" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carruselCentro" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>


      <!-- Noticias -->
      <section id="noticias" class="py-5">
        <h2 class="section-title mb-5 text-primary"><span>Últimas noticias</span></h2>
        <div class="container">
          

          <!-- Carrusel escritorio -->
          <div id="carouselNoticias" class="carousel slide position-relative d-none d-md-block" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $sql = "SELECT * FROM noticias ORDER BY fecha DESC";
    $resultado = $con->query($sql);
    $noticias = [];
    while ($fila = $resultado->fetch_assoc()) {
      $noticias[] = $fila;
    }
    $grupo = array_chunk($noticias, 3);
    foreach ($grupo as $index => $bloque) {
      echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '"><div class="row g-4">';
      foreach ($bloque as $noticia) {
        $id = $noticia['id'];
        $titulo = htmlspecialchars($noticia['titulo']);
        $imagen = htmlspecialchars($noticia['imagen_url']);
        $contenido = substr(strip_tags($noticia['contenido']), 0, 100) . "...";
        echo '
        <div class="col-md-4">
          <div class="card bg-white h-100 shadow-sm border-0 rounded-4 overflow-hidden">
            <img src="' . $imagen . '" class="card-img-top" alt="Noticia" style="object-fit: cover; height: 200px;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold">' . $titulo . '</h5>
              <p class="card-text small">' . $contenido . '</p>
              <a href="noticia.php?id=' . $id . '" class="btn btn-primary mt-auto rounded-pill">Leer más</a>
            </div>
          </div>
        </div>';
      }
      echo '</div></div>';
    }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselNoticias" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselNoticias" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>


          <!-- Noticias lista en móvil -->
          <div class="d-block d-md-none mt-4">
            <div class="row g-4">
              <?php
              foreach ($noticias as $noticia) {
                $id = $noticia['id'];
                $titulo = htmlspecialchars($noticia['titulo']);
                $imagen = htmlspecialchars($noticia['imagen_url']);
                $contenido = substr(strip_tags($noticia['contenido']), 0, 100) . "...";
                echo '<div class="col-12">
        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
          <img src="' . $imagen . '" class="card-img-top" alt="Noticia">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-primary fw-bold">' . $titulo . '</h5>
            <p class="card-text text-muted small">' . $contenido . '</p>
            <a href="noticia.php?id=' . $id . '" class="btn btn-primary mt-auto rounded-pill">Leer más</a>
          </div>
        </div>
      </div>';

              }
              ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Accesos rápidos -->
      
      <section class="py-5"> 
  <h2 class="section-title mb-5 text-primary"><span>Accesos rápidos</span></h2>
  <div class="container">
   
    <div class="row text-center">
      <?php
      $sql = "SELECT * FROM accesos";
      $res = $con->query($sql);
      while ($fila = $res->fetch_assoc()) {
        $titulo = htmlspecialchars($fila['titulo']);
        $desc = htmlspecialchars($fila['descripcion']);
        $img = htmlspecialchars($fila['imagen_url']);
        $link = trim($fila['enlace']);

        echo '<div class="col-md-4 mb-5">';
        echo '  <img src="' . $img . '" alt="' . $titulo . '" class="rounded-circle mb-3 shadow" style="width: 140px; height: 140px; object-fit: cover;">';
        echo '  <h4 class="fw-bold">' . $titulo . '</h4>';
        echo '  <p class="text-muted">' . $desc . '</p>';
        if (!empty($link)) {
          echo '  <a href="' . $link . '" class="btn btn-secondary" target="_blank">Ver más</a>';
        }
        echo '</div>';
      }
      $con->close();
      ?>
    </div>
  </div>
  </section>
  <section class="py-5">
        <h2 class="section-title mb-5 text-primary"><span>Accesos rápidos</span></h2>
        <div class="container">
          
          <div class="row text-center g-4">
            <div class="col-md-4">
              <a href="instituto.php" class="text-decoration-none text-dark">
                <i class="bi bi-map text-black-50" style="font-size: 2.5rem;"></i>
                <h5 class="mt-2 text-primary fw-bold">Instituto</h5>
                <p>Historia, estatutos y documentación oficial</p>
              </a>
            </div>
            <div class="col-md-4">
              <a href="departamentos.php" class="text-decoration-none text-dark">
                <i class="bi bi-briefcase text-black-50" style="font-size: 2.5rem;"></i>
                <h5 class="mt-2 text-primary fw-bold">Departamentos</h5>
                <p>Accede a los distintos departamentos</p>
              </a>
            </div>
            <div class="col-md-4">
              <a href="contacto.php" class="text-decoration-none text-dark">
                <i class="bi bi-headset text-black-50" style="font-size: 2.5rem;"></i>
                <h5 class="mt-2 text-primary fw-bold">Contacto</h5>
                <p>Información de contacto</p>
              </a>
            </div>
            <div class="col-md-4">
              <a href="oferta-formativa.php" class="text-decoration-none text-dark">
                <i class="bi bi-journal-text text-black-50" style="font-size: 2.5rem;"></i>
                <h5 class="mt-2 text-primary fw-bold">Oferta Formativa</h5>
                <p>Descubre nuestra oferta formativa</p>
              </a>
            </div>
            <div class="col-md-4">
              <a href="noticias.php" class="text-decoration-none text-dark">
                <i class="bi bi-info-circle text-black-50" style="font-size: 2.5rem;"></i>
                <h5 class="mt-2 text-primary fw-bold">Últimas Noticias</h5>
                <p>Noticias sobre el centro y su actualidad</p>
              </a>
            </div>
            <div class="col-md-4">
              <a href="galeria.php" class="text-decoration-none text-dark">
                <i class="bi bi-camera text-black-50" style="font-size: 2.5rem;"></i>
                <h5 class="mt-2 text-primary fw-bold">Galería de Fotos</h5>
                <p>Fotografías de eventos, profesorado y alumnos</p>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section class="bg-light py-4 text-dark">
  <div class="container text-center">
    <h4 class="fw-bold">Descubre la web del IES Francisco de Goya</h4>
    <p>Bienvenido a la página web del Instituto de Enseñanza Secundaria Francisco de Goya.</p>
    <p>Calle del Luchador, 77 (30.500 – Molina de Segura) Murcia – España.  
      <span class="d-block d-md-inline">968 643439</span>  
      <span class="d-block d-md-inline ms-md-3">968 644603</span>
    </p>
  </div>
</section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/sidebar.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/dislexia.js"></script>

</body>
</html>
