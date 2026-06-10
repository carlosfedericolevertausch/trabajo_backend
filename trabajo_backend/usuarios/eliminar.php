<?php

include("../conexion.php");
include("admin.php");

$id = $_GET['id'];

$stmt = $conn->prepare(
"DELETE FROM usuarios
 WHERE id_usuario=?"
);

$stmt->bind_param(
"i",
$id
);

$stmt->execute();

header("Location:listar.php");
exit();