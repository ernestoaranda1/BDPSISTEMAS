<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="BDP SISTEMAS">
  <meta property="og:description" content="Banco de Proyectos para Residencias Profesionales del ITM">
  <meta property="og:url" content="url de la pagina">
  <meta property="og:type" content="website" />
  <link rel="stylesheet" href="css/menu-Principal.css">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/tablet.css">
  <link rel="stylesheet" href="css/movil.css">
  <link rel="shortcut icon" href="img/Logo_del_Instituto_Tecnológico_de_Mérida1.svg">

  <script src='https://kit.fontawesome.com/9e8b9a5f20.js' crossorigin='anonymous'></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <title>BDP SISTEMAS</title>
</head>
<body>
  <!-- CABEZERA -->
  <header class="cabezera ancho">
    <div class="inicio_cabezera">
        <figure>    
          <img class="logo_itm" src="img/Logo_del_Instituto_Tecnológico_de_Mérida.svg" alt="">
        </figure>
      <div>
        <h1 class="titulo">Banco de Proyectos de Residencias Profesionales</h1>
      </div>
    </div>
  </header>
  <!-- CONTENIDO -->
<main class="principal ancho contenedor-menus">
<h2 class="subtitulo">Bienvenido, seleccione según sea su perfil</h2>
<br><br>
<section>
      <article>
        <a href="includes/inicio-Usuario.php">
        <i class="fa-solid fa-user"></i><br><br>
        <h2>Usuario</h2>
        </a>
      </article>
      <article>
        <a href="includes/inicio-Revisor.php">
          <i class="fa-duotone fa-solid fa-comments"></i><br><br>
          <h2>Revisores</h2>
        </a>
      </article>
      <article>
        <a href="includes/inicio-Jefatura.php">
          <i class="fa-solid fa-users-between-lines"></i><br><br>
          <h2>Jefaturas</h2>
        </a>
      </article>
      <article>
        <a href="#">
          <i class="fa-solid fa-user-gear"></i><br><br>
          <h2>Administrador</h2>
        </a>
      </article>
    </section>
  
</main>
  <!-- PIE DE PAGINA -->
<?php include("includes/pie-pag.php");?>
</body>
</html>