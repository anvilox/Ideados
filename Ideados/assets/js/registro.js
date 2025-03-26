document.getElementById("registroForm").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const datos = {
      nombre: document.getElementById("nombre").value,
      apellidos: document.getElementById("apellidos").value,
      email: document.getElementById("email").value,
      password: document.getElementById("password").value,
      direccion: document.getElementById("direccion").value,
      telefono: document.getElementById("telefono").value,
      cp: document.getElementById("cp").value,
      provincia: document.getElementById("provincia").value
    };
  
    const body = new URLSearchParams(datos).toString();
  
    fetch("../backend/registro.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: body
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert("¡Registro exitoso!");
          window.location.href = "login.html";
        } else {
          alert("Error al registrarse: " + (data.error || "Intenta con otro correo."));
        }
      })
      .catch(err => {
        console.error("Error:", err);
        alert("Hubo un problema en el servidor.");
      });
  });
  