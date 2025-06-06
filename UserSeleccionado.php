<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
<style>
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
<body>

  <?php
  sleep(1);
  header("Content-Type: text/html;charset=utf-8");

  include('config/config.php');
  $IdUser                 = $_REQUEST['id'];
  $idConectado            = $_REQUEST['idConectado'];
  $email_user             = $_REQUEST['email_user'];

  //Actualizando los mensajes no leidos ya que estoy entrando en mis mensajes
  if (!empty($IdUser)) {
    $leyendoMsj = ("UPDATE msjs SET leido = 'SI' WHERE  user_id='$IdUser' AND to_id='$idConectado' ");
    $queryLeerMsjs = mysqli_query($con, $leyendoMsj);
  }

  $QueryUserSeleccionado = ("SELECT * FROM users WHERE id='$IdUser' LIMIT 1 ");
  $QuerySeleccionado     = mysqli_query($con, $QueryUserSeleccionado);

  while ($rowUser = mysqli_fetch_array($QuerySeleccionado)) {
  ?>
 
    <div class="row heading  align-items-center px-3 cabecera" id="user-selected" style="height: 70px;">
  <!-- Avatar + flecha -->
  <div class="col-auto d-flex align-items-center">
    <a href="./" class="d-flex align-items-center text-white text-decoration-none">
      <i class="zmdi zmdi-arrow-left me-2" style="font-size: 22px;"></i>
      <img src="<?php echo 'imagenesperfil/' . $rowUser['imagen']; ?>" 
           class="rounded-circle" 
           alt="Perfil" 
           style="width: 44px; height: 44px; object-fit: cover; border: 2px solid white;">
    </a>
  </div>

  <!-- Nombre del usuario -->
  <div class="col d-flex align-items-center">
    <span class="text-white fw-semibold fs-5 m-0">
      <?php echo $rowUser['nombre_apellido']; ?>
    </span>
  </div>

  <!-- Botón eliminar -->
  <div class="col-auto text-end">
    <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(<?php echo $rowUser['id']; ?>)">
      <i class="bi bi-trash"></i> Eliminar usuario
    </button>
  </div>
</div>



    <div class="message" id="conversation">
      <?php
      $QueryUserClick = ("SELECT UserIdSession FROM clickuser WHERE UserIdSession='$idConectado' LIMIT 1");
      $QueryClick     = mysqli_query($con, $QueryUserClick);
      $veririficaClick = mysqli_num_rows($QueryClick);
      if ($veririficaClick == 0) {
        $InserClick = ("INSERT INTO clickuser (UserIdSession,clickUser) VALUES ('$idConectado','$IdUser')");
        $ResulInsertClick = mysqli_query($con, $InserClick);
      } else {
        $UpdateClick = ("UPDATE clickuser SET clickUser='$IdUser' WHERE UserIdSession='$idConectado'");
        $ResultUpdateClick = mysqli_query($con, $UpdateClick);
      }


      //Mostrando msjs deacuerdo al Usuario seleccionado
      $Msjs = ("SELECT * FROM msjs WHERE (user_id ='" . $idConectado . "' AND to_id='" . $IdUser . "') OR (user_id='" . $IdUser . "' AND to_id='" . $idConectado . "') ORDER BY id ASC");
      $QueryMsjs = mysqli_query($con, $Msjs);

      // Tipos de imagen permitidos
      $extensiones_imagen = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
      $extensiones_video = ['webm', 'mp4'];

      while ($UserMsjs = mysqli_fetch_array($QueryMsjs)) {
        $archivo = $UserMsjs['archivos'];
        $explode = explode('.', $archivo);
        $extension_arch = strtolower(array_pop($explode));
        $esImagen = in_array($extension_arch, $extensiones_imagen);
        $esVideo = in_array($extension_arch, $extensiones_video);

        if ($idConectado == $UserMsjs['user_id']) { ?>
          <div class="row message-body">
            <div class="col-sm-12 message-main-sender">
              <div class="sender">
                <div class="message-text">
                  <?php
                  if (!empty($UserMsjs['message'])) {
                    echo $UserMsjs['message'];
                  } elseif (!empty($archivo)) {
                    if ($esImagen) { ?>
                      <img src="<?php echo 'archivos/' . $archivo; ?>" style="width: 100%; max-width: 250px;">
                    <?php } elseif ($esVideo) { ?>
                      <video controls style="width: 100%; max-width: 250px;">
                        <source src="<?php echo 'archivos/' . $archivo; ?>" type="video/<?php echo $extension_arch; ?>">
                        Tu navegador no soporta el elemento de video.
                      </video>
                    <?php } ?>
                    <div class="row">
                      <div class="col-md-12">
                        <a class="boton_desc" download href="archivos/<?php echo $archivo; ?>" title="Descargar Archivo">Descargar</a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <span class="message-time pull-right">
                  <?php echo $UserMsjs['fecha'];  ?>
                </span>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="row message-body">
            <div class="col-sm-12 message-main-receiver">
              <div class="receiver">
                <div class="message-text">
                  <?php
                  if (!empty($UserMsjs['message'])) {
                    echo $UserMsjs['message'];
                  } elseif (!empty($archivo)) {
                    if ($esImagen) { ?>
                      <img src="<?php echo 'archivos/' . $archivo; ?>" style="width: 100%; max-width: 250px;">
                    <?php } elseif ($esVideo) { ?>
                      <video controls style="width: 100%; max-width: 250px;">
                        <source src="<?php echo 'archivos/' . $archivo; ?>" type="video/<?php echo $extension_arch; ?>">
                        Tu navegador no soporta el elemento de video.
                      </video>
                    <?php } ?>
                    <div class="row">
                      <div class="col-md-12">
                        <a class="boton_desc" download href="archivos/<?php echo $archivo; ?>" title="Descargar Archivo">Descargar</a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <span class="message-time pull-right">
                  <?php echo $UserMsjs['fecha'];  ?>
                </span>
              </div>
            </div>
          </div>
      <?php  }
      }
      ?>

    </div>



    <div class="row reply" id="formnormal">
      <form class="conversation-compose" id="formenviarmsj_texto" name="formEnviaMsj">
        <input type="hidden" name="user_id" value="<?php echo $idConectado; ?>">
        <input type="hidden" name="to_id" value="<?php echo $rowUser['id']; ?>">
        <input type="hidden" name="user" value="<?php echo $email_user; ?>">
        <input type="hidden" name="to_user" value="<?php echo $rowUser['nombre_apellido']; ?> ">

        <div class="emoji">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489" />
          </svg>
        </div>
        <input class="input-msg" name="message" id="message" placeholder="Escribir tu Mensaje y presiona Enter..." autocomplete="off" autofocus="autofocus" required>
        <i class="zmdi zmdi-comment-image ps-2 pe-2" style="font-size: 45px; color: grey;" title="Enviar Imagen." id="mostrarformenviarimg"></i>
      </form>
    </div>


    <!---audio para cuando se envia un msj-->
    <audio class="audio" style="display:none;">
      <source src="effect.mp3" type="audio/mp3">
    </audio>
    <!---fin del audio--->


    <!---- form enviar img--->
    <div class="row reply" id="formenviaimg">
      <form class="conversation-compose d-flex justify-content-center" id="formenviarmsj_img" name="formEnviaMsjImg" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $idConectado; ?>">
        <input type="hidden" name="to_id" value="<?php echo $rowUser['id']; ?>">
        <input type="hidden" name="to_user" value="<?php echo $rowUser['nombre_apellido']; ?> ">
        <input type="hidden" name="user" value="<?php echo $email_user; ?>">


        <div class="col-sm-10 col-xs-10 reply-recording">
          <label for="uploadFile" id="uploadIcon">
            <i class="zmdi zmdi-camera camara"></i>
          </label>
          <input type="file" name="namearchivo" id="uploadFile" class="uploadFile" required />
        </div>
        <button class="send" id="botonenviarimg">
          <div class="circle">
            <i class="zmdi zmdi-mail-send" title="Enviar Imagen..."></i>
          </div>
        </button>
        <i class="zmdi zmdi-mail-reply" style="font-size: 50px;color: grey;" id="volverformnormal" title="Volver . ."></i>
      </form>
    </div>
  <?php } ?>


  <script type="text/javascript">
    window.scroll = setInterval(() => {
      if (document.getElementById('conversation') !== null) {
        document.getElementById('conversation').scrollTop = document.getElementById('conversation').scrollHeight;
        clearInterval(scroll);
      }
    }, 100);
    
    $(function() {
      var idConectado = "<?php echo $idConectado; ?>";

      //Buscando mensajes nuevos cada 4 segundos
      function actualizar() {
          window.bucle = setInterval(function() {
            //console.log('Buscando mensajes sin leer ' + valor);
            if (document.getElementById('user-selected') === null) {
                clearInterval(window.bucle);
              } else {
              $.ajax({
                type: "POST",
                url: "buscarMensajesNuevos.php",
                dataType: "json",
                data: {
                  idConectado: idConectado
                },
                success: function(data) {
                  //console.log(data);
                  if (data.msj == true) {
                    $.post('MsjsUsers.php', {
                      id: idConectado
                    }, function(data) {
                      $('#conversation').html(data);
                      scroll();
                    })
                    //console.log('si hay msjs');
                  } else {
                    //console.log('no hay msjs');
                  }
                }
              })
              }
          }, 4000);
      }

      actualizar(); //Llamado a la funcion.



      // Enviar mensaje de texto
      $("#formenviarmsj_texto").keypress(function(e) {
        if (e.which == 13) {

          var url = "acciones/RegistMsj.php";
          $.ajax({
            type: "POST",
            url: url,
            data: $("#formenviarmsj_texto").serialize(),
            complete: function(data) {
            },
            success: function(data) {
              $("#conversation").load('MsjsUsers.php?id=' + idConectado, function() {
                scroll();
              });
              //$('#conversation').html(data);
              $("#message").val(""); //limpiar el input del msg
              $(".audio")[0].play(); //reproducir audio de envio
              // scroll(); // <-- ya no es necesario aquí, está en el callback
            }
          });
          return false;
        }
      });


      $("#formenviaimg").hide();

      $("#mostrarformenviarimg").click(function() {
        $("#formnormal").hide();
        $("#formenviaimg").show(200);
      });

      $("#volverformnormal").click(function() {
        $("#formenviaimg").hide();
        $("#formnormal").show(200);
      });

    });


    // Envío de imagen
    var enviandoImagen = false;
    $('body').off('click', '#botonenviarimg').on('click', '#botonenviarimg', async function(e) {
      e.preventDefault();

      if (enviandoImagen) {
        return;
      }

      enviandoImagen = true;

      const form = $(this).closest('form')[0];
      const formData = new FormData(form);
      const idConectado = "<?php echo $idConectado; ?>";

      const namearchivo = $("#uploadFile").val();
      if (!namearchivo) {
        alert("Debes seleccionar una imagen");
        enviandoImagen = false;
        return;
      }

      try {
        const response = await fetch('acciones/archivo.php', {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          throw new Error('Error en la solicitud');
        }

        const data = await response.text();
        $("#conversation").html(data);
        $(".audio")[0].play();

        $("#formenviaimg").hide();
        $("#formnormal").show(200);

        const updatedData = await $.post('MsjsUsers.php', {
          id: idConectado
        });
        $('#conversation').html(updatedData);

        
        enviandoImagen = false;
        form.reset();
        scroll();
      } catch (error) {
        console.error('Error:', error);
        enviandoImagen = false;
      }
    });
    function scroll() {
        var el = $('#conversation')[0];
        if (el) {
          el.scrollTop = el.scrollHeight;
        }
      }
  </script>
<script src="assets/js/theme.js"></script>
</body>
</html>