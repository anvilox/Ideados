document.addEventListener("DOMContentLoaded", () => {
    cargarCategorias();
    cargarProductos();

    document.getElementById("buscador").addEventListener("input", cargarProductos);
    document.getElementById("precioMin").addEventListener("input", cargarProductos);
    document.getElementById("precioMax").addEventListener("input", cargarProductos);
    document.getElementById("categoriaFiltro").addEventListener("change", cargarProductos);
    document.getElementById("ordenPrecio").addEventListener("change", cargarProductos);
});

function cargarCategorias() {
    fetch("../backend/getCategorias.php")
        .then(res => res.json())
        .then(categorias => {
            const select = document.getElementById("categoriaFiltro");
            categorias.forEach(cat => {
                const option = document.createElement("option");
                option.value = cat.Id;
                option.textContent = cat.Nombre;
                select.appendChild(option);
            });
        });
}

function cargarProductos() {
    const nombre = document.getElementById("buscador").value;
    const precioMin = document.getElementById("precioMin").value;
    const precioMax = document.getElementById("precioMax").value;
    const categoria = document.getElementById("categoriaFiltro").value;
    const orden = document.getElementById("ordenPrecio").value;

    const params = new URLSearchParams({ nombre, precioMin, precioMax, categoria, orden });

    fetch(`../backend/getCatalogo.php?${params.toString()}`)
        .then(res => res.json())
        .then(data => {
            const contenedor = document.getElementById("contenedor-productos");
            contenedor.innerHTML = "";

            if (data.success && data.productos.length > 0) {
                data.productos.forEach(prod => {
                    const enlace = document.createElement("a");
                    enlace.href = `producto.html?id=${prod.Id}&origen=catalogo`;
                    enlace.classList.add("card");

                    enlace.innerHTML = `
                        <img src="../assets/img/productos/${prod.Imagen}" alt="${prod.Nombre}" />
                        <h3>${prod.Nombre}</h3>
                        <p>${prod.Descripcion}</p>
                        <span>${parseFloat(prod.Precio).toFixed(2)} €</span>
                    `;

                    contenedor.appendChild(enlace);
                });
            } else {
                contenedor.innerHTML = "<p style='color: white;'>No se encontraron productos.</p>";
            }
        });
}
