<?php

session_start();

include("conexion.php");

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "
SELECT
u.*,
r.nombre_rol
FROM usuarios u
INNER JOIN roles r
ON u.id_rol = r.id_rol
WHERE correo = ?
AND password = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
"ss",
$correo,
$password
);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows==1){

$usuario = $resultado->fetch_assoc();

$_SESSION['id_usuario'] = $usuario['id_usuario'];
$_SESSION['nombre'] = $usuario['nombre'];
$_SESSION['correo'] = $usuario['correo'];
$_SESSION['rol'] = $usuario['nombre_rol'];

header("Location: dashboard.php");
exit();

}else{

$_SESSION['error']="Usuario o contraseña incorrectos";

header("Location: index.php");
exit();

}