<?php
session_start(); // Asegura que la sesión está iniciada

if (isset($_SESSION['id_Jefatura'])) {
    $id_Jefatura = $_SESSION['id_Jefatura'];
} else {
    echo "Error: No se encontró el ID de Jefatura en la sesión.";
}
?>
