<?php
include 'seguridad2.php';
include 'conexion.php';

if (!isset($_SESSION['id_Revisor'])) {
    echo '<script>alert("Por favor inicia sesión como revisor."); window.location.href = "inicio-Revisor.php";</script>';
    exit();
}
$id_Revisor = $_SESSION['id_Revisor'];
$id_Proyecto = $_POST['id_Proyecto'];
// Consulta para verificar si ya estás inscrito en el proyecto
$query_check = "SELECT id_Proyecto, id_Revisor FROM proyecto_revisores WHERE id_Proyecto = ? AND id_Revisor = ?";
$stmt_check = $conectar->prepare($query_check);
$stmt_check->bind_param('ii', $id_Proyecto, $id_Revisor);
$stmt_check->execute();
// Verificar si la consulta fue exitosa
if (!$stmt_check) {
    die("Error al preparar la consulta 'query_check': " . $conectar->error);
}
// Enlazar los resultados con las variables
$stmt_check->bind_result($id_Proyecto_check, $id_Revisor_check);
$stmt_check->fetch();
if ($id_Proyecto_check) {
    echo '<script>alert("Ya estás inscrito en este proyecto."); window.location.href = "ver_proyectoR.php?id_Proyecto=' . $id_Proyecto . '";</script>';
    exit();
}
// Cerrar la consulta anterior antes de proceder con la siguiente
$stmt_check->close();
// Verificar el número de revisores actuales para el proyecto
$query_count = "SELECT COUNT(*) AS total_revisores FROM proyecto_revisores WHERE id_Proyecto = ?";
$stmt_count = $conectar->prepare($query_count);
// Verificar si la preparación de la consulta fue exitosa
if (!$stmt_count) {
    die("Error al preparar la consulta 'query_count': " . $conectar->error);
}
$stmt_count->bind_param('i', $id_Proyecto);
$stmt_count->execute();
$stmt_count->bind_result($total_revisores);
$stmt_count->fetch();
// Cerrar la consulta anterior antes de proceder con la siguiente
$stmt_count->close();
if ($total_revisores >= 3) {
    echo '<script>alert("Este proyecto ya tiene el máximo de 3 revisores asignados."); window.location.href = "ver_proyectoR.php?id_Proyecto=' . $id_Proyecto . '";</script>';
    exit();
}
// Consulta para insertar el revisor en el proyecto
$query_insert = "INSERT INTO proyecto_revisores (id_Proyecto, id_Revisor) VALUES (?, ?)";
$stmt_insert = $conectar->prepare($query_insert);
// Verificar si la preparación de la consulta fue exitosa
if (!$stmt_insert) {
    die("Error al preparar la consulta 'query_insert': " . $conectar->error);
}
$stmt_insert->bind_param('ii', $id_Proyecto, $id_Revisor);
if ($stmt_insert->execute()) {
    echo '<script>alert("Te has inscrito exitosamente en el proyecto."); window.location.href = "ver_proyectoR.php?id_Proyecto=' . $id_Proyecto . '";</script>';
} else {
    echo '<script>alert("Error al inscribirte en el proyecto.");window.location.href = "ver_proyectoR.php?id_Proyecto=' . $id_Proyecto . '";</script>';
}
// Cerrar la consulta insertada
$stmt_insert->close();
$conectar->close();
?>