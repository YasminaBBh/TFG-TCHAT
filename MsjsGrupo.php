<?php
include('config/config.php');

$grupoId = isset($_POST['grupo_id']) ? intval($_POST['grupo_id']) : 0;
$idConectado = isset($_POST['idConectado']) ? intval($_POST['idConectado']) : 0;

// Mostrar mensajes del grupo
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
<?php
}
?>
