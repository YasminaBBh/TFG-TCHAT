<?php 
include('config/config.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Calendario</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/assets/css/sidebar.css" />
  <link rel="stylesheet" href="/assets/css/calendario.css" />
  <link rel="stylesheet" href="/assets/css/oscuro.css" />
  <link rel="stylesheet" href="/assets/css/dislexia.css" />


  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
</head>

<body>
  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar collapsed d-flex flex-column" role="complementary">
    <nav class="nav flex-column">
      <a href="#" class="nav-link toggle-btn d-flex justify-content-start" id="sidebar-button">
        <i class="bi bi-chevron-right fs-3"></i>
      </a>
      <a href="home.php" class="nav-link"><i class="bi bi-chat fs-3"></i> <span class="link-text">Chat</span></a>
      <a href="panel.php" class="nav-link"><i class="bi bi-megaphone fs-3"></i> <span class="link-text">Tablón de anuncios</span></a>
      <a href="calendario.php" class="nav-link"><i class="bi bi-calendar-event fs-3"></i> <span class="link-text">Calendario</span></a>
    </nav>
    <nav class="nav flex-column mt-auto">
      <a href="accesiblidades.php" class="nav-link"><i class="bi bi-universal-access fs-3"></i> <span class="link-text">Accesibilidades</span></a>
      <a href="ajustes.php" class="nav-link"><i class="bi bi-gear fs-3"></i> <span class="link-text">Ajustes</span></a>
      <a href="perfil.php" class="nav-link"><i class="bi bi-person-circle fs-3"></i> <span class="link-text">Perfil</span></a>
    </nav>
  </aside>

  <!-- Contenido -->
  <main class="calendar-container content">
    <div class="event-panel" id="eventPanel">
      <form id="eventoForm" class="p-3">
        <h5 class="mb-3" id="eventoPanelTitulo">Nuevo evento</h5>
        <input type="hidden" id="eventoId">

        <div class="mb-3">
          <label for="eventoTitulo" class="form-label">Título</label>
          <input type="text" class="form-control" id="eventoTitulo" required>
        </div>
        <div class="mb-3">
          <label for="eventoInicio" class="form-label">Inicio</label>
          <input type="datetime-local" class="form-control" id="eventoInicio" required>
        </div>
        <div class="mb-3">
          <label for="eventoFin" class="form-label">Fin</label>
          <input type="datetime-local" class="form-control" id="eventoFin" required>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary w-100">Guardar</button>
          <button type="button" class="btn btn-danger w-100 d-none" id="deleteEvent">Eliminar</button>
        </div>
      </form>
    </div>

    <div class="calendar-card">
      <div class="d-flex align-items-center justify-content-between mb-4 px-2">
        <div class="d-flex align-items-center" style="gap: 0.75rem; font-family: 'Segoe UI Semibold', sans-serif; font-size: 2rem; color: var(--texto-oscuro);">
          <i class="bi bi-calendar-week" style="font-size: 2.25rem; color: var(--btn-bg);"></i>
          <span>Calendario Escolar</span>
        </div>
      </div>
      <div id="calendar"></div>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/locales/es.global.min.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="/assets/js/sidebar.js"></script>
  <script src="/assets/js/dislexia.js"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');
      const eventoForm = document.getElementById('eventoForm');
      const deleteBtn = document.getElementById('deleteEvent');
      let selectedEvent = null;

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        height: '100%',
        events: 'acciones/eventos.php',
        editable: true,
        selectable: true,

        select: info => {
          selectedEvent = null;
          document.getElementById('eventoPanelTitulo').textContent = 'Nuevo evento';
          eventoForm.reset();
          document.getElementById('eventoInicio').value = info.startStr;
          document.getElementById('eventoFin').value = info.endStr;
          deleteBtn.classList.add('d-none');
        },

        eventClick: info => {
          selectedEvent = info.event;
          document.getElementById('eventoPanelTitulo').textContent = 'Editar evento';
          document.getElementById('eventoId').value = selectedEvent.id;
          document.getElementById('eventoTitulo').value = selectedEvent.title;
          document.getElementById('eventoInicio').value = selectedEvent.startStr.slice(0, 16);
          document.getElementById('eventoFin').value = selectedEvent.endStr ? selectedEvent.endStr.slice(0, 16) : '';
          deleteBtn.classList.remove('d-none');
        }
      });

      calendar.render();

      eventoForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('eventoId').value;
        const title = document.getElementById('eventoTitulo').value;
        const start = document.getElementById('eventoInicio').value;
        const end = document.getElementById('eventoFin').value;
        const isEdit = id !== '';

        if (!title || !start || !end) {
          alert('Completa todos los campos.');
          return;
        }

        const url = isEdit ? 'acciones/editar_evento.php' : 'acciones/crear_evento.php';
        const params = new URLSearchParams({ title, start, end, allDay: 0 });
        if (isEdit) params.append('id', id);

        fetch(url, {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: params
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            if (isEdit) {
              selectedEvent.setProp('title', title);
              selectedEvent.setStart(start);
              selectedEvent.setEnd(end);
            } else {
              calendar.addEvent({ id: data.id, title, start, end, allDay: false });
            }
          } else {
            alert('Error al guardar el evento.');
            console.error(data.error);
          }
        })
        .catch(err => {
          alert('Error de red al guardar el evento.');
          console.error(err);
        });
      });

      deleteBtn.addEventListener('click', () => {
        if (!selectedEvent) return;
        const id = selectedEvent.id;

        fetch('acciones/eliminar_evento.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ id })
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            selectedEvent.remove();
          } else {
            alert('Error al eliminar el evento.');
          }
        })
        .catch(err => {
          alert('Error de red al eliminar el evento.');
          console.error(err);
        });
      });
    });
  </script>
</body>
</html>
