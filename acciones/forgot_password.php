<?php
// acciones/forgot_password.php
header('Content-Type: application/json; charset=utf-8');

$db = new mysqli('localhost','tu_usuario_db','tu_contraseña_db','tu_base_datos');
if ($db->connect_error) {
    echo json_encode(['exists'=>false]);
    exit;
}

$email  = trim($_POST['email_user']     ?? '');
$nombre = trim($_POST['nombre_completo']?? '');

if (!$email || !$nombre) {
    echo json_encode(['exists'=>false]);
    exit;
}

$stmt = $db->prepare("
  SELECT 1
    FROM usuarios
   WHERE email_user = ?
     AND nombre_apellido = ?
   LIMIT 1
");
$stmt->bind_param('ss', $email, $nombre);
$stmt->execute();
$stmt->store_result();

echo json_encode(['exists' => $stmt->num_rows === 1]);

$stmt->close();
$db->close();
