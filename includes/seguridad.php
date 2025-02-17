<?php
session_start();

if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != "SI" || !isset($_SESSION["id_Usuario"])) {
    // Redirige al login si no está autenticado o si no hay un ID de usuario en la sesión
    header("Location: inicio-Usuario.php");
    exit();
}
