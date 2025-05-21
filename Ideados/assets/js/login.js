document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault();
  
      // Limpiar mensajes de error y estilos
      document.querySelectorAll("small.text-danger").forEach(el => el.textContent = "");
      document.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));

      // Obtener datos
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;

      // Expresiones regulares
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;

      let valido = true;

      // Validar campos
      if (!emailRegex.test(email)) {
        document.getElementById("error-email").textContent = "Correo electrónico no válido.";
        document.getElementById("email").classList.add("is-invalid");
        valido = false;
      }

      if (!passwordRegex.test(password)) {
        document.getElementById("error-password").textContent = "Contraseña inválida. Debe tener mayúscula, minúscula, número y carácter especial.";
        document.getElementById("password").classList.add("is-invalid");
        valido = false;
      }

      if (!valido) return;
  
      //Envía datos si todo está correcto
      fetch("../backend/login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          if (data.rol) {
            window.location.href = "admin.php";
          } else {
            window.location.href = "index.html";
          }
        } else {
          alert("Correo o contraseña incorrectos");
        }
      })
      .catch(err => {
        console.error("Error al iniciar sesión:", err);
        alert("Hubo un error en el servidor.");
      });
    });
  });

function iniciarComoInvitado() {
  fetch("../backend/invitado.php")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        window.location.href = "index.html";
      }
    })
    .catch(err => {
      console.error("Error al iniciar como invitado:", err);
      alert("Error iniciando sesión como invitado.");
    });
}
  
  