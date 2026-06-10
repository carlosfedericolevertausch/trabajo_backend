<?php

include("../conexion.php");
include("admin.php");

include("../includes/header.php");
include("../includes/sidebar.php");

$sql = "
SELECT
u.id_usuario,
u.nombre,
u.correo,
r.nombre_rol
FROM usuarios u
INNER JOIN roles r
ON u.id_rol = r.id_rol
ORDER BY u.id_usuario
";

$usuarios = $conn->query($sql);
?>

<div class="main-content">

<div class="d-flex justify-content-between mb-3">

<h2>Usuarios</h2>

<a href="crear.php"
class="btn btn-success">

Nuevo Usuario

</a>

</div>

<table class="table table-striped">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Correo</th>
<th>Rol</th>
<th>Acciones</th>
</tr>

</thead>

<tbody>

<?php while($u = $usuarios->fetch_assoc()){ ?>

<tr>

<td><?= $u['id_usuario'] ?></td>
<td><?= $u['nombre'] ?></td>
<td><?= $u['correo'] ?></td>
<td><?= $u['nombre_rol'] ?></td>

<td>

<a href="editar.php?id=<?= $u['id_usuario'] ?>"
class="btn btn-warning btn-sm">

Editar

</a>

<a href="eliminar.php?id=<?= $u['id_usuario'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar usuario?')">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php include("../includes/footer.php"); ?>