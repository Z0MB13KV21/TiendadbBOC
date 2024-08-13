// Obtener los elementos de los botones y las vistas previas
var buttons = document.querySelectorAll('.button');
var previews = document.querySelectorAll('.preview');

// Agregar eventos de mouse a cada botón
buttons.forEach(function(button) {
  button.addEventListener('mouseover', function() {
    // Mostrar la vista previa correspondiente al botón actual
    var preview = this.nextElementSibling;
    preview.style.display = 'block';
  });

  button.addEventListener('mouseout', function() {
    // Ocultar la vista previa al quitar el mouse del botón
    var preview = this.nextElementSibling;
    preview.style.display = 'none';
  });

  button.addEventListener('click', function(e) {
    e.preventDefault(); // Evitar la redirección predeterminada al hacer clic en el botón
    // Realizar la redirección a la página del producto seleccionado
    window.location.href = this.href;
  });
});