document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = sidebar.querySelector('.toggle-btn');
  const toggleIcon = toggleBtn.querySelector('i');

  toggleBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Alterna el estado
    sidebar.classList.toggle('collapsed');
    const isCollapsed = sidebar.classList.contains('collapsed');

    // Actualiza icono
    if (isCollapsed) {
      toggleIcon.classList.replace('bi-chevron-left', 'bi-chevron-right');
      toggleBtn.setAttribute('aria-label', 'Expandir menú');
    } else {
      toggleIcon.classList.replace('bi-chevron-right', 'bi-chevron-left');
      toggleBtn.setAttribute('aria-label', 'Colapsar menú');
    }
  });
});
