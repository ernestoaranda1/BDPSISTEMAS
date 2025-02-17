<?php
require 'conexion.php';

// Verificar que los datos necesarios estén presentes
if (isset($_POST['id_Proyecto'], $_POST['id_Revisor'])) {
    $idProyecto = intval($_POST['id_Proyecto']);
    $idRevisor = intval($_POST['id_Revisor']);

    // Verificar si ya hay 3 revisores asignados
    $consulta = "SELECT COUNT(*) AS total FROM proyecto_revisores WHERE id_Proyecto = $idProyecto";
    $resultado = mysqli_query($conectar, $consulta);
    $row = mysqli_fetch_assoc($resultado);

    if ($row['total'] >= 3) {
        echo '<script>alert("Este proyecto ya tiene 3 revisores asignados."); window.location.href = "revisor_menu.php";</script>';
        exit;
    }

    // Asignar al revisor al proyecto
    $insertar = "INSERT INTO proyecto_revisores (id_Proyecto, id_Revisor) VALUES ($idProyecto, $idRevisor)";
    if (mysqli_query($conectar, $insertar)) {
        echo '<script>alert("Te has asignado como revisor exitosamente."); window.location.href = "revisor_menu.php";</script>';
    } else {
        echo '<script>alert("Error al asignarte como revisor."); window.location.href = "revisor_menu.php";</script>';
    }
} else {
    echo '<script>alert("Datos incompletos."); window.location.href = "revisor_menu.php";</script>';
}
?>
