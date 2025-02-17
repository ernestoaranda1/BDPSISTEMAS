<?php 
require "conexion.php";

// Obtener los datos del formulario
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$password = $_POST["password"];

// Verificar si el usuario ya existe en la base de datos
$verificar_usuario = mysqli_query($conectar, "SELECT * FROM usuarios WHERE correo = '$correo'");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
    <script>
        alert("ESTE USUARIO YA ESTÁ REGISTRADO");
        location.href="registro.php";
    </script>
    ';
    exit;
}

// Insertar el nuevo usuario en la base de datos
$insertar = "INSERT INTO usuarios (nombre, apellido, correo, telefono, password) VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$password')";

$query = mysqli_query($conectar, $insertar);

if ($query) {
    echo "<script>
    alert('Registro exitoso');
    location.href='registro.php';
    </script>";
} else {
    echo "Inténtelo de nuevo";
}
?>
