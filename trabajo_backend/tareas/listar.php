<?php

include("../conexion.php");
include("../usuarios/admin.php");

include("../includes/header.php");
include("../includes/sidebar.php");

$sql = "
SELECT
t.*,
u.nombre
FROM tareas t
LEFT JOIN usuarios u
ON t.id_usuario_asignado = u.id_usuario
ORDER BY t.fecha_limite
";

$tareas = $conn->query($sql);
?>

<div class="main-content">

<div class="d-flex justify-content-between mb-3">

<h2>Tareas</h2>

<a href="crear.php"
class="btn btn-success">

Nueva Tarea

</a>

</div>

<table class="table table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Título</th>
<th>Estado</th>
<th>Asignado</th>
<th>Fecha Límite</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($t = $tareas->fetch_assoc()){ ?>

<tr>

<td><?= $t['id_tarea'] ?></td>

<td><?= $t['titulo'] ?></td>

<td>

<form action="cambiar_estado.php" method="POST">

    <input
        type="hidden"
        name="id_tarea"
        value="<?= $t['id_tarea'] ?>">

    <select
        name="estado"
        class="form-select form-select-sm"
        onchange="this.form.submit()">

        <option value="Pendiente"
            <?= $t['estado']=='Pendiente' ? 'selected' : '' ?>>
            Pendiente
        </option>

        <option value="En Progreso"
            <?= $t['estado']=='En Progreso' ? 'selected' : '' ?>>
            En Progreso
        </option>

        <option value="Completada"
            <?= $t['estado']=='Completada' ? 'selected' : '' ?>>
            Completada
        </option>

    </select>

</form>

</td>

<td><?= $t['nombre'] ?></td>

<td>
<?= date(
    'd-m-Y',
    strtotime($t['fecha_limite'])
) ?>
</td>

<td>

<a href="editar.php?id=<?= $t['id_tarea'] ?>"
class="btn btn-warning btn-sm">

Editar

</a>

<a href="eliminar.php?id=<?= $t['id_tarea'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar tarea?')">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php include("../includes/footer.php"); ?>