<?php
session_start();
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $groupName = mysqli_real_escape_string($con, $_POST['groupName']);
    $groupDescription = mysqli_real_escape_string($con, $_POST['groupDescription']);
    $createdBy = intval($_POST['userId']);
    $groupContacts = $_POST['groupContacts']; // Array of user IDs

    // Insert into "grupos" table
    $insertGroupQuery = "INSERT INTO grupos (nombre, descripcion, creado_por) VALUES ('$groupName', '$groupDescription', $createdBy)";
    if (mysqli_query($con, $insertGroupQuery)) {
        // Get the ID of the newly created group
        $groupId = mysqli_insert_id($con);

        // Insert into "grupo_usuarios" table
        $insertGroupUsersQuery = "INSERT INTO grupo_usuarios (grupo_id, usuario_id) VALUES ";
        $values = [];
        foreach ($groupContacts as $contactId) {
            $contactId = intval($contactId); // Ensure the ID is an integer
            $values[] = "($groupId, $contactId)";
        }
        $values[] = "($groupId, $createdBy)";
        $insertGroupUsersQuery .= implode(", ", $values);

        if (mysqli_query($con, $insertGroupUsersQuery)) {
            echo "<script>
                alert('Grupo creado exitosamente.');
                window.location.href = 'home.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al añadir usuarios al grupo: " . mysqli_error($con) . "');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Error al crear el grupo: " . mysqli_error($con) . "');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Método no permitido.');
        window.history.back();
    </script>";
}
?>
