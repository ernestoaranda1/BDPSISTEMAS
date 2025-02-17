<?php
require "conexion.php";
require "seguridad.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- HEAD -->
  <?php 
  include("head.php");
?>
</head>
<body>
  <!-- CABEZERA -->
  <?php include("cabezera.php"); 
  include("navegacion.php"); ?>
  <!-- CONTENIDO -->
<main class="ancho">
  <div class="principal">
    <div class="contenido">
      <h2 class="subtitulo">Sube tu propuesta de proyecto</h2><br>
      <form action="guardar-Proyecto.php" method="post" enctype="multipart/form-data" class="form-Nuevo-registro">

        <label for="responsable_proyecto">1.- Responsable del Proyecto:<span class="requerido">*</span></label>
          <input type="text" id="responsable_proyecto" name="responsable_proyecto" required placeholder="Escribe tu respuesta">
          <br>
  
          <label for="correo_electronico">2.- Correo Electrónico (usar de preferencia correo de su empresa/institución):<span class="requerido">*</span></label>
          <input type="email" id="correo_electronico" name="correo_electronico" required placeholder="Escribe tu respuesta">
          <br>
  
          <label for="telefono">3.- Teléfono:<span class="requerido">*</span></label>
          <input type="text" id="telefono" name="telefono" placeholder="El valor debe ser un número." required>
          <br>
  
          <label for="nombre_proyecto"> 4.- Nombre del Proyecto a realizar:<span class="requerido">*</span></label>
          <input type="text" id="nombre_proyecto" name="nombre_proyecto" required placeholder="Escribe tu respuesta">
          <br>
  
          <label for="objetivo">5.- Objetivo:<span class="requerido">*</span></label>
          <textarea id="objetivo" name="objetivo" required placeholder="Escribe tu respuesta"></textarea>
          <br>
  
          <label for="justificacion">6.- Justificación:<span class="requerido">*</span></label>
          <textarea id="justificacion" name="justificacion" required placeholder="Escribe tu respuesta"></textarea>
          <br>
  
          <label for="necesidad_resolver">7.- Necesidad o problema específico a resolver:<span class="requerido">*</span></label>
          <textarea id="necesidad_resolver" name="necesidad_resolver" placeholder="Escribe tu respuesta" required></textarea>
          <br>
  
          <label for="actividades_proyecto">8.- Actividades del Proyecto:<span class="requerido">*</span></label>
          <textarea id="actividades_proyecto" name="actividades_proyecto" placeholder="Escribe tu respuesta" required></textarea>
          <br>
  
          <label for="stack_tecnologico">9.- ¿Cuál seria el stack tecnológico (lenguajes de programación, bases de datos, framework, plataformas o aplicaciones) para emplear en el proyecto?:<span class="requerido">*</span></label>
          <input type="text" id="stack_tecnologico" name="stack_tecnologico" placeholder="Escribe tu respuesta" required>
          <br>
  
          <label>10.- Modalidad del trabajo:<span class="requerido">*</span></label>
          <label for="presencial"><input type="radio"  name="modalidad" id="presencial" value="presencial"> Presencial </label>
          <label for="virtual"><input type="radio"  name="modalidad" id="virtual" value="virtual"> Virtual </label> 
          <label for="hibrido"><input type="radio"  name="modalidad" id="hibrido" value="hibrido"> Híbrido (presencial y virtual) </label> 
          <br>
  
          <!-- ----------------------------------------------------------------------------------- -->
          <label>11.- Tipo de entidad solicitante:<span class="requerido">*</span></label>
          <label for="empresa"><input type="radio"  name="entidad" id="empresa" value="empresa"> Empresa</label>
          <label for="institucion"><input type="radio"  name="entidad" id="institucion" value="institucion"> Institución</label>
          <br>
  
          <label>12.- ¿Se trata del Instituto Tecnológico de Mérida?:</label><br>
          <label for="si2"><input type="radio"  name="tecnm" id="si2" value="si">  Si</label>
          <label for="no2"><input type="radio"  name="tecnm" id="no2" value="no"> No</label> 
          <br>
          
          <!--EMPRESA-->
          <label for="nombre_empresa">13.- Nombre de la empresa: </label>
          <input type="text" id="nombre_empresa" name="nombre_empresa" placeholder="Escribe tu respuesta">
          <br>
  
          <label for="rfc_empresa">14.- Registro Federal del Contribuyente (RFC):</label>
          <input type="text" id="rfc_empresa" name="rfc_empresa" placeholder="Escribe tu respuesta">
          <br>
                  <!--INSTITUCION TODO SI-->

          <label>15.- ¿Le gustaría incluir en la propuesta algún asesor interno?:<span class="requerido">*</span></label>
          <label for="si3"><input type="radio"  name="asesor_interno" id="si3" value="si"> Si</label>
          <label for="no3"><input type="radio"  name="asesor_interno" id="no3" value="no"> No</label> 
          <br>
  
          <!--EN LA 13 SI ES UN SI-->
  
          <label>16.- Nombre del asesor interno:</label>
          <input type="text" id="interno_asesor" name="interno_asesor" placeholder="Escribe tu respuesta">
          <br>
  
          <label for="nombre_institucion">17.- Nombre de la Institución:</label>
          <input type="text" id="nombre_institucion" name="nombre_institucion" placeholder="Escribe tu respuesta">
          <br>
  
          <label>18.- Giro de la empresa/institución:</label>
          <label><input type="checkbox" name="giro[]" value="Servicios">Servicios</label>
          <label><input type="checkbox" name="giro[]" value="Manufactura"> Manufactura </label>
          <label><input type="checkbox" name="giro[]" value="Comercial">Comercial</label>
          <br>
  
          <label for="pagina_web">19.- Página Web o fan page:</label>
          <input type="url" id="pagina_web" name="pagina_web" placeholder="Escribe tu respuesta">
          <br>
  
          <label for="estudiantes_solicitados">20.- Número de estudiantes Solicitados:<span class="requerido">*</span></label>
          <input type="number" id="estudiantes_solicitados" required name="estudiantes_solicitados" placeholder="Escribe un número mayor que o igual a 1">
          <br>
  
          <label>21.- Especialidad del departamento de sistemas en computación que podría trabajar el proyecto:<span class="requerido">*</span></label>
          <label for="inteligenciaArtificial"><input type="radio"  name="especialidad" id="ia" value="Inteligencia_Artificial"> Inteligencia artificial</label>
          <label for="ciberseguridad"><input type="radio"  name="especialidad" id="ciberseguridad" value="Ciberseguridad"> Ciberseguridad</label>
          <label for="desarrolloWeb"><input type="radio"  name="especialidad" id="desarrolloWeb" value="Desarrollo_Web"> Desarrollo web y aplicaciones móviles</label> 
          <br>
  
          <label>22.- Período ideal para realizar el proyecto:<span class="requerido">*</span></label>
          <label for="periodo1"><input type="radio"  name="periodo" id="periodo1" value="Enero-Junio"> Enero - junio</label>
          <label for="periodo2"><input type="radio"  name="periodo" id="periodo2" value="Agosto-Diciembre"> Agosto - diciembre</label> 
          <br>
  
          <label for="competencias_requeridas">23.- Competencias requeridas en el (los) alumno(s):<span class="requerido">*</span></label>
          <textarea id="competencias_requeridas" name="competencias_requeridas" required placeholder="Escribe tu respuesta"></textarea>
          <br>
  
          <label>24.- Existe algún tipo de apoyo a otorgar al alumno (beca, comedor, transporte, habitación, etc.):<span class="requerido">*</span></label>
          <label for="si"><input type="radio"  name="apoyo" id="si4" value="si"> Si</label>
          <label for="no"><input type="radio"  name="apoyo" id="no4" value="no"> No</label> 
          <br>
  
          <!--Si ponen si EN LA 19-->
          <label>25.- ¿Qué tipo de apoyo?:</label>
          <textarea id="tipo_apoyo" name="tipo_apoyo" placeholder="Escribe tu respuesta"></textarea>
          <br>
  
          <!--Si en la 20 es un no-->
          <label>26.- Observaciones o comentarios adicionales:<span class="requerido">*</span></label>
          <textarea id="observaciones_adicionales4" name="observaciones_adicionales4" placeholder="Escribe tu respuesta"></textarea>
          <br>
  
      <input class="btn-formulario-gral" type="submit" value="Agregar Proyecto">
  </form>
  <script src="../js/textarea.js"></script>
    </div>
  </div>
</main>
  <!-- PIE DE PAGINA -->
  <?php include("pie-pag.php"); ?>

</body>
</html>