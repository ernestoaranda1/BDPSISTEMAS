<?php 
session_start();
require "conexion.php";

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT id_Jefatura FROM jefatura WHERE correo = '$correo' AND password = '$password'";
$resultado = mysqli_query($conectar, $sql);

if ($jefatura = mysqli_fetch_assoc($resultado)) {
    $_SESSION['id_Jefatura'] = $jefatura['id_Jefatura'];
    $_SESSION['autenticado'] = "SI";
    echo '<script>
            alert("Sesión iniciada correctamente");
            window.location.href = "jefatura_menu.php";
          </script>';
} else {
    echo '<script>
            alert("Correo o contraseña incorrectos");
            window.location.href = "inicio-Jefatura.php";
          </script>';
}
?>