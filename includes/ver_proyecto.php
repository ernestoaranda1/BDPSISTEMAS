<?php
require "conexion.php";
require "seguridad.php";
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
  /* NEVAGACION */
  include("navegacion.php");
  ?>
  <!-- CONTENIDO -->
<main class="ancho">
  <div class="principal">
    <div class="contenido">

      <?php
// Verificar que el usuario esté autenticado y que el ID del proyecto esté presente
if (!isset($_SESSION['id_Usuario']) || !isset($_GET['id_Proyecto'])) {
  echo 'id_Usuario: ' . $_SESSION['id_Usuario'] . '<br>';
  echo 'id_Proyecto: ' . $_GET['id_Proyecto'] . '<br>';
    echo "<p>Acceso no autorizado o falta de parámetros.</p>";
}

$id_Usuario = $_SESSION['id_Usuario'];
$id_Proyecto = $_GET['id_Proyecto'];

// Consulta SQL para obtener los detalles del proyecto
$sql = "SELECT * FROM proyectos WHERE id_Proyecto = '$id_Proyecto' AND id_Usuario = '$id_Usuario'";
$resultado = mysqli_query($conectar, $sql);

// Verificar si la consulta fue exitosa y si hay proyectos
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $proyecto = mysqli_fetch_assoc($resultado);
?>
    <h2 class="subtitulo">Detalles del Proyecto</h2><br>
    <p><strong>Nombre del Proyecto:</strong> <?php echo htmlspecialchars($proyecto['nombre_proyecto']); ?></p>
    <p><strong>Responsable del Proyecto:</strong> <?php echo htmlspecialchars($proyecto['responsable_proyecto']); ?></p>
    <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($proyecto['correo_electronico']); ?></p>
    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($proyecto['telefono']); ?></p>
    <p><strong>Objetivo:</strong> <?php echo htmlspecialchars($proyecto['objetivo']); ?></p>
    <p><strong>Justificación:</strong> <?php echo htmlspecialchars($proyecto['justificacion']); ?></p>
    <p><strong>Necesidad o Problema a Resolver:</strong> <?php echo htmlspecialchars($proyecto['necesidad_resolver']); ?></p>
    <p><strong>Actividades del Proyecto:</strong> <?php echo htmlspecialchars($proyecto['actividades_proyecto']); ?></p>
    <p><strong>Stack Tecnológico:</strong> <?php echo htmlspecialchars($proyecto['stack_tecnologico']); ?></p>
    <p><strong>Modalidad:</strong> <?php echo htmlspecialchars($proyecto['modalidad']); ?></p>
    <p><strong>Entidad:</strong> <?php echo htmlspecialchars($proyecto['entidad']); ?></p>
    <p><strong>Nombre de la Empresa o Institución:</strong> <?php echo htmlspecialchars($proyecto['nombre_empresa'] ?? $proyecto['nombre_institucion']); ?></p>
    <p><strong>RFC de la Empresa:</strong> <?php echo htmlspecialchars($proyecto['rfc_empresa']); ?></p>
    <p><strong>Giro:</strong> <?php 
    $giro_decoded = json_decode($proyecto['giro'], true); 
    if (is_array($giro_decoded) && !empty($giro_decoded)) {
        echo htmlspecialchars(implode(", ", $giro_decoded)); 
    } else {
        echo "";
    }
?></p>
    <p><strong>Página Web:</strong> <?php echo htmlspecialchars($proyecto['pagina_web']); ?></p>
    <p><strong>Número de Estudiantes Solicitados:</strong> <?php echo htmlspecialchars($proyecto['estudiantes_solicitados']); ?></p>
    <p><strong>Asesor Interno:</strong>
          <?= htmlspecialchars($proyecto['interno_asesor'] ?: 'No especificado') ?>
        </p>
    <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($proyecto['especialidad']); ?></p>
    <p><strong>Periodo:</strong> <?php echo htmlspecialchars($proyecto['periodo']); ?></p>
    <p><strong>Competencias Requeridas:</strong> <?php echo htmlspecialchars($proyecto['competencias_requeridas']); ?></p>
    <p><strong>Apoyo al Alumno:</strong> <?php echo htmlspecialchars($proyecto['apoyo']); ?></p>
    <p><strong>Tipo de Apoyo:</strong> <?php echo htmlspecialchars($proyecto['tipo_apoyo']); ?></p>
    <p><strong>Observaciones Adicionales:</strong> <?php echo htmlspecialchars($proyecto['observaciones_adicionales4']); ?></p>
<?php
} else {
    echo "<p>Proyecto no encontrado o no autorizado para ver este proyecto.</p>";
}

mysqli_close($conectar);
?>

<br>
<a href="vista_propuestas.php" class="btn-acciones-gral">Propuestas</a>
    
</div>
  </div>
</main>
  <!-- PIE DE PAGINA -->
  <?php 
  include("pie-pag.php");
?>

</body>