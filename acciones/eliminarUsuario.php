<?php
include('../config/config.php');

$data = json_decode(file_get_contents("php://input"), true);
$idConectado = $data['id_conectado'];
$idContacto = $data['id_contacto'];

if (isset($idContacto) && isset($idConectado)) {

  // Eliminar el usuario de la base de datos
  $query = "DELETE FROM contactos WHERE (user_id='$idContacto' and contacto_id='$idConectado') OR (user_id='$idConectado' AND contacto_id='$idContacto')";
  if (mysqli_query($con, $query)) {
    echo json_encode("success");
  } else {
    echo json_encode("error");
  }
} else {
  echo json_encode("invalid");
}

?>