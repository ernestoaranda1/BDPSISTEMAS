      $(document).ready(function () {
        function esMovil() {
          return $(window).width() <= 431; // Se considera móvil si el ancho es 768px o menor
        }
  
        $("#icono").click(function (event) {
          event.stopPropagation();
          if (esMovil()) {
            $("#menu").slideToggle();
          }
        });
  
        $(".menu li a").click(function () {
          if (esMovil()) {
            $("#menu").slideUp();
          }
        });
  
        $(document).click(function (event) {
          if (esMovil() && !$(event.target).closest("#menu, #icono").length) {
            $("#menu").slideUp();
          }
        });
  
        $(window).resize(function () {
          if (!esMovil()) {
            $("#menu").show(); // Asegura que el menú se muestre en vista escritorio
          }
        });
      });