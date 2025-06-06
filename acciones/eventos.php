<?php
// acciones/eventos.php

ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=UTF-8');

// incluye config.php, que define $con
require __DIR__ . '/../config/config.php';

if (!isset($con) || !($con instanceof mysqli)) {
    http_response_code(500);
    echo json_encode(['error' => 'No hay conexión configurada ($con).']);
    exit;
}

// parámetros fullcalendar
$start = $_GET['start'] ?? null;
$end   = $_GET['end']   ?? null;
if (!$start || !$end) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan start o end']);
    exit;
}

try {
    $startDt = new DateTime($start);
    $endDt   = new DateTime($end);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => 'Fecha inválida: ' . $e->getMessage()]);
    exit;
}

$startIso = $startDt->format('Y-m-d H:i:s');
$endIso   = $endDt->format('Y-m-d H:i:s');

$sql = "SELECT id, title, `start`, `end`, allDay 
        FROM eventos 
        WHERE `start` >= ? AND `start` < ?";
$stmt = $con->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error'=>'Prepare failed: '.$con->error]);
    exit;
}
$stmt->bind_param('ss', $startIso, $endIso);
$stmt->execute();
$res = $stmt->get_result();

$events = [];
while ($r = $res->fetch_assoc()) {
    $events[] = [
        'id'     => (int)$r['id'],
        'title'  => $r['title'],
        'start'  => $r['start'],
        'end'    => $r['end'],
        'allDay' => (bool)$r['allDay'],
    ];
}
echo json_encode($events);
$stmt->close();
$con->close();
