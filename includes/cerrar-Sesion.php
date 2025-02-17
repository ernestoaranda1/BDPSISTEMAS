<?php
session_start();

// Identificar la tabla desde la que se inició la sesión
if (isset($_SESSION['id_Usuario'])) {
    $redirect = "inicio-Usuario.php"; // Página de inicio de sesión para usuarios
} elseif (isset($_SESSION['id_Revisor'])) {
    $redirect = "inicio-Revisor.php"; // Página de inicio de sesión para revisores
} elseif (isset($_SESSION['id_Jefatura'])) {
    $redirect = "inicio-Jefatura.php"; // Página de inicio de sesión para jefaturas
} else {
    $redirect = "../index.php"; // Página predeterminada si no se identifica una sesión
}

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir a la vista de inicio de sesión correspondiente
echo '
    <script> 
      alert("SALIENDO DEL SISTEMA");
      location.href = "' . $redirect . '";
    </script>
  ';
exit();
?>
