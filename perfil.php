<?php
include('config/config.php');
session_start();
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
  header("Location: index.php");
  exit();
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
  echo "Usuario no encontrado.";
  exit();
}

$usuario = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perfil de Usuario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />


  <style>
    .imagen-perfil {
      width: 350px;
      height: 350px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
      border: 5px solid #ffffff;
      transition: transform 0.3s ease;
    }

    .imagen-perfil:hover {
      transform: scale(1.05);
    }

    .tarjeta-info {
      background-color: #e7f1ff;
      border-radius: 15px;
      padding: 1rem 1.5rem;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .tarjeta-info:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card-title {
      color: #0d6efd;
    }

    .badge {
      background-color: #0d6efd !important;
      color: #fff !important;
      font-weight: 500;
      box-shadow: 0 3px 10px rgba(13, 110, 253, 0.2);
    }

    @media (max-width: 768px) {
      .imagen-perfil {
        width: 180px;
        height: 180px;
      }
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
<main class="content">
  <div class="main-content py-5 px-4">
    <div class="card shadow-lg border-0 rounded-5 overflow-hidden w-100">
      <div class="row g-0">
        <!-- Imagen -->
        <div class="col-lg-4 d-flex align-items-center justify-content-center" style="background-color: #dee2e6; min-height: 100%;">
          <img src="imagenesperfil/<?php echo htmlspecialchars($usuario['imagen']); ?>" class="imagen-perfil img-fluid" alt="Foto de perfil">
        </div>

        <!-- Información -->
        <div class="col-lg-8" style="background-color: #f8f9fa;">
          <div class="card-body p-5">
            <h2 class="card-title mb-5 fw-bold text-center text-primary">
              <i class="bi bi-person-circle me-2"></i>Perfil de Usuario
            </h2>

            <div class="row g-4">

              <div class="col-md-6">
                <div class="tarjeta-info h-100">
                  <h5><i class="bi bi-person-fill me-2 text-primary"></i>Nombre y Apellido</h5>
                  <p class="fs-5 text-dark"><?php echo htmlspecialchars($usuario['nombre_apellido']); ?></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="tarjeta-info h-100">
                  <h5><i class="bi bi-envelope-fill me-2 text-primary"></i>Correo Electrónico</h5>
                  <p class="fs-5 text-dark"><?php echo htmlspecialchars($usuario['email_user']); ?></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="tarjeta-info h-100">
                  <h5><i class="bi bi-calendar-date-fill me-2 text-primary"></i>Fecha de Ingreso</h5>
                  <p class="fs-5 text-dark"><?php echo htmlspecialchars($usuario['fecha_registro']); ?></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="tarjeta-info h-100 text-center">
                  <h5><i class="bi bi-award-fill me-2 text-primary"></i>Rol</h5>
                  <span class="badge fs-6 px-4 py-2 rounded-pill">
                    <?php echo ($usuario['id'] == 7) ? 'Administrador' : 'Usuario'; ?>
                  </span>
                </div>
              </div>

              <div class="col-12">
                <a href="acciones/logout.php" class="text-decoration-none">
                  <div class="tarjeta-info text-center" style="background-color: #f8d7da; border: 1px solid #f5c2c7;">
                    <h5 class="text-danger"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</h5>
                    <p class="text-muted">Haz clic para cerrar tu sesión de forma segura.</p>
                  </div>
                </a>
              </div>

            </div>
          </div>
        </div>

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
