document.addEventListener('DOMContentLoaded', function() {
  const submenu = document.getElementById('submenu');
  const nombreUsuario = document.getElementById('nombreUsuario');
  const loginSM = document.getElementById('loginSM');
  const perfilSM = document.getElementById('perfilSM');
  const cerrarSesionSM = document.getElementById('cerrarSesionSM');
  const logoutLink = document.getElementById('logout-link');

  // Comprobar si hay un nombre de usuario en el localStorage para determinar si hay sesión activa
  const nombreUsuarioLocal = localStorage.getItem('nombreUsuario');

  if (nombreUsuarioLocal) {
    // Si hay una sesión activa
    nombreUsuario.innerText = nombreUsuarioLocal;
    loginSM.style.display = 'none';
    perfilSM.style.display = 'block';
    cerrarSesionSM.style.display = 'block';
    nombreUsuario.style.display = 'block';
  } else {
    // Si no hay sesión activa
    loginSM.style.display = 'block';
    perfilSM.style.display = 'none';
    cerrarSesionSM.style.display = 'none';
    nombreUsuario.style.display = 'none';
  }

  logoutLink.addEventListener('click', function(event) {
    event.preventDefault();
    toggleSubMenu();
  });

  function toggleSubMenu() {
    if (submenu.style.display === 'block') {
      submenu.style.display = 'none';
    } else {
      submenu.style.display = 'block';
    }
  }
  
});
