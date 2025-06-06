<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <style>
    .cabecera{
        height: 70px;
        background-color: #0d6efd;
         color: white;
      }
  </style>
<body>
<?php
header("Content-Type: text/html;charset=utf-8");
include('config/config.php');

$grupoId = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$idConectado = isset($_REQUEST['idConectado']) ? intval($_REQUEST['idConectado']) : 0;

$QueryGrupo = ("SELECT * FROM grupos WHERE id='$grupoId' LIMIT 1");
$ResultGrupo = mysqli_query($con, $QueryGrupo);
$grupo = mysqli_fetch_assoc($ResultGrupo);

if ($grupo) {
?>
  <div class="row align-items-center px-3 py-2 cabecera" id="grupo" >
    <div class="col-auto d-flex align-items-center">
      <a href="./" class="me-3 text-white" style="text-decoration: none;">
        <i class="zmdi zmdi-arrow-left fs-4"></i>
      </a>
      <i class="bi bi-people-fill" style="font-size: 36px;"></i>
    </div>

    <div class="col">
      <div class="d-flex flex-column">
        <span class="fw-semibold fs-5"><?php echo htmlspecialchars($grupo['nombre'], ENT_QUOTES, 'UTF-8'); ?></span>
        <small class="text-light"><?php echo htmlspecialchars($grupo['descripcion'], ENT_QUOTES, 'UTF-8'); ?></small>
      </div>
    </div>

    <div class="col-auto">
      <button class="btn btn-danger btn-sm" onclick="eliminarGrupo(<?php echo $grupoId; ?>)">
        <i class="bi bi-trash"></i> Eliminar grupo
      </button>
    </div>
  </div>

  <div class="message" id="conversation">
    <?php
    $Msjs = ("SELECT gm.*, u.nombre_apellido, u.imagen 
              FROM grupo_mensajes gm
              INNER JOIN users u ON gm.usuario_id = u.id
              WHERE gm.grupo_id = '$grupoId'
              ORDER BY gm.enviado_en ASC");
    $QueryMsjs = mysqli_query($con, $Msjs);

    while ($msg = mysqli_fetch_assoc($QueryMsjs)) {
      $isOwn = ($idConectado == $msg['usuario_id']);
    ?>
      <div class="row message-body">
        <div class="col-sm-12 <?php echo $isOwn ? 'message-main-sender' : 'message-main-receiver'; ?>">
          <div class="<?php echo $isOwn ? 'sender' : 'receiver'; ?>">
            <div class="row align-items-center">
              <div class="col-auto">
                <img src="<?php echo 'imagenesperfil/' . $msg['imagen']; ?>" class="rounded-circle" style="width:32px;height:32px;object-fit:cover;">
              </div>
              <div class="col ps-0">
                <span style="font-weight:bold;"><?php echo htmlspecialchars($msg['nombre_apellido'], ENT_QUOTES, 'UTF-8'); ?></span>
              </div>
            </div>
            <div class="message-text mt-1">
              <?php echo htmlspecialchars($msg['mensaje'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <span class="message-time pull-right">
              <?php echo $msg['enviado_en']; ?>
            </span>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <div class="row reply" id="formnormal">
    <form class="conversation-compose" id="formenviarmsj" name="formEnviaMsj">
      <input type="hidden" name="grupo_id" value="<?php echo $grupoId; ?>">
      <input type="hidden" name="usuario_id" value="<?php echo $idConectado; ?>">
      <div class="emoji">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489" />
        </svg>
      </div>
      <input class="input-msg" name="mensaje" id="mensaje" placeholder="Escribir tu Mensaje y presiona Enter..." autocomplete="off" required>
    </form>
  </div>

  <audio class="audio" style="display:none;">
    <source src="effect.mp3" type="audio/mp3">
  </audio>

<?php } ?>

<script type="text/javascript">
  $(function () {
    scroll();
    var grupoId = "<?php echo $grupoId; ?>";
    var idConectado = "<?php echo $idConectado; ?>";

    if (window.bucleGrupo) {
      clearInterval(window.bucleGrupo);
    }

    var datalenght = 0;
    function actualizarMensajesGrupo() {
      window.bucleGrupo = setInterval(function () {
        if (!document.getElementById('grupo')) {
          clearInterval(window.bucleGrupo);
          return;
        }
        $.ajax({
          type: "POST",
          url: 'MsjsGrupo.php',
          data: {
            grupo_id: grupoId,
            idConectado: idConectado,
          },
          success: function (data) {
            $('#conversation').html(data);
            if (data.length != datalenght) {
              scroll();
              datalenght = data.length;
            }
          }
        });
      }, 3000);
    }

    actualizarMensajesGrupo();

    $(".conversation-compose").on('keydown', function (e) {
      if (e.which == 13 && !e.shiftKey) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "acciones/send_group_message.php",
          data: $("#formenviarmsj").serialize(),
          complete: function () {
            $.post('MsjsGrupo.php', {
              grupo_id: grupoId,
              idConectado: idConectado,
            }, function (data) {
              $('#conversation').html(data);
              scroll();
            });
          },
          success: function () {
            $("#mensaje").val("");
            $(".audio")[0].play();
          }
        });
        return false;
      }
    });

    function scroll() {
      var el = $('#conversation')[0];
      if (el) {
        el.scrollTop = el.scrollHeight;
      }
    }

    window.eliminarGrupo = function (id) {
      if (confirm('¿Estás seguro de eliminar este grupo?')) {
        location.href = 'acciones/eliminarGrupo.php?id=' + id;
      }
    }
  });
</script>
<script src="assets/js/theme.js"></script>
</body>
</html>
