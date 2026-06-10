<?php
session_start();

if(isset($_SESSION['id_usuario'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Login</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="css/estilo.css">

</head>

<body>

<div class="container login-container d-flex justify-content-center align-items-center">

<div class="card shadow login-card">

<div class="card-body p-4">

<h2 class="text-center mb-4">
Iniciar Sesión
</h2>

<?php

if(isset($_SESSION['error'])){

echo '<div class="alert alert-danger">'
     . $_SESSION['error'] .
     '</div>';

unset($_SESSION['error']);

}

?>

<form action="validar.php" method="POST">

<div class="mb-3">

<label>
Correo
</label>

<input
type="email"
name="correo"
class="form-control"
required>

</div>

<div class="mb-3">

<label>
Contraseña
</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-primary w-100">

Ingresar

</button>

</form>

</div>

</div>

</div>

</body>

</html>