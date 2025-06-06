<?php
include('../config/config.php');

$grupo_id   = isset($_POST['grupo_id']) ? intval($_POST['grupo_id']) : 0;
$usuario_id = isset($_POST['usuario_id']) ? intval($_POST['usuario_id']) : 0;
$mensaje    = isset($_POST['mensaje']) ? utf8_decode(strip_tags(trim(filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING)))) : '';

if ($grupo_id && $usuario_id && $mensaje != '') {
    $NuevoMsj = ("INSERT INTO grupo_mensajes (grupo_id, usuario_id, mensaje)
                  VALUES ('$grupo_id', '$usuario_id', '$mensaje')");
    $reg = mysqli_query($con, $NuevoMsj);
}

?>
