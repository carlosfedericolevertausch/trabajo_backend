<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['id_usuario'])){
    header("Location: ../index.php");
    exit();
}

if($_SESSION['rol'] != "Administrador"){
    header("Location: ../dashboard.php");
    exit();
}