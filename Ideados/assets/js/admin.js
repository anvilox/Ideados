function verVistaCliente() {
    document.body.classList.add("fade-out");

    setTimeout(() => {
      window.location.href = "index.html";
    }, 500);
  }

function cerrarSesion() {
    window.location.href = "../backend/logout.php";
}

// Mostrar fecha y hora actual
function actualizarFechaHora() {
  const dt = new Date();
  const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const fecha = dt.toLocaleDateString('es-ES', opciones);
  const hora = dt.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });

  document.getElementById('datetime').textContent = `${fecha} - ${hora}`;
}

actualizarFechaHora();
setInterval(actualizarFechaHora, 10000); // Actualiza cada 10s
