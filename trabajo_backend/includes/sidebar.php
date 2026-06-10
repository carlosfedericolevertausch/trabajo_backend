<?php

if(session_status()===PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/../config.php';
?>

<div class="sidebar">

    <div class="logo">
        Sistema de tareas
    </div>

    <a href="<?= BASE_URL ?>/dashboard.php">
        <i class="bi bi-house-door"></i>
        Inicio
    </a>

    <?php if($_SESSION['rol']=="Administrador"){ ?>

    <a href="<?= BASE_URL ?>/usuarios/listar.php">
        <i class="bi bi-people"></i>
        Usuarios
    </a>

    <a href="<?= BASE_URL ?>/tareas/listar.php">
        <i class="bi bi-list-check"></i>
        Tareas
    </a>

    <?php } ?>

    <a href="<?= BASE_URL ?>/logout.php">
        <i class="bi bi-box-arrow-right"></i>
        Cerrar Sesión
    </a>

</div>