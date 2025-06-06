<?php
// Iniciar la sesión
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajustes</title>

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=OpenDyslexic&display=swap" rel="stylesheet" />

  
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/ajustes.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />
</head>

<body class="default-font">
 
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

  <main class="content">
    <div class="main-content py-5 px-4">

      <div class="text-center mb-5">
        <h1 class="fw-bold display-5 text-primary">
          <i class="bi bi-sliders2-vertical me-2"></i> Ajustes
        </h1>
        <hr style="width: 80px; height: 4px; background-color: #0d6efd; margin: 0.5rem auto; border: none; border-radius: 2px;">
      </div>

      <div class="row g-4">

        <div class="col-md-6 col-lg-4">
          <a href="../acciones/cambiar_contrasena.php" class="text-decoration-none">
            <div class="ajuste-card p-4 h-100 d-flex flex-column">
              <div class="d-flex align-items-start">
                <i class="bi bi-key-fill ajuste-icon me-3"></i>
                <div>
                  <h5 class="ajuste-title">Cambiar Contraseña</h5>
                  <p class="ajuste-desc">Actualiza tu contraseña regularmente para proteger tu cuenta.</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="ajuste-card p-4 h-100 d-flex flex-column">
            <div class="d-flex align-items-start">
              <i class="bi bi-bell-fill ajuste-icon me-3"></i>
              <div>
                <h5 class="ajuste-title">Notificaciones</h5>
                <p class="ajuste-desc">Gestiona tus preferencias de notificación y alertas del sistema.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="ajuste-card p-4 h-100 d-flex flex-column">
            <div class="d-flex align-items-start">
              <i class="bi bi-palette-fill ajuste-icon me-3"></i>
              <div>
                <h5 class="ajuste-title">Tema de la Interfaz</h5>
                <p class="ajuste-desc">Activa el modo claro u oscuro según tu preferencia visual.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="ajuste-card p-4 h-100 d-flex flex-column">
            <div class="d-flex align-items-start">
              <i class="bi bi-shield-lock-fill ajuste-icon me-3"></i>
              <div>
                <h5 class="ajuste-title">Privacidad</h5>
                <p class="ajuste-desc">Revisa quién puede ver tu información y controla el acceso.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="ajuste-card p-4 h-100 d-flex flex-column">
            <div class="d-flex align-items-start">
              <i class="bi bi-translate ajuste-icon me-3"></i>
              <div>
                <h5 class="ajuste-title">Idioma</h5>
                <p class="ajuste-desc">Selecciona el idioma preferido para la interfaz del sistema.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <a href="acciones/logout.php" class="text-decoration-none">
            <div class="ajuste-card p-4 h-100 d-flex flex-column justify-content-center text-center">
              <i class="bi bi-box-arrow-right ajuste-icon mb-2"></i>
              <h5 class="ajuste-title">Cerrar Sesión</h5>
              <p class="ajuste-desc">Haz clic para cerrar tu sesión de forma segura.</p>
            </div>
          </a>
        </div>

      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script src="assets/js/theme.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/sidebar.js"></script>
  <script src="/assets/js/dislexia.js"></script>
</body>
</html>
