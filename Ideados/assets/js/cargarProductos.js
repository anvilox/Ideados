document.addEventListener("DOMContentLoaded", function() {
    fetch("../backend/getProductos.php")
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById("productos-container");
            container.innerHTML = "";
            data.forEach(producto => {
                const productoHTML = `
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="../assets/img/productos/${producto.Imagen}" class="card-img-top" alt="${producto.Nombre}">
                            <div class="card-body">
                                <h5 class="card-title">${producto.Nombre}</h5>
                                <p class="card-text">${producto.Descripcion}</p>
                                <p class="text-primary"><strong>${producto.Precio} €</strong></p>
                                <a href="producto.html?id=${producto.Id}" class="btn btn-success">Ver más</a>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += productoHTML;
            });
        })
        .catch(error => console.error("Error al cargar los productos:", error));
});
