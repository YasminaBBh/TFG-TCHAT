<?php
include('../config/config.php');
$nombre_equipo_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$to_user = $_REQUEST['to_user'];
$user = $_REQUEST['user'];

$user_id = $_POST['user_id'];
$to_id = $_POST['to_id'];
$leido = "NO";

$archivosPermitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'webm', 'mp4');

$directorio = '../archivos/';
if (!file_exists($directorio)) {
  mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
}

// Verificar si se envió al menos un archivo
if (isset($_FILES["namearchivo"]) && !empty($_FILES["namearchivo"]["name"])) {
  $filename = $_FILES["namearchivo"]["name"];
  $source = $_FILES["namearchivo"]["tmp_name"];

  // Renombrar el nombre del archivo
  $logitudPass = 10;
  $newNameFoto = substr(md5(microtime()), 1, $logitudPass);

  $explode = explode('.', $filename);
  $extension_foto = array_pop($explode);
  $nuevoNameFoto = $newNameFoto . '.' . $extension_foto;

  $target_path = $directorio . '/' . $nuevoNameFoto;

  if (!in_array($extension_foto, $archivosPermitidos)) {
    echo "No se permiten archivos de este tipo por razones de seguridad.<br>";
    exit();
  }

  // Mover y guardar la imagen solo si no existe ya en el servidor
  if (!file_exists($target_path)) {
    if (move_uploaded_file($source, $target_path)) {
      $sqlInsertFile = ("INSERT INTO msjs(user,user_id,to_user,to_id,nombre_equipo_user,leido,archivos) VALUES('$user','$user_id','$to_user','$to_id','$nombre_equipo_user','$leido','$nuevoNameFoto')");
      $resulInsertFile = mysqli_query($con, $sqlInsertFile);
    } else {
      echo "Ha ocurrido un error al cargar la imagen, por favor inténtelo de nuevo.<br>";
    }
  } else {
    echo "La imagen con el mismo nombre ya existe en el servidor.<br>";
  }
}
