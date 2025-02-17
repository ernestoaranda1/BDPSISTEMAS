<?php require "seguridad2.php"; require "conexion.php"; // Conexión a la base de datos ?>
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
  /* NEVAGACION */
  include("navegacionR.php");
  ?>
  <!-- CONTENIDO -->
<main class="ancho">
  <div class="principal">
    <div class="contenido">
      <section class="contenedor-proyectos">
        <h2 class="subtitulo">Lista de Proyectos</h2><br>

        <?php
// Consulta para obtener los proyectos con el conteo de revisores
$sql = "SELECT 
            p.id_Proyecto,
            p.nombre_proyecto,
            p.objetivo,
            p.especialidad,
            COUNT(pr.id_Revisor) AS num_revisores
        FROM  
            proyectos p
        LEFT JOIN 
            proyecto_revisores pr ON p.id_Proyecto = pr.id_Proyecto
        GROUP BY 
            p.id_Proyecto
        ORDER BY 
            p.id_Proyecto DESC";

$resultado = mysqli_query($conectar, $sql);

if (!$resultado) {
    die("Error en la consulta SQL: " . mysqli_error($conectar));
}
// Mostrar los resultados
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
            <h2>Especialidad:</h2>
            <p><?php echo ($proyecto['especialidad']); ?></p>
          </div>
          <div class="proyectos-general-1">
            <h2>Revisores:</h2>
            <p><?php echo ($proyecto['num_revisores']); ?>/3</p>
          </div>
          <div class="proyectos-general-1">
            <a class="btn-acciones-gral" href="ver_proyectoR.php?id_Proyecto=<?php echo $proyecto['id_Proyecto']; ?>">Ver Detalles</a>
          </div>
        </div>
      </div><br>
      <?php endwhile; ?>
      </section>
    </div>
  </div>
</main>
  <!-- PIE DE PAGINA -->
<?php 
  include("pie-pag.php");
?>
</body>
</html>