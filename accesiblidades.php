<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Accesibilidad</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=OpenDyslexic&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/accesibilidad.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />
</head>
<body>

<!-- Sidebar de navegación lateral -->
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
    <a href="accesiblidades.php" class="nav-link"><i class="bi bi-universal-access fs-3"></i> <span class="link-text">Accesibilidades</span></a>
    <a href="ajustes.php" class="nav-link"><i class="bi bi-gear fs-3"></i> <span class="link-text">Ajustes</span></a>
    <a href="perfil.php" class="nav-link"><i class="bi bi-person-circle fs-3"></i> <span class="link-text">Perfil</span></a>
  </nav>
</aside>

<!-- Contenido principal de la página -->
<main class="content">
  <div class="main-content py-5 px-4">
    <div class="container text-center">
      <h1 class="mb-5 text-primary">Opciones de Accesibilidad</h1>
      <div class="d-flex flex-column flex-md-row justify-content-center gap-4">
        
        <button class="btn btn-dark btn-acceso" id="toggle-dark">
          <i class="bi bi-moon-stars-fill me-2"></i> Activar / Desactivar Modo Oscuro
        </button>
        <button class="btn btn-primary btn-acceso" id="toggle-dyslexia">
          <i class="bi bi-type me-2"></i> Activar / Desactivar Fuente Disléxica
        </button>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/sidebar.js"></script>
<script src="assets/js/theme.js"></script>
<script src="assets/js/dislexia.js"></script>

</body>
</html>
