document.addEventListener("DOMContentLoaded", () => {
    cargarProducto();
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
                document.getElementById("imagen-producto").src = `../assets/img/productos/${prod.Imagen}`;
                document.getElementById("imagen-producto").alt = prod.Nombre;
                document.getElementById("nombre-producto").textContent = prod.Nombre;
                document.getElementById("descripcion-producto").textContent = prod.Descripcion;
                document.getElementById("precio-producto").textContent = `${parseFloat(prod.Precio).toFixed(2)} €`;
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
