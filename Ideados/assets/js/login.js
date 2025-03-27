document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault();
  
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
  
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
          if (data.admin) {
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
  
  