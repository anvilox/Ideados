let paginaActual = 1;

document.addEventListener("DOMContentLoaded", () => {
    cargarPedidos();

    document.getElementById("anterior").addEventListener("click", () => {
        if (paginaActual > 1) {
            paginaActual--;
            cargarPedidos();
        }
    });

    document.getElementById("siguiente").addEventListener("click", () => {
        paginaActual++;
        cargarPedidos(true);
    });
});

function cargarPedidos(verificarVacio = false) {
    fetch(`../backend/getPedidos.php?pagina=${paginaActual}`)
        .then(res => res.json())
        .then(data => {
            const tabla = document.getElementById("tablaPedidos");
            tabla.innerHTML = "";

            if (data.pedidos.length === 0 && verificarVacio && paginaActual > 1) {
                paginaActual--;
                cargarPedidos();
                return;
            }

            data.pedidos.forEach(pedido => {
                let iconoEstado = '<i class="bi bi-hourglass-split estado-icono estado-pendiente"></i>';
                if (pedido.Estado === "Completado") iconoEstado = '<i class="bi bi-check-circle-fill estado-icono estado-completado"></i>';
                else if (pedido.Estado === "Cancelado") iconoEstado = '<i class="bi bi-x-circle-fill estado-icono estado-cancelado"></i>';

                tabla.innerHTML += `
                    <tr>
                        <td>${pedido.Id}</td>
                        <td>${pedido.Cliente}</td>
                        <td>${pedido.Fecha}</td>
                        <td>${pedido.Precio_Total} €</td>
                        <td>${iconoEstado}</td>
                        <td>
                            <button 
                                onclick="verDetallesPedido(${pedido.Id})" 
                                class="btn btn-outline-info btn-sm me-1"
                                title="Ver detalles"
                            >
                                <i class="bi bi-eye-fill"></i>
                            </button>
                            <button 
                                onclick="cambiarEstado(${pedido.Id}, 'Completado')" 
                                class="btn btn-success btn-sm me-1"
                                ${pedido.Estado !== 'Pendiente' ? 'disabled' : ''}
                            >
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                            <button 
                                onclick="cambiarEstado(${pedido.Id}, 'Cancelado')" 
                                class="btn btn-danger btn-sm"
                                ${pedido.Estado !== 'Pendiente' ? 'disabled' : ''}
                            >
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </td>
                    </tr>
                `;
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

function cambiarEstado(id, nuevoEstado) {
    if (!confirm(`¿Estás seguro de cambiar el estado del pedido a ${nuevoEstado}?`)) return;

    fetch("../backend/actualizarEstadoPedido.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}&estado=${nuevoEstado}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Estado actualizado correctamente.");
            cargarPedidos();
        } else {
            alert("Error al actualizar estado.");
        }
    });
}

function verDetallesPedido(pedidoId) {
    fetch(`../backend/getDetallePedido.php?id=${pedidoId}`)
        .then(res => res.json())
        .then(data => {
            const modalBody = document.getElementById("modal-detalles-body");
            modalBody.innerHTML = "";

            if (data.length === 0) {
                modalBody.innerHTML = "<p>No hay detalles para este pedido.</p>";
            } else {
                data.forEach(item => {
                    modalBody.innerHTML += `
                        <div class="mb-2 border-bottom pb-2">
                            <strong>${item.Nombre}</strong><br>
                            Cantidad: ${item.Cantidad} <br>
                            Precio unitario: ${item.Precio_Unitario} €
                        </div>
                    `;
                });
            }

            const modal = new bootstrap.Modal(document.getElementById("modal-detalles"));
            modal.show();
        });
}
