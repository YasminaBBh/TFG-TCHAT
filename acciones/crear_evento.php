<?php
include('../config/config.php');
header('Content-Type: application/json');

$title = $_POST['title'] ?? '';
$start = $_POST['start'] ?? '';
$end = $_POST['end'] ?? '';
$allDay = isset($_POST['allDay']) ? (int)$_POST['allDay'] : 0;

if (!$title || !$start || !$end) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos']);
    exit;
}

$stmt = $con->prepare("INSERT INTO eventos (title, start, end, allDay) VALUES (?, ?, ?, ?)");
$stmt->bind_param('sssi', $title, $start, $end, $allDay);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
$stmt->close();
$con->close();
