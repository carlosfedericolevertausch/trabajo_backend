<?php

include("../conexion.php");
include("../usuarios/admin.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $id_tarea = $_POST['id_tarea'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("
        UPDATE tareas
        SET estado = ?
        WHERE id_tarea = ?
    ");

    $stmt->bind_param(
        "si",
        $estado,
        $id_tarea
    );

    $stmt->execute();
}

header("Location: listar.php");
exit();