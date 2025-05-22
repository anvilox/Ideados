fetch("../backend/session.php")
    .then(res => res.json())
    .then(data => {
      const nombreSpan = document.getElementById("usuario-nombre");
      const cerrarSesionBtn = document.getElementById("cerrarSesionBtn");
      const crearCuentaBtn = document.getElementById("crearCuentaBtn");
      const adminBtn = document.getElementById("btn-panel-admin");

      if (data.logged) {
        nombreSpan.textContent = `Hola, ${data.usuario.nombre}`;

        if (data.usuario.nombre === "Invitado") {
          cerrarSesionBtn.classList.add("d-none");
          crearCuentaBtn.classList.remove("d-none");
        }

        if (data.usuario.rol === 1 || data.usuario.rol === "1") {
          adminBtn.classList.remove("d-none");
        } else {
          adminBtn.classList.add("d-none");
        }
      } else {
        nombreSpan.textContent = "Invitado";
        cerrarSesionBtn.classList.add("d-none");
        crearCuentaBtn.classList.remove("d-none");
        adminBtn.classList.add("d-none");
      }
    });

  function cerrarSesion() {
    window.location.href = "../backend/logout.php";
  }

  function crearCuenta() {
    window.location.href = "registro.html";
  }

  function irAlPanelAdmin() {
    document.body.classList.add("fade-out");
  
    setTimeout(() => {
      window.location.href = "admin.php";
    }, 500); 
  }
