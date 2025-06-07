<?php
session_start();
include('config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $idConectado        = $_SESSION['id'];
  $email_user         = $_SESSION['email_user'];
  $NombreUsarioSesion = $_SESSION['nombre_apellido'];
  $imgPerfil          = $_SESSION['imagen'];

  $QueryUsers = ("SELECT 
	users.id,imagen,
    email_user,
    nombre_apellido,
    fecha_session,
    estatus 
    FROM users
    INNER JOIN contactos ON users.id = contactos.contacto_id
    WHERE contactos.user_id = $idConectado 
    ORDER BY fecha_agregado ASC; ");
  $resultadoQuery = mysqli_query($con, $QueryUsers);
?>

  <div class="row sideBar">
    <div class="row sideBar" id="myusers">
    <?php
    // Display user contacts
    while ($FilaUsers = mysqli_fetch_array($resultadoQuery)) {
      $id_persona = $FilaUsers['id'];

      $resultado = ("SELECT * FROM msjs WHERE user_id='$id_persona' AND to_id='$idConectado' AND leido='NO'");
      $re = mysqli_query($con, $resultado);
      $numero_filas = mysqli_num_rows($re);
      $no_leidos = $numero_filas > 0 ? $numero_filas : '';
      ?>

      <div class="row sideBar-body chat-item" id="<?php echo $FilaUsers['id']; ?>" data-type="user">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
          <div class="avatar-icon">
            <img src="<?php echo 'imagenesperfil/' . $FilaUsers['imagen']; ?>" class="notification-container" style="border:3px solid <?php echo $FilaUsers['estatus'] != 'Inactiva' ? '#28a745' : '#696969'; ?>;">
          </div>
        </div>
        <div class="col-sm-9 col-xs-9 sideBar-main">
          <div class="row flex-nowrap gap-3">
            <div class="col-sm-8 col-xs-8 sideBar-name">
              <span class="name-meta"><?php echo $FilaUsers['nombre_apellido']; ?></span>
            </div>
            <div class="col-sm-4 col-xs-4 pull-right sideBar-time text-end" style="color:#93918f;">
              <?php if ($no_leidos > 0) { ?>
                <span class="notification-counter"><?php echo $no_leidos; ?></span>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
    <div class="row sideBar" id="mygroups">
    <!-- Display groups the current user belongs to -->
    <?php
    $groupQuery = ("SELECT g.id, g.nombre, g.descripcion 
                    FROM grupos g
                    INNER JOIN grupo_usuarios gu ON g.id = gu.grupo_id
                    WHERE gu.usuario_id = $idConectado");
    $groupResult = mysqli_query($con, $groupQuery);

    while ($groupRow = mysqli_fetch_assoc($groupResult)) {
      ?>
      <div class="row sideBar-body chat-item" id="group-<?php echo $groupRow['id']; ?>" data-type="group">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
          <div class="avatar-icon">
            <i class="bi bi-people-fill" style="font-size: 2rem; color: #007bff;"></i>
          </div>
        </div>
        <div class="col-sm-9 col-xs-9 sideBar-main">
          <div class="row flex-nowrap gap-3">
            <div class="col-sm-8 col-xs-8 sideBar-name">
              <span class="name-meta"><?php echo htmlspecialchars($groupRow['nombre'], ENT_QUOTES, 'UTF-8'); ?></span>
              <br>
              <small class="text-muted"><?php echo htmlspecialchars($groupRow['descripcion'], ENT_QUOTES, 'UTF-8'); ?></small>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>

  <script type="text/javascript" src="assets/js/jquery-3.7.1.js"></script>
  <script type="text/javascript">
    $(function() {
      $(".sideBar-body").on("click", function() {

        // Marcar el usuario seleccionado
        $(".sideBar-body").removeClass("seleccionado");
        $(this).addClass("seleccionado");

        var id = $(this).attr('id');
        var type = $(this).data('type');
        var idConectado = "<?php echo $idConectado; ?>";
        var email_user = "<?php echo $email_user; ?>";

        if (type === "group" && id.startsWith("group-")) {
          // Mostrar imagen de cargando inmediatamente
          $('#capausermsj').html('<img src="assets/img/cargando.gif" class="ImgCargando"/>');
          var groupId = id.replace("group-", "");
          // Usar $.ajax para asegurar que la imagen de cargando se muestre antes de la petición
          setTimeout(function() {
            $.ajax({
              url: 'GrupoSeleccionado.php',
              type: 'GET',
              data: { id: groupId, idConectado: idConectado, email_user: email_user },
              success: function(data) {
                $('#capausermsj').html(data);
              },
              error: function() {
                $('#capausermsj').html('<div class="alert alert-danger">No se pudo cargar el chat del grupo.</div>');
              }
            });
          }, 50);
        } else {
          $('#capausermsj').html('<img src="assets/img/cargando.gif" class="ImgCargando"/>');
          var dataString = 'id=' + id + '&idConectado=' + idConectado + '&email_user=' + email_user;
          var ruta = "UserSeleccionado.php";
          setTimeout(function() {
            $.ajax({
              url: ruta,
              type: "POST",
              data: dataString,
              success: function(data) {
                $("#capausermsj").html(data);
                $("#conversation").animate({
                  scrollTop: $(document).height()
                }, 50);
              },
              error: function() {
                $('#capausermsj').html('<div class="alert alert-danger">No se pudo cargar el chat.</div>');
              }
            });
          }, 50);
        }
        return false;
      });
    });

    $(function() {
      $(".heading-compose").click(function() {
        $(".side-two").css({
          "left": "0"
        });
      });

      $(".newMessage-back").click(function() {
        $(".side-two").css({
          "left": "-100%"
        });
      });
    });
  </script>
  <script type="text/javascript">
    // botones de filtros de usuarios y grupos
    function userButton() {
      document.getElementById('myusers').style.display = 'block';
      document.getElementById('mygroups').style.display = 'none';
    }

    function groupButton() {
      document.getElementById('myusers').style.display = 'none';
      document.getElementById('mygroups').style.display = 'block';
    }
    
    function allButton() {
      document.getElementById('myusers').style.display = 'block';
      document.getElementById('mygroups').style.display = 'block';
    }

    btnUser.addEventListener('change', userButton);
    btnGroup.addEventListener('change', groupButton);
    btnAll.addEventListener('change', allButton);

    if (btnUser.checked) {
      userButton();
    } else if (btnGroup.checked) {
      groupButton();
    } else {
      allButton();
    }

    // Filtro de chats
    function filterChats() {
      const filter = searchInput.value.toLowerCase();
      const chatItems = document.querySelectorAll('.chat-item');
      chatItems.forEach(function(item) {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
      });
    }

    searchInput.addEventListener('input', filterChats);

    if (searchInput.value) {
      filterChats();
    }
  </script>

<?php } ?>
<style> 
  @media (max-width: 768px) {
  .sideBar-body {
    display: flex !important;
    flex-direction: row !important;
    align-items: center;
    padding: 10px 15px;
  }

  .sideBar-avatar {
    width: auto;
    margin-right:10px;
  }

  .sideBar-avatar img,
  .sideBar-avatar i {
    width: 40px !important;
    height: 40px !important;
    object-fit: cover;
    border-radius: 50%;
    display: block;
  }

  .sideBar-main {
    flex: 1;
    padding-left: 10px;
  }

  .sideBar-name {
    font-size: 15px;
    font-weight: 500;
  }

  .sideBar-time {
    font-size: 12px;
    text-align: right;
  }

  .gap-3 {
    gap: 0 !important;
  }
}
</style>