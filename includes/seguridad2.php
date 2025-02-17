<?php
session_start();

if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != "SI" || !isset($_SESSION["id_Revisor"])) {
    // Redirige al login si no está autenticado o si no hay un ID de usuario en la sesión
    header("Location: inicio-Revisor.php");
    exit();
}
