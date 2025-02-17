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
  ?>
  <!-- CONTENIDO -- CONTENIDO CONTENIDO -- CONTENIDO CONTENIDO -- CONTENIDO -->
<main class="principal ancho">

  <div class="formulario">
    <h2 class="subtitulo">Iniciar Sesión Usuario</h2>

    <form action="login-Usuario.php" method="POST" class="formulario__Iniciosesion">
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button class="btn-formulario-gral" type="submit">Iniciar Sesión</button>
    </form>

    <div class="contenedor_registrate">
      <p>¿No tienes una cuenta?</p>
      <a href="registro.php" class="btn-acciones-gral">Regístrate</a>
      <a href="../index.php" class="btn-acciones-gral">Atrás</a>
    </div>
  </div>
</main>
  <!-- PIE DE PAGINA -- PIE DE PAGINA PIE DE PAGINA -- PIE DE PAGINA PIE DE PAGINA -- PIE -->
<?php include("pie-pag.php");?>
</body>
</html>