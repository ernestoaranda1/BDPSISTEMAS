<?php 
require 'seguridad_jefatura.php';
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- HEAD -->
  <?php include("head.php");?>
</head>
<body>
  <!-- CABEZERA  -->
  <?php 
  include("cabezera.php");
  /* NEVAGACION */
  include("navegacion-Jefatura.php");
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
// Obtener los datos del proyecto
$proyecto = mysqli_fetch_assoc($resultado);

// Consulta para obtener los revisores y sus evaluaciones del proyecto
$consulta_revisores = "SELECT er.*, r.nombre AS nombre_revisor, r.correo AS correo_revisor
                        FROM evaluaciones_revisores er
                        INNER JOIN revisores r ON er.id_Revisor = r.id_Revisor
                        WHERE er.id_Proyecto = $id_Proyecto";
$resultado_revisores = mysqli_query($conectar, $consulta_revisores);
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
    <section class="contenedor-Revisores">
    <!-- Revisores Asignados y Evaluaciones -->
        <h2 class="subtitulo">Revisores y evaluaciones</h2>
        <?php if (mysqli_num_rows($resultado_revisores) > 0): ?>
            <article>
                <?php while ($evaluacion = mysqli_fetch_assoc($resultado_revisores)): ?>
                    <div class="revisores__Datos">
                        <div class="revisor-Nombre">
                            <p><strong>Nombre del Revisor:</strong><br>
                            <?php echo htmlspecialchars($evaluacion['nombre_revisor']); ?></p>
                        </div>
                        <div class="revisor-Nombre">
                            <p><strong>Correo del Revisor:</strong>
                            <br> <?php echo htmlspecialchars($evaluacion['correo_revisor']); ?></p>
                        </div>
                        <div class="revisor-Nombre">
                            <p><strong>Fecha de Evaluación:</strong>
                            <br> <?php echo htmlspecialchars($evaluacion['fecha_evaluacion']); ?></p>
                        </div>
                        <div class="revisor-Nombre">
                            <p><strong>Veredicto:</strong><br>
                            <?php echo htmlspecialchars($evaluacion['veredicto']); ?></p>
                        </div>
                        <div class="revisor-Nombre">
                            <p><strong>Comentarios:</strong><br>
                            <?php echo htmlspecialchars($evaluacion['comentarios']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </article><br>
        <?php else: ?>
            <p>No hay revisiones registradas para este proyecto.</p><br>
        <?php endif; ?>
</section>

<?php 
$id_Jefatura = $_SESSION['id_Jefatura']; // ID del usuario evaluador
$id_Proyecto = $_GET['id_Proyecto']; // ID del proyecto a evaluar

// Recuperar información de la evaluación (si ya se realizó)
$query_evaluacion = "SELECT e.veredicto, e.comentarios, e.fecha_evaluacion, j.nombre 
                    FROM evaluaciones_finales e
                    INNER JOIN jefatura j ON e.id_Jefatura = j.id_Jefatura
                    WHERE e.id_Proyecto = ?";

$stmt_eval = $conectar->prepare($query_evaluacion);
$stmt_eval->bind_param('i', $id_Proyecto);
$stmt_eval->execute();
$stmt_eval->bind_result($veredicto, $comentarios, $fecha_evaluacion, $nombre_evaluador);
$stmt_eval->fetch();
$stmt_eval->close();

// Guardar la evaluación en un array si existen datos
$evaluacion = ($veredicto) ? [
    'veredicto' => $veredicto,
    'comentarios' => $comentarios,
    'fecha_evaluacion' => $fecha_evaluacion,
    'nombre_evaluador' => $nombre_evaluador
] : null;


// Recuperar detalles del proyecto
$query_proyecto = "SELECT estudiantes_solicitados, interno_asesor FROM proyectos WHERE id_Proyecto = ?";
$stmt_proyecto = $conectar->prepare($query_proyecto);
$stmt_proyecto->bind_param('i', $id_Proyecto);
$stmt_proyecto->execute();
$stmt_proyecto->bind_result($estudiantes_solicitados, $interno_asesor);
$stmt_proyecto->fetch();
$stmt_proyecto->close();

// Guardar los datos del proyecto en un array
$proyecto = [
    'estudiantes_solicitados' => $estudiantes_solicitados,
    'interno_asesor' => $interno_asesor
];

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $veredicto_final = $_POST['veredicto_final'];
    $comentarios_final = $_POST['comentarios_final'];
    $estudiantes_actualizados = intval($_POST['estudiantes_solicitados']);
    $asesor_interno_actualizado = $_POST['interno_asesor'];

    if (empty($veredicto_final) || empty($comentarios_final)) {
        echo '<script>alert("Todos los campos son obligatorios"); window.location.href = "detalle_proyecto.php?id_Proyecto=' . $id_Proyecto . '";</script>';
    } else {

        // Actualizar el proyecto
        $query_update_proyecto = "UPDATE proyectos 
                                  SET estudiantes_solicitados = ?, interno_asesor = ? 
                                  WHERE id_Proyecto = ?";
        $stmt_update = $conectar->prepare($query_update_proyecto);
        $stmt_update->bind_param('isi', $estudiantes_actualizados, $asesor_interno_actualizado, $id_Proyecto);
        $stmt_update->execute();
        $stmt_update->close();

        // Insertar la evaluación final
        $query_insert_evaluacion = "INSERT INTO evaluaciones_finales (id_Proyecto, id_Jefatura, veredicto, comentarios, fecha_evaluacion) 
                                    VALUES (?, ?, ?, ?, NOW())";
        $stmt_insert_evaluacion = $conectar->prepare($query_insert_evaluacion);
        $stmt_insert_evaluacion->bind_param('iiss', $id_Proyecto, $id_Jefatura, $veredicto_final, $comentarios_final);

        if ($stmt_insert_evaluacion->execute()) {
            echo '<script>alert("Evaluacion guardada correctamente."); window.location.href = "detalle_proyecto.php?id_Proyecto=' . $id_Proyecto . '";</script>';
        } else {
            die("Error al guardar la evaluación: " . $stmt_insert_evaluacion->error);
        }
        $stmt_insert_evaluacion->close();
    }
}
?>
<h2 class="subtitulo">Evaluación Final</h2>
<?php if ($evaluacion): ?>
    <div class="datos-Cuenta" id="respuestas-evaluacion" style="display: block;">
        <p><strong>Veredicto Final:</strong> <?= htmlspecialchars($evaluacion['veredicto']) ?></p>
        <p><strong>Comentarios Finales:</strong> <?= htmlspecialchars($evaluacion['comentarios']) ?></p>
        <p><strong>Estudiantes Solicitados:</strong> <?= htmlspecialchars($proyecto['estudiantes_solicitados']) ?></p>
        <p><strong>Asesor Interno:</strong> <?= htmlspecialchars($proyecto['interno_asesor']) ?></p>
        <p><strong>Evaluado por:</strong> <?= htmlspecialchars($evaluacion['nombre_evaluador']) ?></p>
        <p><strong>Fecha de Evaluación:</strong> <?= htmlspecialchars($evaluacion['fecha_evaluacion']) ?></p>
    </div>

<?php else: ?>
    <button class="btn-formulario-gral" id="btn-mostrar-formulario">Realizar Evaluación Final</button><br>
    <div id="formulario-evaluacion" class="evaluar__Formulario">
        <h3 class="subtitulo">Formulario de Evaluación Final</h3>
        <form method="POST">
            <label for="veredicto_final">Veredicto Final:</label>
            <select name="veredicto_final" id="veredicto_final" required>
                <option value="Aprobado">Aprobado</option>
                <option value="No aprobado">No aprobado</option>
                <option value="Aprobado con comentarios">Aprobado con comentarios</option>
            </select>
            <label for="comentarios_final">Comentarios Finales:</label>
            <textarea id="comentarios_final" name="comentarios_final" value="Si no tiene comentarios escriba N/A" required></textarea>
            <label for="estudiantes_solicitados">Estudiantes Solicitados:</label>
            <input required type="number" id="estudiantes_solicitados" name="estudiantes_solicitados"
                value="<?= htmlspecialchars($proyecto['estudiantes_solicitados'] ?: '') ?>">


            <label for="interno_asesor">Asesor Interno:</label>
            <input type="text" id="interno_asesor" name="interno_asesor"
                value="<?= htmlspecialchars($proyecto['interno_asesor'] ?: '') ?>" required>

            <button type="submit" class="btn-formulario-gral">Guardar Evaluación Final</button>
            <button type="button" class="btn-formulario-cancelar" id="btn-cancelar">Cancelar</button>
        </form>
    </div>
<?php endif; ?><br>
            <a href="jefatura-Propuestas.php" class="btn-acciones-gral">Propuestas</a>
            <a href="exportar_excel_ind.php?id_Proyecto=<?= $id_Proyecto ?>" class="btn-acciones-gral">Descargar Excel</a>
        </div>
    </div>
</main>
<script src="../js/textarea.js"></script>
<script>
    document.getElementById('btn-mostrar-formulario')?.addEventListener('click', () => {
        document.getElementById('btn-mostrar-formulario').style.display = 'none';
        document.getElementById('formulario-evaluacion').style.display = 'flex';
    });
    document.getElementById('btn-cancelar')?.addEventListener('click', () => {
        document.getElementById('formulario-evaluacion').style.display = 'none';
        document.getElementById('btn-mostrar-formulario').style.display = 'inline-block';
    });
</script>

  <?php 
  include("pie-pag.php");
?>
</body>