<?php 

$host = "localhost";
$user = "root";
$contrasena = "";
$bd = "bdpsistemas";

$conectar = mysqli_connect($host, $user, $contrasena, $bd);

if(!$conectar){
  echo "Error en la conexion a la BD";
}