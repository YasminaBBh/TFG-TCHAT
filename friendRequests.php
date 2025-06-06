<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include('./config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $email_user    = $_SESSION['email_user'];
  $imgPerfil    = $_SESSION['imagen'];
  $idConectado  = $_SESSION['id'];
?>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TCHAT</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Tu CSS personalizado -->
  <link rel="stylesheet" href="assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />

  <style>
    header {
      background-color: #0d6efd;
      color: white;
    }
    .dark-mode .header{
      background-color: #222 !important;
      color: #f1f1f1;
    }
    .btn-back {
      background: white;
      color: #0d6efd;
      border: none;
    }

    .btn-back:hover {
      background: #e0e0e0;
    }

    .user-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #0d6efd;
    }

    .friend-card {
      border: 1px solid #dee2e6;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .friend-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .friend-actions {
      display: flex;
      gap: 10px;
    }
  </style>
</head>

<body>
  <!-- Sidebar lateral -->
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
        <h2 class="mb-0 flex-grow-1 text-center">Solicitudes de amistad</h2>
      </div>
    </header>

    <div class="container mt-4">
      <div class="row">
        <div class="col" id="pendingRequests">
          Cargando solicitudes de amistad...
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebar.js"></script>
  <script type="text/javascript" src="assets/js/jquery-3.7.1.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch('acciones/fetchFriendRequests.php')
        .then(response => response.text())
        .then(data => {
          document.getElementById('pendingRequests').innerHTML = data;
        })
        .catch(error => {
          console.error('Error al cargar las solicitudes de amistad:', error);
        });
    });

    function acceptRequest(requesterId) {
      $.ajax({
        url: 'acciones/acceptFriendRequest.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ requesterId: requesterId }),
        dataType: 'json',
        success: function (data) {
          if (data.success) {
            $(`div[data-id="${requesterId}"]`).remove();
          } else {
            console.error('Error al aceptar la solicitud:', data.error);
            alert('Error al aceptar la solicitud: ' + data.error);
          }
        },
        error: function (xhr, status, error) {
          console.error('Error en la petición:', error);
        }
      });
    }

    function rejectRequest(requesterId) {
      fetch('acciones/rejectFriendRequest.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ requesterId: requesterId })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            document.querySelector(`div[data-id="${requesterId}"]`).remove();
          } else {
            console.error('Error al rechazar la solicitud:', data.error);
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html>
<?php
} else {
  echo '<script type="text/javascript">
    alert("Debe Iniciar Sesion");
    window.location.assign("index.php");
  </script>';
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/sidebar.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/dislexia.js"></script>
  

