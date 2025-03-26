fetch("../backend/session.php")
    .then(res => res.json())
    .then(data => {
      const nombreSpan = document.getElementById("usuario-nombre");
      const cerrarSesionBtn = document.getElementById("cerrarSesionBtn");
      const crearCuentaBtn = document.getElementById("crearCuentaBtn");

      if (data.logged) {
        nombreSpan.textContent = `Hola, ${data.usuario.nombre}`;

        if (data.usuario.nombre === "Invitado") {
          cerrarSesionBtn.classList.add("d-none");
          crearCuentaBtn.classList.remove("d-none");
        }
      } else {
        nombreSpan.textContent = "Invitado";
        cerrarSesionBtn.classList.add("d-none");
        crearCuentaBtn.classList.remove("d-none");
      }
    });

  function cerrarSesion() {
    window.location.href = "../backend/logout.php";
  }

  function crearCuenta() {
    window.location.href = "registro.html";
  }
