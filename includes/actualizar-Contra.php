<?php
require "conexion.php";
require "seguridad.php";


// Verificar si el formulario fue enviado
if (isset($_POST['cambiar_contraseña'])) {
  // Recolectar los datos del formulario
  $nueva_contraseña = mysqli_real_escape_string($conectar, $_POST['nueva_contraseña']);
  $confirmar_contraseña = mysqli_real_escape_string($conectar, $_POST['confirmar_contraseña']);

  // Validar que las contraseñas coincidan
  if ($nueva_contraseña === $confirmar_contraseña) {
      // Determinar de qué tabla proviene la sesión
      if (isset($_SESSION['id_Usuario'])) {
          $id = $_SESSION['id_Usuario'];
          $tabla = "usuarios";
          $campo_id = "id_Usuario";
      } elseif (isset($_SESSION['id_Revisor'])) {
          $id = $_SESSION['id_Revisor'];
          $tabla = "revisores";
          $campo_id = "id_Revisor";
      } elseif (isset($_SESSION['id_Jefatura'])) {
          $id = $_SESSION['id_Jefatura'];
          $tabla = "jefatura";
          $campo_id = "id_Jefatura";
      } else {
          echo '<script>alert("No se pudo identificar la sesión activa.");</script>';
          exit();
      }

      // Actualizar la contraseña en la tabla correspondiente
      $query_actualizar = "UPDATE $tabla SET password = '$nueva_contraseña' WHERE $campo_id = '$id'";

      if (mysqli_query($conectar, $query_actualizar)) {
          echo '<script>
                  alert("Contraseña actualizada correctamente.");
                  window.location.href = "user_menu.php";</script>';
      } else {
          echo '<script>alert("Error al actualizar la contraseña: ' . mysqli_error($conectar) . '");</script>';
      }
  } else {
      echo '<script>alert("Las contraseñas no coinciden. Intenta de nuevo.");</script>';
  }
}

// Cerrar la conexión
mysqli_close($conectar);?>