$(function () {
  // loader
  setTimeout(function () {
    $("body").addClass("loaded");
  }, 500);

  // Ocultar inicialmente los paneles de registro y recuperación
  $("#registrar, #forgot").hide();

  // Mostrar registro
  $("#mostrar").click(function () {
    $("#login, #forgot").hide();
    $("#registrar").show(200);
  });

  // Volver al login desde registro
  $("#formlogin").click(function () {
    $("#registrar, #forgot").hide();
    $("#login").show(200);
  });

  // Mostrar recuperación de contraseña
  $("#forgot-link").click(function () {
    $("#login, #registrar").hide();
    $("#forgot").show(200);
  });

  // Volver al login desde recuperación
  $("#back-to-login").click(function () {
    $("#forgot").hide();
    $("#login").show(200);
  });
});

/* Vista previa de la imagen de perfil */
document.addEventListener("DOMContentLoaded", function () {
  [].forEach.call(document.querySelectorAll(".dropimage"), function (img) {
    img.onchange = function (e) {
      var inputfile = this,
        reader = new FileReader();
      reader.onloadend = function () {
        inputfile.style["background-image"] = "url(" + reader.result + ")";
      };
      reader.readAsDataURL(e.target.files[0]);
    };
  });
});
