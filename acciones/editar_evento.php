<?php
include('../config/config.php');
header('Content-Type: application/json');

$id = $_POST['id'] ?? '';
$title = $_POST['title'] ?? '';
$start = $_POST['start'] ?? '';
$end = $_POST['end'] ?? '';
$allDay = isset($_POST['allDay']) ? (int)$_POST['allDay'] : 0;

if (!$id || !$title || !$start || !$end) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos']);
    exit;
}

$stmt = $con->prepare("UPDATE eventos SET title = ?, start = ?, end = ?, allDay = ? WHERE id = ?");
$stmt->bind_param('sssii', $title, $start, $end, $allDay, $id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
$stmt->close();
$con->close();
