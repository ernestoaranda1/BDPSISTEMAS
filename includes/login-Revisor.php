<?php
session_start();
require "conexion.php";

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT id_Revisor FROM revisores WHERE correo = '$correo' AND password = '$password'";
$resultado = mysqli_query($conectar, $sql);

if ($revisor = mysqli_fetch_assoc($resultado)) {
    $_SESSION['id_Revisor'] = $revisor['id_Revisor'];
    $_SESSION['autenticado'] = "SI";
    echo '<script>
            alert("Sesión iniciada correctamente");
            window.location.href = "revisor_menu.php";
          </script>';
} else {
    echo '<script>
            alert("Correo o contraseña incorrectos");
            window.location.href = "inicio-Revisor.php";
          </script>';
}
?>