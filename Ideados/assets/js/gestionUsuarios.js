let paginaActual = 1;

document.addEventListener("DOMContentLoaded", () => {
    cargarUsuarios();

    document.getElementById("filtroNombre").addEventListener("input", () => {
        paginaActual = 1;
        cargarUsuarios();
    });

    document.getElementById("filtroEmail").addEventListener("input", () => {
        paginaActual = 1;
        cargarUsuarios();
    });

    document.getElementById("anterior").addEventListener("click", () => {
        if (paginaActual > 1) {
            paginaActual--;
            cargarUsuarios();
        }
    });

    document.getElementById("siguiente").addEventListener("click", () => {
        paginaActual++;
        cargarUsuarios(true);
    });
});

function cargarUsuarios(verificarVacio = false) {
    const nombre = document.getElementById("filtroNombre").value;
    const email = document.getElementById("filtroEmail").value;

    const params = new URLSearchParams({ pagina: paginaActual, nombre, email });

    fetch("../backend/getUsuarios.php?" + params.toString())
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaUsuarios");
            tbody.innerHTML = "";

            if (data.usuarios.length === 0 && verificarVacio && paginaActual > 1) {
                paginaActual--;
                cargarUsuarios();
                return;
            }

            data.usuarios.forEach(usuario => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${usuario.Nombre} ${usuario.Apellidos}</td>
                    <td>${usuario.Email}</td>
                    <td>${usuario.Telefono}</td>
                    <td>${usuario.CodigoPostal}</td>
                    <td>${usuario.Provincia}</td>
                    <td>${usuario.Rol}</td>
                    <td>
                        <button onclick="eliminarUsuario(${usuario.Id}, '${usuario.Rol}')" class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        });
}

function eliminarUsuario(id, rol) {
    const mensaje = rol === 'admin'
        ? "Estás a punto de eliminar a un administrador. ¿Estás seguro?"
        : "¿Seguro que quieres eliminar este usuario?";

    if (!confirm(mensaje)) return;

    fetch("../backend/deleteUsuario.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + id
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Usuario eliminado correctamente.");
            cargarUsuarios();
        } else {
            alert("Error al eliminar: " + (data.error || "desconocido"));
        }
    });
}
