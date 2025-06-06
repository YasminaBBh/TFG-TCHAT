<?php
include('../config/config.php');

$usuario = trim($_POST['email_user']);
$password = trim($_POST['password']);

$sqlVerificandoLogin = ("SELECT * FROM users WHERE email_user COLLATE utf8_bin='$usuario'");
$resultLogin = mysqli_query($con, $sqlVerificandoLogin) or die(mysqli_error($con));
$numLogin = mysqli_num_rows($resultLogin);

if ($numLogin != 0) {
    while ($rowData = mysqli_fetch_assoc($resultLogin)) {
        $passwordBD = $rowData['password'];

        if (password_verify($password, $passwordBD)) {
            session_start();
            $_SESSION['id'] = $rowData['id'];
            $_SESSION['user_id'] = $rowData['id']; 
            $_SESSION['email_user'] = $rowData['email_user'];
            $_SESSION['nombre_apellido'] = $rowData['nombre_apellido'];
            $_SESSION['imagen'] = $rowData['imagen'];

            // Actualizando estado
            $activo = "Activo";
            $update_user_state = ("UPDATE users SET estatus='$activo' WHERE id='" . $_SESSION['id'] . "'");
            $result = mysqli_query($con, $update_user_state);

            header("location:../panel.php");
            exit();
        } else {
            header("location:../index.php?error=1"); // Contraseña incorrecta
            exit();
        }
    }
} else {
    header("location:../index.php?error=2"); // Usuario no encontrado
    exit();
}
