<?php
session_start();
require "conexion.php";

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT id_Usuario FROM usuarios WHERE correo = '$correo' AND password = '$password'";
$resultado = mysqli_query($conectar, $sql);

if ($usuario = mysqli_fetch_assoc($resultado)) {
    $_SESSION['id_Usuario'] = $usuario['id_Usuario'];
    $_SESSION['autenticado'] = "SI";
    echo '<script>
            alert("Sesión iniciada correctamente");
            window.location.href = "user_menu.php";
          </script>';
} else {
    echo '<script>
            alert("Correo o contraseña incorrectos");
            window.location.href = "inicio-Usuario.php";
          </script>';
}
?>
