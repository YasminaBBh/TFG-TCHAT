let tooltipDiv = null;

if (btnAddUser) {
  btnAddUser.addEventListener('mouseover', function(e) {
          showTooltip('Agregar usuario');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnAddUser.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnAddUser.addEventListener('mouseout', removeTooltip);
}

if (btnCreateGroup) {
  btnCreateGroup.addEventListener('mouseover', function(e) {
          showTooltip('Agregar grupo');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnCreateGroup.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnCreateGroup.addEventListener('mouseout', removeTooltip);
}

if (btnFriendRequests) {
  btnFriendRequests.addEventListener('mouseover', function(e) {
          showTooltip('Solicitudes de amistad');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnFriendRequests.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnFriendRequests.addEventListener('mouseout', removeTooltip);
}

if (btnChat) {
  btnChat.addEventListener('mouseover', function(e) {
          showTooltip('Chat');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnChat.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnChat.addEventListener('mouseout', removeTooltip);
}

if (btnAnnouncements) {
  btnAnnouncements.addEventListener('mouseover', function(e) {
          showTooltip('Anuncios');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnAnnouncements.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnAnnouncements.addEventListener('mouseout', removeTooltip);
}

if (btnCalendar) {
  btnCalendar.addEventListener('mouseover', function(e) {
          showTooltip('Calendario');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnCalendar.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnCalendar.addEventListener('mouseout', removeTooltip);
}

if (btnTheme) {
  btnTheme.addEventListener('mouseover', function(e) {
          showTooltip('Cambiar tema');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnTheme.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnTheme.addEventListener('mouseout', removeTooltip);
}

if (btnSettings) {
  btnSettings.addEventListener('mouseover', function(e) {
          showTooltip('Configuración');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnSettings.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnSettings.addEventListener('mouseout', removeTooltip);
}

if (btnProfile) {
  btnProfile.addEventListener('mouseover', function(e) {
          showTooltip('Perfil');
          // Posicionar inicialmente
          moveToltip(e);
        });

  btnProfile.addEventListener('mousemove', function(e) {
    moveToltip(e);
  });

  btnProfile.addEventListener('mouseout', removeTooltip);
}

function removeTooltip() {
  if (tooltipDiv) {
    tooltipDiv.remove();
    tooltipDiv = null;
  }
}

function moveToltip(e) {
  if (tooltipDiv) {
    tooltipDiv.style.left = (e.clientX + 12) + 'px';
    tooltipDiv.style.top = (e.clientY + 12) + 'px';
  }
}

function showTooltip(text) {
  tooltipDiv = document.createElement('div');
  tooltipDiv.textContent = text;
  tooltipDiv.style.position = 'fixed';
  tooltipDiv.style.background = '#222';
  tooltipDiv.style.color = '#fff';
  tooltipDiv.style.padding = '4px 10px';
  tooltipDiv.style.borderRadius = '5px';
  tooltipDiv.style.fontSize = '13px';
  tooltipDiv.style.pointerEvents = 'none';
  tooltipDiv.style.zIndex = 9999;
  tooltipDiv.style.boxShadow = '0 2px 8px rgba(0,0,0,0.2)';
  document.body.appendChild(tooltipDiv);
}
