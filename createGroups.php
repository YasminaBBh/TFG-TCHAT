<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include('config/config.php');

if (isset($_SESSION['email_user']) && $_SESSION['email_user'] != "") {
  $email_user   = $_SESSION['email_user'];
  $imgPerfil    = $_SESSION['imagen'];
  $idConectado  = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TCHAT - Crear Grupo</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />

  <style>
    body {
      background-color: #e9f1fb;
    }

    header {
      background-color: #0d6efd;
      color: white;
    }

    .btn-back {
      background-color: white;
      color: #0d6efd;
      border: none;
    }

    .btn-back:hover {
      background-color: #e2e6ea;
    }

    .card-form {
      background: white;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .card-form:hover {
      transform: scale(1.01);
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    }

    label {
      font-weight: 500;
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
      <a href="accesiblidades.php" class="nav-link"><i class="bi bi-universal-access fs-3"></i> <span class="link-text">Accesibilidades</span></a>
      <a href="ajustes.php" class="nav-link"><i class="bi bi-gear fs-3"></i> <span class="link-text">Ajustes</span></a>
      <a href="perfil.php" class="nav-link"><i class="bi bi-person-circle fs-3"></i> <span class="link-text">Perfil</span></a>
    </nav>
  </aside>

  <!-- Contenido principal -->
  <main class="w-100">
    <header class="p-3 text-center">
      <div class="d-flex justify-content-between align-items-center">
        <a href="home.php" class="btn btn-back ms-3">
          <i class="bi bi-arrow-left"></i> Volver a inicio
        </a>
        <h2 class="mb-0 flex-grow-1 text-center">Crear Grupo</h2>
      </div>
    </header>

    <div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
      <div class="card-form w-100" style="max-width: 500px;">
        <form id="createGroupForm" method="POST" action="process_create_group.php">
          <input type="hidden" name="userId" value="<?php echo $idConectado; ?>">

          <div class="mb-3">
            <label for="groupName" class="form-label">Nombre del grupo</label>
            <input type="text" class="form-control" id="groupName" name="groupName" required>
          </div>

          <div class="mb-3">
            <label for="groupDescription" class="form-label">Descripción</label>
            <textarea class="form-control" id="groupDescription" name="groupDescription" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="groupContacts" class="form-label">Añadir contactos</label>
            <select class="form-select" id="groupContacts" name="groupContacts[]" multiple required>
              <!-- Opciones cargadas dinámicamente -->
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100">Crear Grupo</button>
        </form>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebar.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="/assets/js/dislexia.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      fetch('fetch_contacts.php')
        .then(response => response.text())
        .then(data => {
          document.getElementById('groupContacts').innerHTML = data;
        })
        .catch(error => {
          console.error('Error al cargar los contactos:', error);
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
