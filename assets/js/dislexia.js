document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggle-dyslexia");

  const dislexiaActivada = localStorage.getItem("dislexia") === "true";
  aplicarFuente(dislexiaActivada);

  if (toggleBtn) {
    toggleBtn.addEventListener("click", () => {
      const usandoDislexia = document.body.classList.contains("dyslexia-font");
      const nuevoEstado = !usandoDislexia;
      localStorage.setItem("dislexia", nuevoEstado);
      aplicarFuente(nuevoEstado);
    });
}
  function aplicarFuente(activa) {
    document.body.classList.remove("default-font", "dyslexia-font");
    if (activa) {
      document.body.classList.add("dyslexia-font");
    } else {
      document.body.classList.add("default-font");
    }
  }
});

