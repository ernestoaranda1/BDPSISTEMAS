<!DOCTYPE html>
<html lang="en">
<head>
  <!-- HEAD-->
  <?php 
    include("head.php");
  ?>
</head>
  <!-- CABEZERA -->
  <?php 
    include("cabezera.php");
  ?>
  <!-- CONTENIDO -->
<main class="principal ancho">
  <div class="formulario">
    <h2 class="subtitulo">Registro de Usuario</h2>
    <form action="guardar-Usuario.php" method="post" class="form-Nuevo-registro">
        <label for="nombre">Nombres:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="apellido">Apellido Paterno:</label>
        <input type="text" id="apellido" name="apellido" required>
        
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        
        <label for="telefono">Teléfono o Celular:</label>
        <input type="tel" id="telefono" name="telefono" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        
        <input class="btn-formulario-gral" type="submit" value="Registrarse">
    </form>

    <div class="contenedor_registrate">
        <p>¿Ya te registraste?</p>
        <a href="inicio-Usuario.php" class="btn-acciones-gral">Inicia Sesión</a>
    </div>
</div>
</main>
  <!-- PIE DE PAGINA -->
  <?php 
  include("pie-pag.php");
?>
</body>
</html>