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
    const correo = document.getElementById("filtroEmail").value;

    const params = new URLSearchParams({ pagina: paginaActual, nombre, correo });

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
                let rol = usuario.Rol === '1' ? 'Administrador' : 'Usuario';
                
                tr.innerHTML = `
                    <td><i class="bi bi-person-circle me-1 text-warning"></i>${usuario.Nombre} ${usuario.Apellidos}</td>
                    <td>${usuario.Correo}</td>
                    <td>${usuario.Teléfono}</td>
                    <td>${usuario.Código_Postal}</td>
                    <td>${usuario.Provincia}</td>
                    <td>${rol}</td>
                    <td>
                        <button onclick="alternarRol(${usuario.Id}, ${usuario.Rol})" class="btn btn-sm ${usuario.Rol === '1' ? 'btn-secondary' : 'btn-success'} me-1" title="${usuario.Rol === '1' ? 'Quitar rol de admin' : 'Hacer administrador'}">
                            <i class="bi ${usuario.Rol === '1' ? 'bi-person-dash-fill' : 'bi-person-plus-fill'}"></i>
                        </button>
                        <button onclick="eliminarUsuario(${usuario.Id}, '${usuario.Rol}')" class="btn btn-sm btn-danger" title="Eliminar usuario">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            const totalPaginas = Math.ceil(data.total / 20);
            document.getElementById("indicadorPagina").textContent =
                `Página ${paginaActual} de ${totalPaginas}`;

            const btnAnterior = document.getElementById("anterior");
            const btnSiguiente = document.getElementById("siguiente");

            btnAnterior.disabled = paginaActual <= 1;
            btnSiguiente.disabled = paginaActual >= totalPaginas;
        });
}

function eliminarUsuario(id, rol) {
    const mensaje = rol === '1'
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

function alternarRol(id, rolActual) {
    const mensaje = rolActual === 1
        ? "Vas a quitar los privilegios de administrador a este usuario. ¿Estás de acuerdo?"
        : "Vas a hacer administrador a este usuario. ¿Estás de acuerdo?";

    if (!confirm(mensaje)) return;

    fetch("../backend/actualizarRol.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}&nuevoRol=${rolActual === 1 ? 0 : 1}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Rol actualizado correctamente.");
            cargarUsuarios();
        } else {
            alert("Error al actualizar rol: " + (data.error || "desconocido"));
        }
    });
}
