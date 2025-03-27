function verVistaCliente() {
    document.body.classList.add("fade-out");

    setTimeout(() => {
      window.location.href = "index.html";
    }, 500);
  }

function cerrarSesion() {
    window.location.href = "../backend/logout.php";
}