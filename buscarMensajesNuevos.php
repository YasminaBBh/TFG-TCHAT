<?php
include('config/config.php');
$jsondata = array();

$idConectado = $_REQUEST['idConectado'];

$QueryUserClick = "SELECT UserIdSession, clickUser FROM clickuser WHERE UserIdSession='$idConectado' LIMIT 1";
$QueryClick = mysqli_query($con, $QueryUserClick);
$UserIdSession = mysqli_fetch_array($QueryClick);
$clickUser = $UserIdSession['clickUser'];

$resultado = "SELECT * FROM msjs WHERE user_id='$clickUser' AND to_id='$idConectado' AND leido='NO'";
$re = mysqli_query($con, $resultado);
$filaMsjs = mysqli_num_rows($re);

if ($filaMsjs > 0) {
    $jsondata['msj'] = true;
    $leyendoMsj = "UPDATE msjs SET leido = 'SI' WHERE user_id='$clickUser' AND to_id='$idConectado'";
    $queryLeerMsjs = mysqli_query($con, $leyendoMsj);
} else {
    $jsondata['msj'] = false;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>
