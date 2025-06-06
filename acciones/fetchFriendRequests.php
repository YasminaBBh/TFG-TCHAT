<?php
session_start();
include('../config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $idConectado        = $_SESSION['id'];
  
  $QueryUsers = ("SELECT requester_id, nombre_apellido, imagen
    FROM friend_requests
    INNER JOIN users ON requester_id = users.id
    WHERE requested_id = $idConectado
    ORDER BY created_at ASC;");
  $resultadoQuery = mysqli_query($con, $QueryUsers);
  
  if ($resultadoQuery) {
    while ($row = mysqli_fetch_assoc($resultadoQuery)) {
      echo '<div class="row align-items-center py-3 border-bottom" data-id="' . $row['requester_id'] . '">

  <div class="col-auto">
    <img src="imagenesperfil/' . $row['imagen'] . '"
         class="rounded-circle"
         alt="User Image"
         style="width: 70px; height: 70px; object-fit: cover;">
  </div>

  <div class="col-5">
    <span class="fw-semibold fs-5">
      ' . htmlspecialchars($row['nombre_apellido'], ENT_QUOTES, 'UTF-8') . '
    </span>
  </div>

  <div class="col text-end">
    <button class="btn btn-primary  accept-request me-2"
            onclick="acceptRequest(' . $row['requester_id'] . ')">
      Aceptar
    </button>
    <button class="btn btn-danger  reject-request "
            onclick="rejectRequest(' . $row['requester_id'] . ')">
      Rechazar
    </button>
  </div>

</div>';

    }
  }
}
?>