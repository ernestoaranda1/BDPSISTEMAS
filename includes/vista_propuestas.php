<?php
require "seguridad.php";
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
      <h2 class="subtitulo">Tus propuestas</h2><br>
      <?php
// Verificar si el usuario está logueado
if (!isset($_SESSION['id_Usuario'])) {
    echo '<script>alert("Por favor inicia sesión para ver tus proyectos."); window.location.href = "inicio-Usuario.php";</script>';
    exit;
}

// Obtener el id del usuario de la sesión
$id_Usuario = $_SESSION['id_Usuario'];

// Conexión a la base de datos
require "conexion.php";  

// Consulta para obtener los proyectos del usuario actual
$sql = "SELECT id_Proyecto, nombre_proyecto, responsable_proyecto, objetivo FROM proyectos WHERE id_Usuario = '$id_Usuario'";

// Ejecutar la consulta y verificar si se ejecutó correctamente
$resultado = mysqli_query($conectar, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    // Si hay un error, mostrarlo
    echo "Error en la consulta SQL: " . mysqli_error($conectar);
    exit;
}

// Verificar si el usuario tiene proyectos
if (mysqli_num_rows($resultado) > 0) {
?>
    <?php while ($proyecto = mysqli_fetch_assoc($resultado)): ?>
      <div class="contenido__proyectos">
        <div class="proyectos-id-nombre">
          <div class="id-nombre-1">
              <h2>ID:</h2>
              <p><?php echo ($proyecto['id_Proyecto']); ?></p>
          </div>
          <div class="id-nombre-2">
              <h2>Nombre del proyecto:</h2>
              <p><?php echo ($proyecto['nombre_proyecto']); ?></p>
          </div>
        </div>
        <div class="proyectos-objetivo">
          <h2>Objetivo:</h2>
          <p><?php echo ($proyecto['objetivo']); ?></p>
        </div>
        <div class="proyectos-general">
          <div class="proyectos-general-1">
            <a class="btn-acciones-gral" href="ver_proyecto.php?id_Proyecto=<?php echo $proyecto['id_Proyecto']; ?>">Ver Detalles</a>
          </div>
        </div>
      </div><br>
      <?php endwhile; ?>
<?php
} else {
    echo "<p>No tienes proyectos registrados.</p>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conectar);
?>

    </div>
  </div>
</main>
  <!-- PIE DE PAGINA -- PIE DE PAGINA PIE DE PAGINA -- PIE DE PAGINA PIE DE PAGINA -- PIE -->
  <?php 
  include("pie-pag.php");
?>
</body>
</html>