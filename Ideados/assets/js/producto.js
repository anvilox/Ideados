document.addEventListener("DOMContentLoaded", () => {
    cargarProducto();
    const params = new URLSearchParams(window.location.search);
    const origen = params.get("origen");

    const btnVolver = document.getElementById("btnVolver");
    if (origen === "catalogo") {
        btnVolver.href = "catalogo.html";
    } else {
        btnVolver.href = "index.html"; 
    }
});

document.getElementById("btnAddCarrito").addEventListener("click", () => {
    const cantidad = parseInt(document.getElementById("cantidad").value);
    const producto = {
        id: parseInt(document.getElementById("id-producto").value),
        nombre: document.getElementById("nombre-producto").textContent,
        precio: parseFloat(document.getElementById("precio-producto").dataset.valor),
        cantidad
    };

    agregarAlCarrito(producto);
    alert("Producto añadido al carrito");
});



function cargarProducto() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");

    if (!id) return;

    fetch(`../backend/getProducto.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const prod = data.producto;
                document.getElementById("id-producto").value = id;
                document.getElementById("imagen-producto").src = `../assets/img/productos/${prod.Imagen}`;
                document.getElementById("imagen-producto").alt = prod.Nombre;
                document.getElementById("nombre-producto").textContent = prod.Nombre;
                document.getElementById("descripcion-producto").textContent = prod.Descripcion;
                const precioSpan = document.getElementById("precio-producto");
                const precioNumerico = parseFloat(prod.Precio).toFixed(2);

                precioSpan.textContent = `${precioNumerico} €`;
                precioSpan.dataset.valor = precioNumerico;
                document.getElementById("stock-producto").textContent = `Stock: ${prod.Stock}`;
                
                const inputCantidad = document.getElementById("cantidad");
                inputCantidad.max = prod.Stock;
                if (prod.Stock == 0) {
                    inputCantidad.disabled = true;
                    document.querySelector(".btn-carrito").disabled = true;
                    document.querySelector(".btn-carrito").textContent = "Sin stock";
                }
            }
        })
        .catch(err => {
            console.error("Error al cargar producto:", err);
        });
}
