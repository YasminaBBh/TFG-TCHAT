<?php
session_start();
include('config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $idConectado        = $_SESSION['id'];
  
  $QueryUsers = ("SELECT 
	users.id,
    nombre_apellido
    FROM users
    INNER JOIN contactos ON users.id = contactos.contacto_id
    WHERE contactos.user_id = $idConectado 
    ORDER BY fecha_agregado ASC; ");
  $resultadoQuery = mysqli_query($con, $QueryUsers);
  
  if ($resultadoQuery) {
    while ($row = mysqli_fetch_assoc($resultadoQuery)) {
      echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['nombre_apellido'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
  }
}
?>