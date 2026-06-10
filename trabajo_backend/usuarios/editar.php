<?php

include("../conexion.php");
include("admin.php");

$id = $_GET['id'];

$usuario = $conn->query(
"SELECT * FROM usuarios WHERE id_usuario=$id"
)->fetch_assoc();

$roles = $conn->query(
"SELECT * FROM roles"
);

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $id_rol = $_POST['id_rol'];

    $stmt = $conn->prepare("
    UPDATE usuarios
    SET nombre=?,
        correo=?,
        id_rol=?
    WHERE id_usuario=?
    ");

    $stmt->bind_param(
        "ssii",
        $nombre,
        $correo,
        $id_rol,
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
Editar Usuario
</div>

<div class="card-body">

<form method="POST">

<input type="text"
name="nombre"
value="<?= $usuario['nombre'] ?>"
class="form-control mb-3">

<input type="email"
name="correo"
value="<?= $usuario['correo'] ?>"
class="form-control mb-3">

<select
name="id_rol"
class="form-select mb-3">

<?php while($r=$roles->fetch_assoc()){ ?>

<option
value="<?= $r['id_rol'] ?>"
<?= $r['id_rol']==$usuario['id_rol'] ? 'selected' : '' ?>>

<?= $r['nombre_rol'] ?>

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