document.getElementById("registroForm").addEventListener("submit", function (e) {
    e.preventDefault();
  
    // Limpiar errores anteriores
    document.querySelectorAll("small.text-danger").forEach(el => el.textContent = "");
    document.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));

    // Obtener datos
    const nombre = document.getElementById("nombre").value.trim();
    const apellidos = document.getElementById("apellidos").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const direccion = document.getElementById("direccion").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const cp = document.getElementById("cp").value.trim();
    const provincia = document.getElementById("provincia").value;


    // Expresiones regulares
    const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
    const telefonoRegex = /^\d{9,12}$/;
    const cpRegex = /^\d{5}$/;

    // Validar campos
    let valido = true;

    if (!nombreRegex.test(nombre)) {
      document.getElementById("error-nombre").textContent = "El nombre solo puede contener letras y espacios.";
      document.getElementById("nombre").classList.add("is-invalid");
      valido = false;
    }

    if (!nombreRegex.test(apellidos)) {
      document.getElementById("error-apellidos").textContent = "Los apellidos solo pueden contener letras y espacios.";
      document.getElementById("apellidos").classList.add("is-invalid");
      valido = false;
    }

    if (!emailRegex.test(email)) {
      document.getElementById("error-email").textContent = "Correo electrónico no válido.";
      document.getElementById("email").classList.add("is-invalid");
      valido = false;
    }

    if (!passwordRegex.test(password)) {
      document.getElementById("error-password").textContent = "Contraseña débil. Debe tener mayúscula, minúscula, número y símbolo.";
      document.getElementById("password").classList.add("is-invalid");
      valido = false;
    }

    if (!telefonoRegex.test(telefono)) {
      document.getElementById("error-telefono").textContent = "Teléfono inválido (9-12 dígitos).";
      document.getElementById("telefono").classList.add("is-invalid");
      valido = false;
    }

    if (!cpRegex.test(cp)) {
      document.getElementById("error-cp").textContent = "Código postal inválido (5 dígitos).";
      document.getElementById("cp").classList.add("is-invalid");
      valido = false;
    }

    if (!provincia) {
      document.getElementById("error-provincia").textContent = "Selecciona una provincia.";
      document.getElementById("provincia").classList.add("is-invalid");
      valido = false;
    }

    if (!valido) return;

    // Enviar datos si todo está correcto
    const datos = {
      nombre,
      apellidos,
      email,
      password,
      direccion,
      telefono,
      cp,
      provincia
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
  