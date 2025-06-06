<?php
session_start();
header("Content-Type: text/html;charset=utf-8");

// Si el usuario ya inició sesión, redirigir al panel
if (isset($_SESSION['email_user']) != "") {
  header("Location:panel.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Configuración del documento -->
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Chat - WhatApp, una sala para compartir mensajes, audios, imágenes, videos entre muchas cosas más.">
  <meta name="author" content="URIAN VIERA">
  <meta name="keyword" content="Web Developer Urian Viera">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon y título -->
  <link rel="shortcut icon" type="image/png" href="" />
  <title>Tchat - Login</title>

  <!-- Hojas de estilo -->
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/loader.css">
  <link rel="stylesheet" href="assets/css/picnic.min.css">

  <!-- Estilos internos personalizados -->
  <style type="text/css" media="screen">
    .miniprofile {
      border-radius: 50%;         /* Imagen circular */
      margin: 0 auto;             /* Centrado horizontal */
      width: 60%;                 /* Ancho proporcional */
      padding-bottom: 60%;        /* Altura proporcional */
    }

    .group label {
      color: #cecece;
      font-size: 13px;
    }

    #forgot {
      display: none;
    }
  </style>
</head>

<body>
  <section class="mi_wallper">
    
    <!-- Imagen de fondo -->
    <img src="../assets/img/FondoIESGoyaVistaArea.png" alt="Imagen 100x100">

    <!-- Efecto de carga -->
    <div id="demo-content">
      <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
      </div>
      <div id="content"></div>
    </div>

    <!-- Formulario de inicio de sesión -->
    <div class="login-box" id="login">
      <p style="text-align: center; font-weight:600">INICIA SESIÓN<hr></p>
      <div id="espacio"></div>

      <form class="form-login" action="acciones/login.php" method="POST" autocomplete="off">
        <div class="group">
          <input type="text" name="email_user" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Email</label>
        </div>
        <div class="group">
          <input type="password" name="password" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Clave</label>
        </div>
        <div class="group" style="display:flex;">
          <button id="enviar" type="submit">Ingresar</button>
        </div>
      </form>

      <!-- Enlace para cambiar al formulario de registro -->
      <div class="group">
        <a style="float: right;" id="mostrar">Crear Cuenta. .!</a>
      </div>
      <br>
    </div>

    <!-- Formulario de registro de usuario -->
    <div class="login-box" id="registrar">
      
      <!-- Formulario de recuperación de contraseña -->
      <div class="login-box" id="forgot" style="display:none;">
        <p style="text-align:center; font-weight:600">RECUPERAR CONTRASEÑA<hr></p>

        <form class="form-login" action="acciones/recuperar_contrasena.php" method="POST" autocomplete="off">
          <div class="group">
            <input type="text" name="nombre_completo" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Nombre Completo</label>
          </div>
          <div class="group">
            <input type="email" name="email_user" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Email</label>
          </div>
          <div class="group" style="display:flex; justify-content:flex-end; margin-top:20px;">
            <button type="submit">Enviar enlace de restablecimiento</button>
          </div>
          <div class="group" style="margin-top:10px;">
            <a href="javascript:void(0)" id="back-to-login" style="float:right; font-size:13px;">Volver al login</a>
          </div>
        </form>
      </div>

      <!-- Título del formulario de registro -->
      <p style="text-align: center; font-weight:600">CREA TU CUENTA AHORA!</p>
      <div id="espacio"></div>

      <!-- Formulario de registro -->
      <form class="form-login" action="acciones/RegistrarUsuario.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="group">
          <input type="text" name="nombre_apellido" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Nombre y Apellido</label>
        </div>
        <div class="group">
          <input type="text" name="email_user" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Email</label>
        </div>
        <div class="group">
          <input type="password" name="password" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Clave</label>
        </div>

        <!-- Imagen de perfil -->
        <div style="width: 150px; margin: 0 auto;">
          <label class="dropimage miniprofile">
            <input type="file" name="imagenPerfil" title="Elegir imagen" required="required" accept="image/*">
          </label>
        </div>

        <!-- Botón de registro -->
        <div class="group" style="display: flex; margin-top:30px;">
          <button type="submit">Crear Cuenta</button>
        </div>

        <!-- Enlace para volver al login -->
        <a style="float: right;" id="formlogin">Volver</a>
      </form>
    </div>
    
  </section>

  <!-- Scripts JS -->
  <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="/assets/js/login.js"></script>

</body>

</html>
