<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include('config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $email_user    = $_SESSION['email_user'];
  $imgPerfil    = $_SESSION['imagen'];
  $idConectado  = $_SESSION['id'];
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="TCHAT - Tu aplicación de mensajería instantánea para compartir mensajes con tus compañeros de clase.">
    <meta name="author" content="Alejandro y Yasmin">
    <title>TCHAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
    <link rel="stylesheet" src="https://fonts.googleapis.com/css?family=Roboto:400,700,300" />

    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/inputEnviar.css">
    <link rel="stylesheet" href="/assets/css/oscuro.css" />
    <style type="text/css" media="screen">
      .seleccionado {
        background-color: hsl(0, 0%, 90%);
      }

      body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        box-sizing: border-box;
      }

      main {
        transition: margin-left 0.3s ease;
      }

      .sideBar {
        height: auto;
      }
      .friendRequests {
          position:relative ;
          top: -13px;
          right: 22px;
          width: 25px;
          height: 25px;
           z-index: 9999;
        }

      .cabecera{
        height: 70px;
        background-color: #0d6efd;
         color: white;
      }
      .dark-mode .cabecera {
  background-color: #222;
  color: #f1f1f1;
}
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

      
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/sidebar.css" />
    <link rel="stylesheet" href="assets/css/oscuro.css" />
    <link rel="stylesheet" href="assets/css/dislexia.css" />

  </head>

  <body>

    
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
      <div class="container-fluid app p-0">
        <div class="row app-one ps-2 flex-nowrap">
          <!-- Lista de usuarios -->
          <div class="col-md-4 col-lg-3 side p-0 chatList">

          <!-- barra superior-->
           
    <!---->
           <div class="row align-items-center px-3 py-2  text-white cabecera">
  <!-- Botón de solicitudes de amistad -->
  <div class="col-auto d-flex align-items-center">
    <button type="button" class="btn btn-light me-3" id="friendRequests" onclick="window.location.href='friendRequests.php'">
      <i class="bi bi-person-lines-fill fs-4"></i>
    </button>
  </div>

  <!-- Botones de añadir usuario y crear grupo -->
  <div class="col text-end d-flex justify-content-end align-items-center pe-3">
    <button type="button" class="btn btn-light me-2" id="addUser" onclick="window.location.href='addUsers.php'">
      <i class="bi bi-person-plus-fill fs-4"></i>
    </button>
    <button type="button" class="btn btn-light" id="createGroup" onclick="window.location.href='createGroups.php'">
      <i class="bi bi-people-fill fs-4"></i>
    </button>
  </div>
</div>

           


            <div class="row searchBox">
              <div class="col-sm-12 searchBox-inner">
                <div class="form-group has-feedback">
                  <input id="searchText" type="search" class="form-control" name="searchText" placeholder="Buscar" autocomplete="off" />
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row sideBar">
              <div class="col">
                <input type="radio" class="btn-check" name="chatFilter" id="listAll" autocomplete="off" checked>
                <label class="btn btn-primary btn-sm" for="listAll">Todos</label>
                <input type="radio" class="btn-check" name="chatFilter" id="listUsers" autocomplete="off">
                <label class="btn btn-primary btn-sm" for="listUsers">Usuarios</label>
                <input type="radio" class="btn-check" name="chatFilter" id="listGroups" autocomplete="off">
                <label class="btn btn-primary btn-sm" for="listGroups">Grupos</label>
              </div>
            </div>
            <div class="side-one" id="chats"></div>
          </div>
      
          <!-- Chat -->
          <div class="col-md-8 col-lg-9 conversation">
            <div id="capausermsj" style="height: 102vh">
              <img src="assets/img/capa.png" id="capawelcome" class="img-fluid" />
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebar.js"></script>



    <script type="text/javascript" src="assets/js/jquery-3.7.1.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- script de formulario
    <script src="assets/js/fetch_contacts.js" type="text/javascript"></script>
    -->
    <script type="text/javascript">
       $(function() {
        load2();

        function load2() {
          window.setTimeout(function() {
            $.post('users.php', function(data) {
              $('#chats').html(data);
            });
          }, 200);
          window.setTimeout(function() {
            $.post('acciones/friendRequestsCount.php', function(data) {
              $('#friendRequests').parent().append(data);
            });
          }, 200);
        }


        $(function() {
          if ($(".side-one")[0]) {
            users();
          }
          users();

          setInterval(function() {
            if ($(".side-one")[0]) {
              users();
            }
            users();
          }, 10000);

        });

        

        function users() {
          load_data = {
            'fetch': 1
          };
          window.setTimeout(function() {
            $.post('users.php', load_data, function(data) {
              $('#chats').html(data);
            });
          }, 10000);
        }
      });

      // Cada 10 segundos carga el número de solicitudes de amistad
      setInterval(function() {
        $.post('acciones/friendRequestsCount.php', function(data) {
          $('.friendRequests').replaceWith(data);
        });
      }, 10000);
      

      // botones
      const btnUser = document.getElementById('listUsers');
      const btnGroup = document.getElementById('listGroups');
      const btnAll = document.getElementById('listAll');
      const btnAddUser = document.getElementById('addUser');
      const btnCreateGroup = document.getElementById('createGroup');
      

      // sidebar buttons
      const btnFriendRequests = document.getElementById('friendRequests');
      const btnChat = document.getElementById('chatLink');
      const btnAnnouncements = document.getElementById('announcementsLink');
      const btnCalendar = document.getElementById('calendarLink');
      const btnTheme = document.getElementById('btnTheme');
      const btnSettings = document.getElementById('settingsLink');
      const btnProfile = document.getElementById('profileLink');

      // filtro
      const searchInput = document.getElementById('searchText');

      // cuadro de informacion de los botones
    </script>
  <!-- Tooltips -->
  <script src="assets/js/tooltips.js" type="text/javascript"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/dislexia.js"></script>

  </body>

  </html>
<?php } else {
  echo '<script type="text/javascript">
    alert("Debe Iniciar Sesion");
    window.location.assign("index.php");
    </script>';
}
?>