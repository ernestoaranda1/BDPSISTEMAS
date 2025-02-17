<?php
require "seguridad.php";
require "conexion.php"; // Conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- HEAD HEAD HEAD -->
<?php 
  include("head.php");
?>
</head>
<body>
  <!-- CABEZERA -- CABEZERA CABEZERA -- CABEZERA CABEZERA -- CABEZERA CABEZERA -- CABEZERA -->
  <?php 
  include("cabezera.php");
  /* NEVAGACION */
  include("navegacion.php");
  ?>
  <!-- CONTENIDO -- CONTENIDO CONTENIDO -- CONTENIDO CONTENIDO -- CONTENIDO -->
<main class="ancho">
  <div class="principal">
    <div class="contenido">
      <!-- DATOS CUENTA -->
      <?php 
// Verificar si el id_Usuario está en la sesión
if (isset($_SESSION['id_Usuario'])) {
  // Si el id_Usuario está presente en la sesión
  $id_Usuario = $_SESSION['id_Usuario']; // Guardar el id del usuario desde la sesión
} else {
  // Si no está presente, redirigir al login
  echo '<script>alert("Por favor inicia sesión."); window.location.href = "inicio-Usuario.php";</script>';
}

$id_Usuario = $_SESSION['id_Usuario'];

// Consultar los datos del usuario logueado usando el ID de usuario
$query = "SELECT nombre, correo, telefono FROM usuarios WHERE id_Usuario = '$id_Usuario'";
$resultado = mysqli_query($conectar, $query);?>

<?php if ($usuario = mysqli_fetch_assoc($resultado)) {?>
  <div class="datos-Cuenta">
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Bienvenido</h2><br>
      <p><?php echo $usuario['nombre']; ?></p>
    </div>
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Teléfono</h2><br>
      <p><?php echo $usuario['telefono']; ?></p>
    </div>
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Correo</h2><br>
      <p><?php echo $usuario['correo']; ?></p>
    </div>
    <div class="cuenta__Nombre">
      <h2 class="subtitulo">Contraseña</h2><br>
        <!-- Botón para mostrar el formulario -->
      <button class="btn-formulario-gral" id="btn-mostrar-formulario">Cambiar Contraseña</button>
        <!-- Formulario oculto -->
      <div id="formulario-cambiar-contrasena">
          <form method="POST" action="actualizar-Contra.php">
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
  <?php
} else {
  echo "<p>Información del usuario no disponible.</p>";
} ?>

    <script>
        // Obtener los elementos del DOM
        const btnMostrarFormulario = document.getElementById('btn-mostrar-formulario');
        const formulario = document.getElementById('formulario-cambiar-contrasena');
        const btnCancelar = document.getElementById('btn-cancelar');

        // Añadir evento para mostrar el formulario
        btnMostrarFormulario.addEventListener('click', () => {
            btnMostrarFormulario.style.display = 'none'; // Ocultar el botón
            formulario.style.display = 'block';         // Mostrar el formulario
        });

        // Añadir evento para ocultar el formulario y mostrar nuevamente el botón
        btnCancelar.addEventListener('click', () => {
            formulario.style.display = 'none';          // Ocultar el formulario
            btnMostrarFormulario.style.display = 'inline-block'; // Mostrar el botón
        });
    </script>
</div>
</div>
    </div>
  </div>
</main>
  <!-- PIE DE PAGINA  -->
<?php include("pie-pag.php"); ?>
</body>
</html>