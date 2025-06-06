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
    $email = $data['email'];
    if ($data['email'] == $email_user) {
        echo json_encode(['success' => false, 'error' => 'No puedes agregarte a ti mismo']);
        exit;
    }
    if ($data['message'] != '') {
        $message = $data['message'];
    } else {
        $message = null;
    }
    $requestedId = null;

    // Obtener el ID del usuario solicitado
    $userQuery = "SELECT id FROM users WHERE email_user = ?";
    $userStmt = $con->prepare($userQuery);
    $userStmt->bind_param("s", $email);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $requestedId = $userRow['id'];
    } else {
        echo json_encode(['success' => false, 'error' => 'El usuario no existe']);
        exit;
    }

    // Comprobar si la solicitud de amistad ya existe
    $checkQuery = "SELECT * FROM friend_requests WHERE requester_id = ? AND requested_id = ?";
    $checkStmt = $con->prepare($checkQuery);
    $checkStmt->bind_param("ii", $idConectado, $requestedId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Ya has enviado una solicitud de amistad a este usuario']);
        exit;
    }

    
    // Enviar solicitud de amistad
    $insertQuery = "INSERT INTO friend_requests (requester_id, requested_id, message) VALUES (?, ?, ?)";
    $insertStmt = $con->prepare($insertQuery);
    $insertStmt->bind_param("iis", $idConectado, $requestedId, $message);
    if ($insertStmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al enviar la solicitud de amistad']);
    }
    $insertStmt->close();
}
?>