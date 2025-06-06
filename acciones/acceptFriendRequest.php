<?php
session_start();
header('Content-Type: application/json');
include('../config/config.php');

if (isset($_SESSION['email_user']) != "") {
    $email_user = $_SESSION['email_user'];
    $idConectado = $_SESSION['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $requesterId = $data['requesterId'];

  //  aceptar la solicitud de amistad
  $query = ("INSERT INTO contactos (user_id, contacto_id) 
            VALUES (?, ?), (?, ?)
            ON DUPLICATE KEY UPDATE contacto_id = contacto_id");
  $stmt = $con->prepare($query);
  $stmt->bind_param("iiii", $requesterId, $idConectado, $idConectado, $requesterId);
  $success = false;
  $errorMsg = '';

  if ($stmt->execute()) {
    // Eliminar la solicitud de amistad de friend_requests
    $deleteQuery = "DELETE FROM friend_requests WHERE requester_id = ? AND requested_id = ?";
    $deleteStmt = $con->prepare($deleteQuery);
    $deleteStmt->bind_param("ii", $requesterId, $idConectado);
    if ($deleteStmt->execute()) {
      $success = true;
    } else {
      $errorMsg = $deleteStmt->error;
    }
    $deleteStmt->close();
  } else {
    $errorMsg = $stmt->error;
  }
  $stmt->close();

  if ($success) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'error' => $errorMsg]);
  }
}
?>