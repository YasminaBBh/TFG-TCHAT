<?php
session_start();
include('../config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $idConectado        = $_SESSION['id'];
  
  $QueryUsers = ("SELECT count(*) as total_requests
    FROM friend_requests
    INNER JOIN users ON requester_id = users.id
    WHERE requested_id = $idConectado
    ORDER BY created_at ASC;");
  $resultadoQuery = mysqli_query($con, $QueryUsers);
  
  if ($resultadoQuery) {
    $row = mysqli_fetch_assoc($resultadoQuery);
    $totalRequests = $row['total_requests'];
    if ($totalRequests > 0) {
      echo '<div class="bg-danger friendRequests text-center rounded-circle">' . $totalRequests . '</div>';
    } else {
      echo '<div class="bg-danger friendRequests d-none text-center rounded-circle">0</div>';
    }
  }
}
?>