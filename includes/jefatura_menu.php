<?php
require 'seguridad_jefatura.php';
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- HEAD -->
<?php 
  include("head.php");
?>
</head>
<body>
  <!-- CABEZERA -->
  <?php 
  include("cabezera.php");
  include("navegacion-Jefatura.php")
  ?>
  <main class="ancho">
  <div class="principal">
    <div class="contenido">
        <?php 
// Verificar si el id_Usuario está en la sesión
if (isset($_SESSION['id_Jefatura'])) {
  // Si el id_Usuario está presente en la sesión
  $id_Jefatura = $_SESSION['id_Jefatura']; 
} else {
  // Si no está presente, redirigir al login
  echo '<script>alert("Por favor inicia sesión."); window.location.href = "inicio-Jefatura.php";</script>';
}

$id_Jefatura = $_SESSION['id_Jefatura'];

// Consultar los datos del usuario logueado usando el ID de usuario
$query = "SELECT * FROM jefatura WHERE id_Jefatura = '$id_Jefatura'";
$resultado = mysqli_query($conectar, $query);?>

<?php  if ($jefe = mysqli_fetch_assoc($resultado)) {?>
  <div class="datos-Cuenta">
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Bienvenido Jefe</h2><br>
      <p><?php echo $jefe['nombre']; ?></p>
    </div>
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Correo</h2><br>
      <p><?php echo $jefe['correo']; ?></p>
    </div>
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Contraseña</h2><br>
        <!-- Botón para mostrar el formulario -->
      <button class="btn-formulario-gral" id="btn-mostrar-formulario">Cambiar Contraseña</button>
        <!-- Formulario oculto -->
      <div id="formulario-cambiar-contrasena">
          <form method="POST" action="actualizar-ContraJ.php">
              <label for="nueva_contraseña">Nueva Contraseña:</label>
              <input type="password" id="nueva_contraseña" name="nueva_contraseña" required>

              <label for="confirmar_contraseña">Confirmar Nueva Contraseña:</label>
              <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>

              <button type="submit" class="btn-formulario-gral" name="cambiar_contraseña">Guardar Cambios</button>
              <!-- Botón para cancelar -->
              <button type="button" class="btn-formulario-cancelar" id="btn-cancelar">Cancelar</button>
          </form>
      </div>
    </div>
  </div>
<?php  } else {
  echo "<p>Información del revisor no disponible.</p>";
}?>

        <script src="../js/formulario-contrasena.js"></script>

    </div>
  </div>
</main>
<!-- Pie de pagina -->
<?php 
  include("pie-pag.php");
?>
</body>
</html>

