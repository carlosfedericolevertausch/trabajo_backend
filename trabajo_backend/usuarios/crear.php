<?php

include("../conexion.php");
include("admin.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $id_rol = $_POST["id_rol"];

    $stmt = $conn->prepare("
        INSERT INTO usuarios
        (nombre, correo, password, id_rol)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssi",
        $nombre,
        $correo,
        $password,
        $id_rol
    );

    $stmt->execute();

    header("Location: listar.php");
    exit();
}

$roles = $conn->query("SELECT * FROM roles");

include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="main-content">

<div class="card">
<div class="card-header">Nuevo Usuario</div>

<div class="card-body">

<form method="POST">

<input type="text" name="nombre"
class="form-control mb-3"
placeholder="Nombre" required>

<input type="email" name="correo"
class="form-control mb-3"
placeholder="Correo" required>

<input type="password" name="password"
class="form-control mb-3"
placeholder="Contraseña" required>

<select name="id_rol"
class="form-select mb-3">

<?php while($r=$roles->fetch_assoc()){ ?>
<option value="<?= $r['id_rol'] ?>">
<?= $r['nombre_rol'] ?>
</option>
<?php } ?>

</select>

<button class="btn btn-success">
Guardar
</button>

<a href="listar.php"
class="btn btn-secondary">
Cancelar
</a>

</form>

</div>
</div>

</div>

<?php include("../includes/footer.php"); ?>