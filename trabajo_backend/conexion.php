<?php

$host = "localhost";
$usuario = "root";
$password = "";
$bd = "trabajo_backend";

$conn = new mysqli(
    $host,
    $usuario,
    $password,
    $bd
);

if($conn->connect_error){
    die("Error de conexión");
}