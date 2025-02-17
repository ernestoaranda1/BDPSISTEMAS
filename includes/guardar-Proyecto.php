<?php
session_start();
require "conexion.php";  

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['id_Usuario'])) {
    echo '<script>
            alert("Por favor inicia sesión para subir un proyecto.");
            window.location.href = "inicio-Usuario.php";
          </script>';
    exit;
}

// Recolección de los datos del formulario
$id_Usuario = $_SESSION['id_Usuario']; // ID del usuario que sube el proyecto
$responsable_proyecto = mysqli_real_escape_string($conectar, $_POST['responsable_proyecto']);
$correo_electronico = mysqli_real_escape_string($conectar, $_POST['correo_electronico']);
$telefono = mysqli_real_escape_string($conectar, $_POST['telefono']);
$nombre_proyecto = mysqli_real_escape_string($conectar, $_POST['nombre_proyecto']);
$objetivo = mysqli_real_escape_string($conectar, $_POST['objetivo']);
$justificacion = mysqli_real_escape_string($conectar, $_POST['justificacion']);
$necesidad_resolver = mysqli_real_escape_string($conectar, $_POST['necesidad_resolver']);
$actividades_proyecto = mysqli_real_escape_string($conectar, $_POST['actividades_proyecto']);
$stack_tecnologico = mysqli_real_escape_string($conectar, $_POST['stack_tecnologico']);
$modalidad = mysqli_real_escape_string($conectar, $_POST['modalidad']);
$entidad = mysqli_real_escape_string($conectar, $_POST['entidad']);
$tecnm = mysqli_real_escape_string($conectar, $_POST['tecnm']);
$nombre_empresa = mysqli_real_escape_string($conectar, $_POST['nombre_empresa']);
$rfc_empresa = mysqli_real_escape_string($conectar, $_POST['rfc_empresa']);
$asesor_interno = mysqli_real_escape_string($conectar, $_POST['asesor_interno']);
$interno_asesor = mysqli_real_escape_string($conectar, $_POST['interno_asesor']);
$nombre_institucion = mysqli_real_escape_string($conectar, $_POST['nombre_institucion']);

// Convertir el campo `giro` a JSON válido o establecerlo en NULL
$giro = isset($_POST['giro']) && !empty($_POST['giro']) ? json_encode($_POST['giro'], JSON_UNESCAPED_UNICODE) : null;

$pagina_web = mysqli_real_escape_string($conectar, $_POST['pagina_web']);
$estudiantes_solicitados = mysqli_real_escape_string($conectar, $_POST['estudiantes_solicitados']);
$especialidad = mysqli_real_escape_string($conectar, $_POST['especialidad']);
$periodo = mysqli_real_escape_string($conectar, $_POST['periodo']);
$competencias_requeridas = mysqli_real_escape_string($conectar, $_POST['competencias_requeridas']);
$apoyo = mysqli_real_escape_string($conectar, $_POST['apoyo']);
$tipo_apoyo = mysqli_real_escape_string($conectar, $_POST['tipo_apoyo']);
$observaciones_adicionales4 = mysqli_real_escape_string($conectar, $_POST['observaciones_adicionales4']);

// Preparar la consulta SQL
$sql = "INSERT INTO proyectos (
            id_Usuario, responsable_proyecto, correo_electronico, telefono, nombre_proyecto, 
            objetivo, justificacion, necesidad_resolver, actividades_proyecto, 
            stack_tecnologico, modalidad, entidad, tecnm, nombre_empresa, 
            rfc_empresa, asesor_interno, interno_asesor, nombre_institucion, 
            giro, pagina_web, estudiantes_solicitados, especialidad, periodo, 
            competencias_requeridas, apoyo, tipo_apoyo, observaciones_adicionales4
        ) VALUES (
            '$id_Usuario', '$responsable_proyecto', '$correo_electronico', '$telefono', '$nombre_proyecto', 
            '$objetivo', '$justificacion', '$necesidad_resolver', '$actividades_proyecto', 
            '$stack_tecnologico', '$modalidad', '$entidad', '$tecnm', '$nombre_empresa', 
            '$rfc_empresa', '$asesor_interno', '$interno_asesor', '$nombre_institucion', 
            " . ($giro !== null ? "'$giro'" : "NULL") . ", 
            '$pagina_web', '$estudiantes_solicitados', '$especialidad', '$periodo', 
            '$competencias_requeridas', '$apoyo', '$tipo_apoyo', '$observaciones_adicionales4'
        )";

// Ejecutar la consulta e informar al usuario
if (mysqli_query($conectar, $sql)) {
    echo '<script>
            alert("Proyecto registrado exitosamente");
            window.location.href = "sube_proyecto.php";
          </script>';
} else {
    // Mensaje de error con depuración
    echo '<script>
            alert("Error al registrar el proyecto: ' . mysqli_error($conectar) . '");
            console.log("Consulta SQL: ' . addslashes($sql) . '");
            window.location.href = "sube_proyecto.php";
          </script>';
}

// Cerrar la conexión
mysqli_close($conectar);
?>
