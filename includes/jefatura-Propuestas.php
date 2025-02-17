<?php
include 'seguridad_jefatura.php';
include 'conexion.php';
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
      <section class="contenedor-proyectos">
    <h2 class="subtitulo">Lista de Proyectos</h2><br>

    <?php
    // Consulta para proyectos con exactamente 3 revisores
    $query_exactly_3 = "SELECT 
                p.id_Proyecto, 
                p.nombre_proyecto, 
                COUNT(pr.id_Revisor) AS total_revisores
            FROM 
                proyectos p
            LEFT JOIN 
                proyecto_revisores pr ON p.id_Proyecto = pr.id_Proyecto
            GROUP BY 
                p.id_Proyecto
            HAVING 
                total_revisores = 3";

    $result_exactly_3 = $conectar->query($query_exactly_3);
    ?>

    <h2>Proyectos con 3 Revisores</h2>
    <?php if ($result_exactly_3->num_rows > 0): ?>
        <?php while ($proyecto = $result_exactly_3->fetch_assoc()): ?>
            <div class="contenido__proyectos">
                <div class="proyectos-id-nombre">
                    <div class="id-nombre-1">
                        <h2>ID:</h2>
                        <p><?php echo $proyecto['id_Proyecto']; ?></p>
                    </div>
                    <div class="id-nombre-2">
                        <h2>Nombre del proyecto:</h2>
                        <p><?php echo $proyecto['nombre_proyecto']; ?></p>
                    </div>
                </div>
                <div class="proyectos-general">
                    <div class="proyectos-general-1">
                        <h2>Revisores:</h2>
                        <p>3/3</p>
                    </div>
                    <div class="proyectos-general-1">
                        <a class="btn-acciones-gral" href="detalle_proyecto.php?id_Proyecto=<?php echo $proyecto['id_Proyecto']; ?>">Ver Detalles</a>
                    </div>
                </div>
            </div><br>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay proyectos con 3 revisores.</p>
    <?php endif; ?>

    <?php
    // Consulta para proyectos sin revisores
    $query_no_revisores = "SELECT 
                p.id_Proyecto, 
                p.nombre_proyecto
            FROM 
                proyectos p
            LEFT JOIN 
                proyecto_revisores pr ON p.id_Proyecto = pr.id_Proyecto
            WHERE 
                pr.id_Proyecto IS NULL";

    $result_no_revisores = $conectar->query($query_no_revisores);
    ?>

    <h2>Proyectos sin Revisores</h2>
    <?php if ($result_no_revisores->num_rows > 0): ?>
        <?php while ($proyecto = $result_no_revisores->fetch_assoc()): ?>
            <div class="contenido__proyectos">
                <div class="proyectos-id-nombre">
                    <div class="id-nombre-1">
                        <h2>ID:</h2>
                        <p><?php echo $proyecto['id_Proyecto']; ?></p>
                    </div>
                    <div class="id-nombre-2">
                        <h2>Nombre del proyecto:</h2>
                        <p><?php echo $proyecto['nombre_proyecto']; ?></p>
                    </div>
                </div>
                <div class="proyectos-general">
                    <div class="proyectos-general-1">
                        <h2>Revisores:</h2>
                        <p>0/3</p>
                    </div>
                    <div class="proyectos-general-1">
                        <a class="btn-acciones-gral" href="detalle_proyecto.php?id_Proyecto=<?php echo $proyecto['id_Proyecto']; ?>">Ver Detalles</a>
                    </div>
                </div>
            </div><br>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay proyectos sin revisores.</p>
    <?php endif; ?>

    <?php
    // Consulta para proyectos con menos de 3 revisores
    $query_less_than_3 = "SELECT 
                p.id_Proyecto, 
                p.nombre_proyecto, 
                COUNT(pr.id_Revisor) AS total_revisores
            FROM 
                proyectos p
            LEFT JOIN 
                proyecto_revisores pr ON p.id_Proyecto = pr.id_Proyecto
            GROUP BY 
                p.id_Proyecto
            HAVING 
                total_revisores > 0 AND total_revisores < 3";

    $result_less_than_3 = $conectar->query($query_less_than_3);
    ?>

    <h2>Proyectos con menos de 3 Revisores</h2>
    <?php if ($result_less_than_3->num_rows > 0): ?>
        <?php while ($proyecto = $result_less_than_3->fetch_assoc()): ?>
            <div class="contenido__proyectos">
                <div class="proyectos-id-nombre">
                    <div class="id-nombre-1">
                        <h2>ID:</h2>
                        <p><?php echo $proyecto['id_Proyecto']; ?></p>
                    </div>
                    <div class="id-nombre-2">
                        <h2>Nombre del proyecto:</h2>
                        <p><?php echo $proyecto['nombre_proyecto']; ?></p>
                    </div>
                </div>
                <div class="proyectos-general">
                    <div class="proyectos-general-1">
                        <h2>Revisores:</h2>
                        <p><?php echo $proyecto['total_revisores']; ?>/3</p>
                    </div>
                    <div class="proyectos-general-1">
                        <a class="btn-acciones-gral" href="detalle_proyecto.php?id_Proyecto=<?php echo $proyecto['id_Proyecto']; ?>">Ver Detalles</a>
                    </div>
                </div>
            </div><br>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay proyectos con menos de 3 revisores.</p>
    <?php endif; ?>

    <br><br>
    <div>
        <a href="exportar_excel.php" class="btn-acciones-gral">Descargar Excel</a>
    </div>
</section>


    </div>
  </div>


</main>
<!-- Pie de pagina -->
<?php 
  include("pie-pag.php");
?>
</body>
</html>

