<?php
session_start();
include('../config/config.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

$mensaje = '';
$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $contrasena_actual = trim($_POST['actual']);
  $nueva = trim($_POST['nueva']);
  $confirmar = trim($_POST['confirmar']);

  if ($nueva !== $confirmar) {
    $mensaje = '<div class="alert alert-warning">Las contraseñas no coinciden.</div>';
  } else {
    $stmt = $con->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if (password_verify($contrasena_actual, $user['password'])) {
      $hash = password_hash($nueva, PASSWORD_DEFAULT);
      $update = $con->prepare("UPDATE users SET password = ? WHERE id = ?");
      $update->bind_param("si", $hash, $userId);
      $update->execute();
      $mensaje = '<div class="alert alert-success">Contraseña actualizada correctamente.</div>';
    } else {
      $mensaje = '<div class="alert alert-danger">La contraseña actual es incorrecta.</div>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Cambiar Contraseña</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      margin: 0;
      padding: 0;
    }
    main.content {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 1rem;
    }
    .password-card {
      width: 100%;
      max-width: 480px;
      background-color: #f9f9f9;
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      animation: fadeInUp 0.6s ease-out;
      transition: transform 0.3s ease;
    }
    .password-card:hover {
      transform: translateY(-4px);
    }
    .password-card .card-header {
      background: linear-gradient(135deg, #007bff, #3399ff);
      color: #fff;
      text-align: center;
      padding: 1.5rem;
    }
    .password-card .logo {
      width: 50px;
      height: 50px;
    }
    .form-control {
      border-radius: 0.5rem;
    }
    .form-floating label {
      color: #555;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      transition: background-color 0.2s;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .btn-outline-secondary {
      color: #007bff;
      border-color: #007bff;
    }
    .btn-outline-secondary:hover {
      background-color: rgba(0, 123, 255, 0.1);
      color: #0056b3;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 576px) {
      .password-card {
        padding: 1rem;
        border-radius: 0.75rem;
      }
      .card-header {
        padding: 1rem;
      }
      .btn {
        font-size: 1rem;
        padding: 0.75rem;
      }
    }
  </style>
</head>
<body>

<aside id="sidebar" class="sidebar collapsed d-flex flex-column" role="complementary">
  <nav class="nav flex-column">
    <a href="#" class="nav-link toggle-btn d-flex justify-content-start" id="sidebar-button">
      <i class="bi bi-chevron-right fs-3"></i>
    </a>
    <a href="../home.php" class="nav-link"><i class="bi bi-chat fs-3"></i> <span class="link-text">Chat</span></a>
    <a href="../panel.php" class="nav-link"><i class="bi bi-megaphone fs-3"></i> <span class="link-text">Tablón de anuncios</span></a>
    <a href="../calendario.php" class="nav-link"><i class="bi bi-calendar-event fs-3"></i> <span class="link-text">Calendario</span></a>
  </nav>
  <nav class="nav flex-column mt-auto">
    <a href="../accesiblidades.php" class="nav-link"><i class="bi bi-universal-access fs-3"></i> <span class="link-text">Tema</span></a>
    <a href="../ajustes.php" class="nav-link"><i class="bi bi-gear fs-3"></i> <span class="link-text">Ajustes</span></a>
    <a href="../perfil.php" class="nav-link"><i class="bi bi-person-circle fs-3"></i> <span class="link-text">Perfil</span></a>
  </nav>
</aside>

<main class="content">
  <div class="password-card">
    <div class="card-header">
      <img src="/assets/img/lock.webp" alt="Lock" class="logo mb-2">
      <h3>Cambiar tu Contraseña</h3>
    </div>
    <div class="card-body p-4">
      <?php echo $mensaje; ?>
      <form method="POST" novalidate>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="actual" id="actual" placeholder="Contraseña Actual" required>
          <label for="actual">Contraseña Actual</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="nueva" id="nueva" placeholder="Nueva Contraseña" required minlength="6">
          <label for="nueva">Nueva Contraseña</label>
        </div>
        <div class="form-floating mb-4">
          <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Confirmar Contraseña" required>
          <label for="confirmar">Confirmar Contraseña</label>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary btn-lg">Guardar Cambios</button>
          <a href="../ajustes.php" class="btn btn-outline-secondary btn-lg">Volver</a>
        </div>
      </form>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/sidebar.js"></script>
<script src="/assets/js/dislexia.js"></script>
<script src="/assets/js/theme.js"></script>

</body>
</html>
