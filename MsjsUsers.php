<?php
header("Content-Type: text/html;charset=utf-8");
include('config/config.php');
$idConectado  = $_REQUEST['id'];

$QueryUserClick = ("SELECT UserIdSession,clickUser FROM clickuser WHERE UserIdSession='$idConectado' LIMIT 1 ");
$QueryClick     = mysqli_query($con, $QueryUserClick);

$UserIdSession  = mysqli_fetch_array($QueryClick);
$clickUser      = $UserIdSession['clickUser'];

$Msjs = ("SELECT * FROM msjs WHERE (user_id ='" . $idConectado . "' AND to_id='" . $clickUser . "') OR (user_id='" . $clickUser . "' AND to_id='" . $idConectado . "') ORDER BY id ASC");
$QueryMsjs = mysqli_query($con, $Msjs);

$extensiones_imagen = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
$extensiones_video = ['webm', 'mp4'];

while ($UserMsjs = mysqli_fetch_array($QueryMsjs)) {
  $archivo = $UserMsjs['archivos'];
  $explode = explode('.', $archivo);
  $extension_arch = strtolower(array_pop($explode));
  $esImagen = in_array($extension_arch, $extensiones_imagen);
  $esVideo = in_array($extension_arch, $extensiones_video);

  if ($idConectado == $UserMsjs['user_id']) { ?>
    <div class="message-body">
      <div class="col-sm-12 message-main-sender">
        <div class="sender">
          <div class="message-text">
            <?php
            if (!empty($UserMsjs['message'])) {
              if ($archivo == "Giphy") { ?>
                <img src="<?php echo $UserMsjs['message']; ?>" style="width: 100%; max-width: 250px;">
              <?php } else {
                echo $UserMsjs['message'];
              }
            } elseif ($esImagen) { ?>
              <img src="<?php echo 'archivos/' . $archivo; ?>" style="width: 100%; max-width: 250px;">
              
            <?php } elseif ($esVideo) { ?>
              <video controls style="width: 100%; max-width: 250px;">
                <source src="<?php echo 'archivos/' . $archivo; ?>" type="video/<?php echo $extension_arch; ?>">
                Tu navegador no soporta el elemento de video.
              </video>
              <div class="row">
                <div class="col-md-12">
                  <a class="boton_desc" download="" href="archivos/<?php echo $archivo; ?>" title="Descargar Imagen">Descargar
                  </a>
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
    <div class="message-body">
      <div class="col-sm-12 message-main-receiver">
        <div class="receiver">
          <div class="message-text">
            <?php
            if (!empty($UserMsjs['message'])) {
              if ($archivo == "Giphy") { ?>
                <img src="<?php echo $UserMsjs['message']; ?>" style="width: 100%; max-width: 250px;">
              <?php } else {
                echo $UserMsjs['message'];
              }
            } elseif ($esImagen) { ?>
              <img src="<?php echo 'archivos/' . $UserMsjs['archivos']; ?>" style="width: 100%; max-width: 250px;">
              <div class="row">
                <div class="col-md-12">
                  <a class="boton_desc" download="" href="archivos/<?php echo $archivo; ?>" title="Descargar Imagen">Descargar
                  </a>
                </div>
              </div>
            <?php } elseif ($esVideo) { ?>
              <video controls style="width: 100%; max-width: 250px;">
                <source src="<?php echo 'archivos/' . $archivo; ?>" type="video/<?php echo $extension_arch; ?>">
                Tu navegador no soporta el elemento de video.
              </video>
              <div class="row">
                <div class="col-md-12">
                  <a class="boton_desc" download="" href="archivos/<?php echo $archivo; ?>" title="Descargar Imagen">Descargar
                  </a>
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
} ?>