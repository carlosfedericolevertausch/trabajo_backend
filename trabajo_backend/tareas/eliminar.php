<?php

include("../conexion.php");
include("../usuarios/admin.php");

$id = $_GET['id'];

$stmt = $conn->prepare(
"DELETE FROM tareas
WHERE id_tarea=?"
);

$stmt->bind_param(
"i",
$id
);

$stmt->execute();

header("Location:listar.php");
exit();