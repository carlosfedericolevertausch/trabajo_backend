<?php

include("../conexion.php");
include("../usuarios/admin.php");

$id = $_GET['id'];

$tarea = $conn->query(
"SELECT * FROM tareas
WHERE id_tarea=$id"
)->fetch_assoc();

$usuarios = $conn->query(
"SELECT * FROM usuarios"
);

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $fecha_limite = $_POST['fecha_limite'];
    $id_usuario = $_POST['id_usuario'];

    $stmt = $conn->prepare("
    UPDATE tareas
    SET titulo=?,
        descripcion=?,
        estado=?,
        fecha_limite=?,
        id_usuario_asignado=?
    WHERE id_tarea=?
    ");

    $stmt->bind_param(
        "ssssii",
        $titulo,
        $descripcion,
        $estado,
        $fecha_limite,
        $id_usuario,
        $id
    );

    $stmt->execute();

    header("Location:listar.php");
    exit();
}

include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="main-content">

<div class="card">

<div class="card-header">
Editar Tarea
</div>

<div class="card-body">

<form method="POST">

<input type="text"
name="titulo"
value="<?= $tarea['titulo'] ?>"
class="form-control mb-3">

<textarea
name="descripcion"
class="form-control mb-3"><?= $tarea['descripcion'] ?></textarea>

<select
name="estado"
class="form-select mb-3">

<option <?= $tarea['estado']=="Pendiente"?"selected":"" ?>>
Pendiente
</option>

<option <?= $tarea['estado']=="En Progreso"?"selected":"" ?>>
En Progreso
</option>

<option <?= $tarea['estado']=="Completada"?"selected":"" ?>>
Completada
</option>

</select>

<input
type="date"
name="fecha_limite"
value="<?= $tarea['fecha_limite'] ?>"
class="form-control mb-3">

<select
name="id_usuario"
class="form-select mb-3">

<?php while($u=$usuarios->fetch_assoc()){ ?>

<option
value="<?= $u['id_usuario'] ?>"
<?= $u['id_usuario']==$tarea['id_usuario_asignado'] ? 'selected' : '' ?>>

<?= $u['nombre'] ?>

</option>

<?php } ?>

</select>

<button class="btn btn-warning">
Actualizar
</button>

</form>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>