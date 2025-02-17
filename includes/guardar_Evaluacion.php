<?php

include 'seguridad2.php';
include 'conexion.php';

// Verificar si el revisor está logueado
if (!isset($_SESSION['id_Revisor'])) {
    echo '<script>alert("Por favor inicia sesión como revisor."); window.location.href = "inicio-Revisor.php";</script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_Proyecto = intval($_POST['id_Proyecto']);
    $id_Revisor = intval($_POST['id_Revisor']);
    $veredicto = $_POST['veredicto'];
    $comentarios = $_POST['comentarios'];

    // Insertar la evaluación en la base de datos
    $sql = "INSERT INTO evaluaciones_revisores (id_Proyecto, id_Revisor, veredicto, comentarios) 
            VALUES ($id_Proyecto, $id_Revisor, '$veredicto', '$comentarios')";

    if (mysqli_query($conectar, $sql)) {
        echo '<script>alert("Evaluación guardada correctamente."); window.location.href = "ver_proyectoR.php?id_Proyecto=' . $id_Proyecto . '";</script>';
    } else {
        echo '<script>alert("Error al guardar la evaluación: ' . mysqli_error($conectar) . '"); window.history.back();</script>';
    }
}
?>
