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
  ?>
  <!-- CONTENIDO -->
<main class="principal ancho">

  <div class="formulario">
    <h2 class="subtitulo">Iniciar Sesión a su Jefatura</h2>

    <form action="login-jefatura.php" method="POST" class="formulario__Iniciosesion">
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button class="btn-formulario-gral" type="submit">Iniciar Sesión</button>
      
    </form>


    <div class="contenedor_registrate">
    <a href="../index.php" class="btn-acciones-gral">Atrás</a>
    </div>
  </div>
</main>
  <!-- PIE DE PAGINA -->
<?php include("pie-pag.php");?>
</body>
</html>