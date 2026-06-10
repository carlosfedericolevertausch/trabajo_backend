<?php

session_start();

if(!isset($_SESSION['id_usuario'])){
    header("Location:index.php");
    exit();
}

include("conexion.php");
include("includes/header.php");
include("includes/sidebar.php");
?>

<div class="main-content">

<div class="card shadow">

<div class="card-header oscuro text-white">

Dashboard

</div>

<div class="card-body">

<h3>
Bienvenido <?= $_SESSION['nombre'] ?>
</h3>

<p>
Rol:
<strong><?= $_SESSION['rol'] ?></strong>
</p>

<hr>

<h4>Mis Tareas</h4>

<?php

$id_usuario = $_SESSION['id_usuario'];

$stmt = $conn->prepare("
SELECT *
FROM tareas
WHERE id_usuario_asignado = ?
");

$stmt->bind_param(
"i",
$id_usuario
);

$stmt->execute();

$tareas = $stmt->get_result();

?>

<table class="table table-bordered">

<tr>
<th>Título</th>
<th>Estado</th>
<th>Fecha Límite</th>
</tr>

<?php while($t = $tareas->fetch_assoc()){ ?>

<tr>

<td><?= $t['titulo'] ?></td>

<td><?= $t['estado'] ?></td>

<td><?= date(
        'd-m-Y',
        strtotime($t['fecha_limite'])
    ) ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>