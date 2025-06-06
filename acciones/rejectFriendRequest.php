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

    // Eliminar la solicitud de amistad de friend_requests
    $deleteQuery = "DELETE FROM friend_requests WHERE requester_id = ? AND requested_id = ?";
    $deleteStmt = $con->prepare($deleteQuery);
    $deleteStmt->bind_param("ii", $requesterId, $idConectado);
    if ($deleteStmt->execute()) {
      echo json_encode(['success' => true]);
    } else {
      $errorMsg = $deleteStmt->error;
      echo json_encode(['success' => false, 'error' => $errorMsg]);
    }
    $deleteStmt->close();
}
?>