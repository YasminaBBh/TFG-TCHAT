
  const root = document.documentElement;
  const storedTheme = localStorage.getItem('theme') || 'light';
  if (storedTheme === 'dark') {
    root.setAttribute('data-theme', 'dark');
  }

  document.getElementById('toggle-theme').addEventListener('click', () => {
    const current = root.getAttribute('data-theme');
    const newTheme = current === 'dark' ? 'light' : 'dark';
    root.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
  });

