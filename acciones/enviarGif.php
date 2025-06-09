<?php
include('../config/config.php');

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'];
$to_id = $data['to_id'];
$user = $data['user'];
$to_user = $data['to_user'];
$message = $data['message'];
$archivos = $data['archivos'];
$nombre_equipo_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$leido = "NO";

// Aquí puedes realizar la inserción en la base de datos
$query = "INSERT INTO msjs (user_id, to_id, user, to_user, message, archivos, nombre_equipo_user, leido) VALUES ('$user_id', '$to_id', '$user', '$to_user', '$message', '$archivos', '$nombre_equipo_user', '$leido')";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
}
?>