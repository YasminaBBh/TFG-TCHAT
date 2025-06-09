<?php
include('../config/config.php');

date_default_timezone_set("Europe/Madrid" ) ;
$hora             = date('h:i a',time() - 3600*date('I'));
$fecha            = date("d/m/Y");
$FechaMsj         = $fecha." ".$hora;
$nombre_equipo_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$de               = $_POST['user'];
$UserId 		      = $_POST['user_id'];
$to_id 			      = $_POST['to_id'];
$para                 = $_POST['to_user'];
$leido 			      = "NO";
$msj 	            = $_POST['message'];

if($msj != ''){
  $NuevoMsj  = ("INSERT INTO msjs (user, user_id,to_user,to_id,message,nombre_equipo_user,leido)
    VALUES ('$de', '$UserId', '$para', '$to_id', '$msj', '$nombre_equipo_user', '$leido')");
  $reg = mysqli_query($con, $NuevoMsj);
 
	}
?>
