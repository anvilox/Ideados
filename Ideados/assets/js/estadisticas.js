document.addEventListener("DOMContentLoaded", () => {
    fetch("../backend/getEstadisticas.php")
        .then(res => res.json())
        .then(data => {
            const contenedor = document.getElementById("estadisticas");
            contenedor.innerHTML = `
                <div class="col-md-4">
                    <div class="card bg-info text-light h-100 shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Usuarios Registrados</h5>
                            <p class="display-6">${data.usuarios}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-light h-100 shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Administradores</h5>
                            <p class="display-6">${data.admins}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-light h-100 shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Productos Totales</h5>
                            <p class="display-6">${data.productos}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-info text-light h-100 shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pedidos Totales</h5>
                            <p class="display-6">${data.pedidos}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-success text-light h-100 shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ventas Último Mes</h5>
                            <p class="display-6">${data.ventasUltimoMes} €</p>
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(err => {
            document.getElementById("estadisticas").innerHTML = "<p class='text-danger text-center'>Error al cargar estadísticas.</p>";
            console.error("Error:", err);
        });
});
