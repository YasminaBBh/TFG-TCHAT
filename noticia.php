<?php
include('config/config.php');

if (!isset($_GET['id'])) {
    echo "ID de noticia no especificado.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM noticias WHERE id = $id";
$resultado = $con->query($sql);

if ($resultado->num_rows == 0) {
    echo "Noticia no encontrada.";
    exit;
}

$noticia = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($noticia['titulo']) ?></title>

  <!-- Bootstrap CSS e íconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />

  <style>
    body {
      background-color: #f8f9fa;
    }

    .main-content {
      margin-left: 10px;
      padding: 3rem;
      width: calc(100% - 10px);
      min-height: 100%;
      overflow-x: hidden;
    }

    .article-box {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.05);
      font-family: Georgia, 'Times New Roman', serif;
    }

    .article-box h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 1rem;
      color: #003366;
    }

    .article-date {
      text-align: center;
      color: #777;
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
    }

    .article-content {
      display: flex;
      flex-direction: row;
      gap: 2rem;
    }

    .article-content img {
      width: 50%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }

    .article-text {
      flex: 1;
      font-size: 1.05rem;
      line-height: 1.7;
      color: #333;
    }

    .volver-btn {
      text-align: center;
      margin-top: 2rem;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 1rem;
        padding-bottom: 3rem;
        width: 100%;
      }

      .sidebar {
        display: none;
      }

      .article-content {
        flex-direction: column;
      }

      .article-content img {
        width: 100%;
        max-height: 300px;
      }

      .article-text {
        font-size: 1rem;
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
<main class="main-content">
  <div class="article-box">
    <h1><?= htmlspecialchars($noticia['titulo']) ?></h1>
    <div class="article-date"><?= date('d/m/Y', strtotime($noticia['fecha'])) ?></div>

    <div class="article-content">
      <img src="<?= htmlspecialchars($noticia['imagen_url']) ?>" alt="Imagen de la noticia">
      <div class="article-text">
        <?= nl2br(htmlspecialchars($noticia['contenido'])) ?>
      </div>
    </div>

    <div class="volver-btn">
      <a href="panel.php" class="btn btn-secondary mt-4">← Volver al inicio</a>
    </div>
  </div>
</main>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/sidebar.js"></script>
<script src="assets/js/theme.js"></script>
<script src="/assets/js/dislexia.js"></script>

</body>
</html>
