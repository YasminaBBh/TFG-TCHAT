<?php
include('../config/config.php');

$data = json_decode(file_get_contents("php://input"), true);
$idConectado = $data['id_conectado'];
$idGrupo = $data['id_grupo'];

if (isset($idGrupo) && isset($idConectado)) {

  // Eliminar el usuario de la base de datos
  $query = "DELETE FROM grupo_usuarios WHERE grupo_id='$idGrupo' and usuario_id='$idConectado'";
  if (mysqli_query($con, $query)) {
    echo json_encode("success");
  } else {
    echo json_encode("error");
  }
} else {
  echo json_encode("invalid");
}

?>