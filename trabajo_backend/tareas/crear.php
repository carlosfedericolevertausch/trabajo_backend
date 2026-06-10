<?php

include("../conexion.php");
include("../usuarios/admin.php");

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
    INSERT INTO tareas
    (
    titulo,
    descripcion,
    estado,
    fecha_creacion,
    fecha_limite,
    id_usuario_asignado
    )
    VALUES
    (?, ?, ?, CURDATE(), ?, ?)
    ");

    $stmt->bind_param(
        "ssssi",
        $titulo,
        $descripcion,
        $estado,
        $fecha_limite,
        $id_usuario
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
Nueva Tarea
</div>

<div class="card-body">

<form method="POST">

<input type="text"
name="titulo"
placeholder="Título"
class="form-control mb-3"
required>

<textarea
name="descripcion"
class="form-control mb-3"
rows="4"
required></textarea>

<select
name="estado"
class="form-select mb-3">

<option>Pendiente</option>
<option>En Progreso</option>
<option>Completada</option>

</select>

<input
type="date"
name="fecha_limite"
class="form-control mb-3"
required>

<select
name="id_usuario"
class="form-select mb-3">

<?php while($u=$usuarios->fetch_assoc()){ ?>

<option value="<?= $u['id_usuario'] ?>">
<?= $u['nombre'] ?>
</option>

<?php } ?>

</select>

<button class="btn btn-success">
Guardar
</button>

</form>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>