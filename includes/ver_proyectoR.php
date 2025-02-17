<?php
require "seguridad2.php";
require "conexion.php";
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
  include("navegacionR.php");
  ?>
  <!-- CONTENIDO -->
<main class="ancho">
  <div class="principal">
    <div class="contenido">
      <h2 class="subtitulo">Detalle del proyecto</h2><br>
    
    <?php
// Verificar si se recibió el ID del proyecto
if (!isset($_GET['id_Proyecto']) || empty($_GET['id_Proyecto'])) {
    die("ID de proyecto no especificado.");
}

$id_Proyecto = intval($_GET['id_Proyecto']); // Sanitizar el ID del proyecto

// Consulta para obtener los detalles del proyecto
$sql = "SELECT * FROM proyectos WHERE id_Proyecto = $id_Proyecto";
$resultado = mysqli_query($conectar, $sql);

if (!$resultado) {
    die("Error en la consulta SQL: " . mysqli_error($conectar));
}

// Verificar si el proyecto existe
if (mysqli_num_rows($resultado) === 0) {
    die("Proyecto no encontrado.");
}
$id_Revisor = $_SESSION['id_Revisor'];

// Verificar si el revisor ya está inscrito en el proyecto
$consulta_inscripcion = "SELECT * FROM proyecto_revisores WHERE id_Proyecto = $id_Proyecto AND id_Revisor = $id_Revisor";
$resultado_inscripcion = mysqli_query($conectar, $consulta_inscripcion);

$inscrito = mysqli_num_rows($resultado_inscripcion) > 0;

// Verificar si ya existe una evaluación para este proyecto por este revisor
$consulta_evaluacion = "SELECT er.*, r.nombre AS nombre_revisor, r.correo AS correo_revisor
                        FROM evaluaciones_revisores er
                        INNER JOIN revisores r ON er.id_Revisor = r.id_Revisor
                        WHERE er.id_Proyecto = $id_Proyecto AND er.id_Revisor = $id_Revisor";
$resultado_evaluacion = mysqli_query($conectar, $consulta_evaluacion);
$evaluacion_realizada = mysqli_num_rows($resultado_evaluacion) > 0;

// Obtener los datos del proyecto
$proyecto = mysqli_fetch_assoc($resultado);
?>
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
    <p><strong>Giro:</strong> <?php $giro_decoded = json_decode($proyecto['giro'], true); 
    if (is_array($giro_decoded) && !empty($giro_decoded)) {
        echo htmlspecialchars(implode(", ", $giro_decoded)); 
    } else {
        echo "";
    } ?></p>
    <p><strong>Página Web:</strong> <?php echo htmlspecialchars($proyecto['pagina_web']); ?></p>
    <p><strong>Número de Estudiantes Solicitados:</strong> <?php echo htmlspecialchars($proyecto['estudiantes_solicitados']); ?></p>
    <p><strong>Asesor Interno:</strong>
          <?= htmlspecialchars($proyecto['interno_asesor'] ?: 'No especificado') ?>
        </p>
    <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($proyecto['especialidad']); ?></p>
    <p><strong>Período:</strong> <?php echo htmlspecialchars($proyecto['periodo']); ?></p>
    <p><strong>Competencias Requeridas:</strong> <?php echo htmlspecialchars($proyecto['competencias_requeridas']); ?></p>
    <p><strong>Apoyo al Alumno:</strong> <?php echo htmlspecialchars($proyecto['apoyo']); ?></p>
    <p><strong>Tipo de Apoyo:</strong> <?php echo htmlspecialchars($proyecto['tipo_apoyo']); ?></p>
    <p><strong>Observaciones Adicionales:</strong> <?php echo htmlspecialchars($proyecto['observaciones_adicionales4']); ?></p>
        
<!-- Revisores -->
    <br>
    <section class="evaluar-Revisores">
  <?php if (!$inscrito): ?>
        <!-- Mostrar botón para inscribirse si no está inscrito -->
        <article class="evaluar__BotonContenedor">
          <form method="POST" action="inscribir_Revisor.php">
              <input type="hidden" name="id_Proyecto" value="<?php echo $proyecto['id_Proyecto']; ?>">
              <button type="submit" class="btn-formulario-gral">Quiero ser revisor</button>
          </form>
        </article>

    <?php elseif ($evaluacion_realizada): ?>
      <!-- Mostrar información de la evaluación realizada -->
        <?php $evaluacion = mysqli_fetch_assoc($resultado_evaluacion); ?>
          <article class="evaluar__Formulario">
            <h2>Evaluación Realizada</h2>
            <div class="cuenta__Nombre">
              <p><strong>Nombre del Revisor:</strong><br>
              <?php echo htmlspecialchars($evaluacion['nombre_revisor']); ?></p>
            </div>
            <div class="cuenta__Nombre">
            <p><strong>Correo del Revisor:</strong>
            <br> <?php echo htmlspecialchars($evaluacion['correo_revisor']); ?></p>
            </div>
            <div class="cuenta__Nombre">
            <p><strong>Fecha de Evaluación:</strong>
            <br> <?php echo htmlspecialchars($evaluacion['fecha_evaluacion']); ?></p>
            </div>
            <div class="cuenta__Nombre">
            <p><strong>Veredicto:</strong><br>
             <?php echo htmlspecialchars($evaluacion['veredicto']); ?></p>
            </div>
            <div class="cuenta__Nombre">
            <p><strong>Comentarios:</strong><br>
             <?php echo htmlspecialchars($evaluacion['comentarios']); ?></p>
            </div>
          </article>
    <?php else: ?>

        <!-- Mostrar formulario de evaluación si ya está inscrito pero no ha evaluado -->
        <article class="evaluar__Formulario">
          <h2>Formulario de Evaluación</h2>
          <form method="POST" action="guardar_Evaluacion.php">
              <input type="hidden" name="id_Proyecto" value="<?php echo $id_Proyecto; ?>">
              <input type="hidden" name="id_Revisor" value="<?php echo $id_Revisor; ?>">

              <label for="veredicto">Veredicto:</label>
              <select name="veredicto" id="veredicto" required>
                  <option value="Aprobado">Aprobado</option>
                  <option value="No aprobado">No aprobado</option>
                  <option value="Aprobado con comentarios">Aprobado con comentarios</option>
              </select><br><br>

              <label for="comentarios">Comentarios:</label>
              <textarea name="comentarios" id="comentarios" placeholder="Escribe tus comentarios..." required></textarea>

              <button type="submit" class="btn-formulario-gral">Guardar Evaluación</button>
          </form>
        </article>
    <?php endif; ?>
  </section><br>
  <a href="vista_propuestasR.php" class="btn-acciones-gral">Regresar</a>
    </div>
  </div>
</main>
<script src="../js/textarea.js"></script>
  <!-- PIE DE PAGINA -->
  <?php 
    include("pie-pag.php");
  ?>

</body>