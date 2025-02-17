// Obtener los elementos del DOM
const btnMostrarFormulario = document.getElementById('btn-mostrar-formulario');
const formulario = document.getElementById('formulario-cambiar-contrasena');
const btnCancelar = document.getElementById('btn-cancelar');

// Añadir evento para mostrar el formulario
btnMostrarFormulario.addEventListener('click', () => {
    btnMostrarFormulario.style.display = 'none'; // Ocultar el botón
    formulario.style.display = 'block';         // Mostrar el formulario
});

// Añadir evento para ocultar el formulario y mostrar nuevamente el botón
btnCancelar.addEventListener('click', () => {
    formulario.style.display = 'none';          // Ocultar el formulario
    btnMostrarFormulario.style.display = 'inline-block'; // Mostrar el botón
});