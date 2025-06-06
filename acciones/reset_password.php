<?php
// acciones/reset_password.php
header('Content-Type: application/json; charset=utf-8');

$db = new mysqli('localhost','tu_usuario_db','tu_contraseña_db','tu_base_datos');
if ($db->connect_error) {
    echo json_encode(['success'=>false]);
    exit;
}

$email      = trim($_POST['email_user']     ?? '');
$nombre     = trim($_POST['nombre_completo']?? '');
$newpass    = $_POST['new_password'] ?? '';

if (!$email || !$nombre || !$newpass) {
    echo json_encode(['success'=>false]);
    exit;
}

// Si tus contraseñas están en texto plano:
$pass_to_store = $newpass;
// Si usas hashing, sustitúyelo:
// $pass_to_store = password_hash($newpass, PASSWORD_BCRYPT);

$stmt = $db->prepare("
  UPDATE usuarios
     SET password = ?
   WHERE email_user = ?
     AND nombre_apellido = ?
");
$stmt->bind_param('sss', $pass_to_store, $email, $nombre);
$stmt->execute();

echo json_encode(['success' => $stmt->affected_rows === 1]);

$stmt->close();
$db->close();

