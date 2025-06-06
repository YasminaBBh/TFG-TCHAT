<?php

session_start();
header("Content-Type: text/html;charset=utf-8");

include('config/config.php');

if (isset($_SESSION['email_user']) != "") {
  $email_user   = $_SESSION['email_user'];
  $imgPerfil    = $_SESSION['imagen'];
  $idConectado  = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TCHAT</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <link rel="stylesheet" href="assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/addUsers.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />
</head>

<body>
  <!-- Sidebar de navegación -->
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

  <main class="w-100">
    <header class="p-3 text-center">
      <div class="d-flex justify-content-between align-items-center">
        <a href="home.php" class="btn btn-back ms-3">
          <i class="bi bi-arrow-left"></i> Volver a inicio
        </a>
        <h2 class="mb-0 flex-grow-1 text-center">Enviar solicitudes de amistad</h2>
      </div>
    </header>
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
      <div class="card-form w-100" style="max-width: 450px;">
        <form id="friendRequestForm" method="POST" action="send_friend_request.php">
          <input type="hidden" name="userId" value="<?php echo $idConectado; ?>">

          <div class="mb-3">
            <label for="friendEmail" class="form-label">Correo electrónico del destinatario</label>
            <input type="email" class="form-control" id="friendEmail" name="friendEmail" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Mensaje (opcional)</label>
            <textarea class="form-control" id="message" name="message" rows="3" maxlength="255"></textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100">Enviar Solicitud</button>
        </form>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebar.js"></script>
  <script src="assets/js/jquery-3.7.1.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/dislexia.js"></script>

  <script>
    $(document).ready(function() {
      $('#friendRequestForm').on('submit', function(e) {
        e.preventDefault();

        const data = {
          email: $('#friendEmail').val(),
          message: $('#message').val()
        };

        $.ajax({
          type: 'POST',
          url: 'acciones/sendFriendRequest.php',
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function(response) {
            if (response.success) {
              alert('Solicitud de amistad enviada correctamente.');
              $('#friendRequestForm')[0].reset();
            } else {
              alert('Error al enviar la solicitud: ' + response.error);
            }
          },
          error: function(xhr, status, error) {
            alert('Error en la solicitud: ' + error);
          }
        });
      });
    });
  </script>
</body>
</html>

<?php
} else {
  echo '<script type="text/javascript">
    alert("Debe Iniciar Sesión");
    window.location.assign("index.php");
  </script>';
}
?>
