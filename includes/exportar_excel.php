<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta a "vendor/autoload.php" es correcta
include 'conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados de la tabla
$headers = [
    'ID Proyecto', 'Nombre Proyecto', 'Responsable Proyecto', 'Correo Responsable', 'Telefono Responsable',
    'Objetivo Proyecto', 'Justificacion Proyecto', 'Necesidad Resolver', 'Actividades Proyecto',
    'Stack Tecnologico', 'Modalidad Proyecto', 'Tipo Entidad', 'Proyecto TecNM', 'Nombre Empresa',
    'RFC Empresa', 'Asesor Interno', 'Nombre Asesor Interno', 'Nombre Institución', 'Giro',
    'Pagina Web', 'Estudiantes Solicitados', 'Especialidad Proyecto', 'Periodo',
    'Competencias Requeridas', 'Apoyo', 'Tipo Apoyo', 'Observaciones Adicionales',
    'ID Revisor', 'Nombre Revisor', 'Correo Revisor', 'Fecha Asignacion Revisor',
    'Veredicto Revisor', 'Comentarios Revisor', 'Fecha Evaluacion Revisor', 'Días Para Evaluación Revisor',
    'Veredicto Final', 'Comentarios Finales', 'Fecha Evaluación Final'
];

// Escribir los encabezados en la primera fila
$sheet->fromArray($headers, null, 'A1');

// Consulta para obtener los datos
$query_export = "
    SELECT 
        p.id_Proyecto, p.nombre_proyecto, p.responsable_proyecto, p.correo_electronico,
        p.telefono, p.objetivo, p.justificacion, p.necesidad_resolver, p.actividades_proyecto,
        p.stack_tecnologico, p.modalidad, p.entidad, p.tecnm, p.nombre_empresa, p.rfc_empresa,
        p.asesor_interno, p.interno_asesor, p.nombre_institucion, p.giro, p.pagina_web,
        p.estudiantes_solicitados, p.especialidad, p.periodo, p.competencias_requeridas,
        p.apoyo, p.tipo_apoyo, p.observaciones_adicionales4, 
        r.id_Revisor, r.nombre, r.correo,
        pr.fecha_asignacion, 
        IFNULL(er.veredicto, 'No Evaluado') AS veredicto_revisor, 
        IFNULL(er.comentarios, 'No Evaluado') AS comentarios_revisor, 
        IFNULL(er.fecha_evaluacion, 'No Evaluado') AS fecha_evaluacion_revisor,
        IFNULL(DATEDIFF(er.fecha_evaluacion, pr.fecha_asignacion), 'No Evaluado') AS dias_para_evaluacion,
        IFNULL(ef.veredicto, 'Pendiente') AS veredicto_final, 
        IFNULL(ef.comentarios, 'Pendiente') AS comentarios_finales, 
        IFNULL(ef.fecha_evaluacion, 'Pendiente') AS fecha_evaluacion_final
    FROM proyectos p
    LEFT JOIN proyecto_revisores pr ON p.id_Proyecto = pr.id_Proyecto
    LEFT JOIN revisores r ON pr.id_Revisor = r.id_Revisor
    LEFT JOIN evaluaciones_revisores er ON p.id_Proyecto = er.id_Proyecto AND r.id_Revisor = er.id_Revisor
    LEFT JOIN evaluaciones_finales ef ON p.id_Proyecto = ef.id_Proyecto
    ORDER BY p.id_Proyecto, r.id_Revisor, ef.fecha_evaluacion";

// Ejecutar la consulta
$result_export = $conectar->query($query_export);

if ($result_export->num_rows > 0) {
    $rowIndex = 2; // Iniciar en la fila 2 (después de los encabezados)

    while ($row = $result_export->fetch_assoc()) {
        $sheet->fromArray(array_values($row), null, 'A' . $rowIndex);
        $rowIndex++;
    }
}

// Ajustar automáticamente el ancho de las columnas
foreach (range('A', $sheet->getHighestColumn()) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Nombre del archivo de salida
$fileName = 'proyectos_revisores_detallado.xlsx';

// Enviar el archivo al navegador para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit;
?>
