const textareas = document.querySelectorAll('textarea'); // Selecciona todos los <textarea>

textareas.forEach(textarea => { // Itera sobre cada <textarea>
  textarea.addEventListener("input", e => {
    textarea.style.height = '38px'; // Restablece la altura inicial
    textarea.style.height = (textarea.scrollHeight + 2) + 'px'; // Ajusta la altura al contenido
  });
});
