<?php
require '../vendor/autoload.php'; // Asegúrate de que esta ruta es correcta
include 'conexion.php';

// Usamos PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener el ID del proyecto de la URL
$id_Proyecto = isset($_GET['id_Proyecto']) ? intval($_GET['id_Proyecto']) : 0;

// Verificar que el proyecto exista en la base de datos
$query_proyecto = "SELECT id_Proyecto, responsable_proyecto, correo_electronico, telefono, 
    nombre_proyecto, objetivo, justificacion, necesidad_resolver, actividades_proyecto, 
    stack_tecnologico, modalidad, entidad, tecnm, nombre_empresa, rfc_empresa, 
    asesor_interno, interno_asesor, nombre_institucion, giro, pagina_web, 
    estudiantes_solicitados, especialidad, periodo, competencias_requeridas, 
    apoyo, tipo_apoyo, observaciones_adicionales4 
    FROM proyectos WHERE id_Proyecto = ?";

$stmt_proyecto = $conectar->prepare($query_proyecto);
$stmt_proyecto->bind_param('i', $id_Proyecto);
$stmt_proyecto->execute();
$stmt_proyecto->store_result();

if ($stmt_proyecto->num_rows === 0) {
    die("Error: No se encontró el proyecto con id_Proyecto = $id_Proyecto");
}

// Definir variables en el orden correcto
$stmt_proyecto->bind_result(
    $id_proyecto, $responsable_proyecto, $correo_electronico, $telefono,
    $nombre_proyecto, $objetivo, $justificacion, $necesidad_resolver, $actividades_proyecto,
    $stack_tecnologico, $modalidad, $entidad, $tecnm, $nombre_empresa, $rfc_empresa,
    $asesor_interno, $interno_asesor, $nombre_institucion, $giro, $pagina_web,
    $estudiantes_solicitados, $especialidad, $periodo, $competencias_requeridas,
    $apoyo, $tipo_apoyo, $observaciones_adicionales4
);

// Obtener los datos
if (!$stmt_proyecto->fetch()) {
    die("Error al obtener los datos del proyecto.");
}

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// ** Encabezados **
$sheet->setCellValue('A1', 'Detalle del Proyecto');
$sheet->setCellValue('A3', 'Campo');
$sheet->setCellValue('B3', 'Valor');

// Datos del proyecto
$datosProyecto = [
    'Nombre del Proyecto' => $nombre_proyecto,
    'Responsable' => $responsable_proyecto,
    'Correo Electrónico' => $correo_electronico,
    'Teléfono' => $telefono,
    'Objetivo' => $objetivo,
    'Justificación' => $justificacion,
    'Necesidad a Resolver' => $necesidad_resolver,
    'Stack Tecnológico' => $stack_tecnologico,
    'Modalidad' => $modalidad,
    'Entidad' => $entidad,
    'Empresa/Institución' => $nombre_empresa ?? 'No especificado',
    'RFC Empresa' => $rfc_empresa,
    'Giro' => is_array(json_decode($giro, true)) ? implode(", ", json_decode($giro, true)) : $giro,
    'Página Web' => $pagina_web,
    'Estudiantes Solicitados' => $estudiantes_solicitados,
    'Asesor Interno' => $interno_asesor ?: 'No especificado',
    'Especialidad' => $especialidad,
    'Periodo' => $periodo,
    'Competencias Requeridas' => $competencias_requeridas,
    'Apoyo al Alumno' => $apoyo,
    'Tipo de Apoyo' => $tipo_apoyo,
    'Observaciones' => $observaciones_adicionales4,
];

$fila = 4; // Inicia después de los encabezados
foreach ($datosProyecto as $campo => $valor) {
    $sheet->setCellValue("A$fila", $campo);
    $sheet->setCellValue("B$fila", $valor);
    $fila++;
}

// ** Evaluaciones de Revisores **
$sheet->setCellValue("D1", "Evaluaciones de Revisores");
$sheet->setCellValue("D3", "Revisor");
$sheet->setCellValue("E3", "Veredicto");
$sheet->setCellValue("F3", "Comentarios");
$sheet->setCellValue("G3", "Fecha Evaluación");

// Obtener revisores y sus evaluaciones
$query_revisores = "
    SELECT r.nombre AS nombre_revisor, e.veredicto, e.comentarios, e.fecha_evaluacion 
    FROM proyecto_revisores pr
    INNER JOIN revisores r ON pr.id_Revisor = r.id_Revisor
    LEFT JOIN evaluaciones_revisores e ON pr.id_Revisor = e.id_Revisor AND pr.id_Proyecto = e.id_Proyecto
    WHERE pr.id_Proyecto = ?";
$stmt_revisores = $conectar->prepare($query_revisores);
$stmt_revisores->bind_param('i', $id_Proyecto);
$stmt_revisores->execute();
$stmt_revisores->store_result(); // Necesario para usar bind_result
$stmt_revisores->bind_result($nombre_revisor, $veredicto, $comentarios, $fecha_evaluacion);

$fila_revisores = 4; // Inicia la lista de revisores en la fila 4
while ($stmt_revisores->fetch()) {
    $sheet->setCellValue("D$fila_revisores", $nombre_revisor);
    $sheet->setCellValue("E$fila_revisores", $veredicto ?: 'Pendiente');
    $sheet->setCellValue("F$fila_revisores", $comentarios ?: 'Sin comentarios');
    $sheet->setCellValue("G$fila_revisores", $fecha_evaluacion ?: 'No disponible');
    $fila_revisores++;
}

// ** Evaluación Final **
$sheet->setCellValue("I1", "Evaluación Final");
$sheet->setCellValue("I3", "Veredicto Final");
$sheet->setCellValue("J3", "Comentarios");
$sheet->setCellValue("K3", "Fecha Evaluación");

// Obtener la evaluación final
$query_evaluacion_final = "SELECT veredicto, comentarios, fecha_evaluacion FROM evaluaciones_finales WHERE id_Proyecto = ?";
$stmt_eval_final = $conectar->prepare($query_evaluacion_final);
$stmt_eval_final->bind_param('i', $id_Proyecto);
$stmt_eval_final->execute();
$stmt_eval_final->store_result(); // Necesario para usar bind_result
$stmt_eval_final->bind_result($veredicto_final, $comentarios_final, $fecha_evaluacion_final);

// Obtener los valores
$stmt_eval_final->fetch();

$sheet->setCellValue("I4", $veredicto_final ?? 'No evaluado');
$sheet->setCellValue("J4", $comentarios_final ?? 'Sin comentarios');
$sheet->setCellValue("K4", $fecha_evaluacion_final ?? 'No disponible');

// ** Aplicar estilos para mejorar apariencia **
$spreadsheet->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("A3:B3")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("D3:G3")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("I3:K3")->getFont()->setBold(true);

// Ajustar ancho de columnas automáticamente
foreach (range('A', 'K') as $col) {
    $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
}

// ** Exportar a Excel **
$filename = "Evaluación_Proyecto_$id_Proyecto.xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
