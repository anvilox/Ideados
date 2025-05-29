document.addEventListener("DOMContentLoaded", () => {
    const carritoHTML = `
        <div id="carrito-panel" class="carrito-panel">
        <div class="carrito-header">
            <span>Carrito</span>
            <button id="cerrarCarrito" class="btn-cerrar">&times;</button>
        </div>
        <div id="carrito-contenido" class="carrito-contenido">
            
        </div>
        </div>
        <button id="carrito-flotante" class="carrito-boton">
        <i class="bi bi-cart-fill"></i>
        </button>
    `;

    document.body.insertAdjacentHTML("beforeend", carritoHTML);

    const panel = document.getElementById("carrito-panel");
    const btnAbrir = document.getElementById("carrito-flotante");
    const btnCerrar = document.getElementById("cerrarCarrito");

    btnAbrir.addEventListener("click", () => {
        panel.classList.add("activo");
        renderizarCarritoPanel();
    });

    btnCerrar.addEventListener("click", () => {
        panel.classList.remove("activo");
    });

    document.addEventListener("click", (e) => {
        if (!panel.contains(e.target) && e.target !== btnAbrir && panel.classList.contains("activo")) {
        panel.classList.remove("activo");
        }
    });

    function renderizarCarritoPanel() {
        const contenido = document.getElementById("carrito-contenido");
        contenido.innerHTML = "";

        fetch("../backend/verificarSesion.php")
            .then(res => res.json())
        .then(data => {
            if (!data.logueado) {
                contenido.innerHTML = `
                    <p class="text-center">Debes iniciar sesión para comprar.</p>
                    <div class="text-center">
                        <a href="login.html" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
                    </div>
                `;
                return;
            }

            const carrito = obtenerCarrito();

            if (carrito.length === 0) {
                contenido.innerHTML = `<p class="text-center">Añade los productos que deseas.</p>`;
                return;
            }

            let total = 0;
            carrito.forEach(p => {
                const subtotal = p.precio * p.cantidad;
                total += subtotal;
                contenido.innerHTML += `
                    <div class="border-bottom mb-2 pb-2">
                        <strong>${p.nombre}</strong><br>
                        Cantidad: ${p.cantidad}<br>
                        Total: ${subtotal.toFixed(2)} €
                    </div>
                `;
            });

            contenido.innerHTML += `
                <div class="text-center mt-3">
                    <strong>Total: ${total.toFixed(2)} €</strong><br>
                    <div class="d-flex justify-content-center align-items-center gap-2 mt-3 flex-wrap">
                        <button id="vaciar-carrito" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash3 me-1"></i> Vaciar carrito
                        </button>
                        <button class="btn btn-light btn-sm" id="realizar-pedido">
                            Realizar pedido
                        </button>
                    </div>
                </div>
            `;
            document.getElementById("vaciar-carrito").addEventListener("click", () => {
                vaciarCarrito();
                renderizarCarritoPanel();
            });
            document.getElementById("realizar-pedido").addEventListener("click", () => {
                const carrito = obtenerCarrito();

                fetch("../backend/realizarPedido.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ productos: carrito })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Pedido realizado con éxito.");
                        vaciarCarrito();
                        renderizarCarritoPanel();
                        location.reload();
                    } else {
                        alert("Error al procesar el pedido: " + data.error);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("Hubo un error inesperado.");
                });
            });

        });
    }
});

// Funciones del carrito

// Obtener carrito desde localStorage
function obtenerCarrito() {
    const datos = localStorage.getItem("carrito");
    return datos ? JSON.parse(datos) : [];
}

// Guardar carrito en localStorage
function guardarCarrito(carrito) {
    localStorage.setItem("carrito", JSON.stringify(carrito));
}

// Vaciar el carrito
function vaciarCarrito() {
    localStorage.removeItem("carrito");
}

// Añadir o actualizar un producto
function agregarAlCarrito(producto) {
    const carrito = obtenerCarrito();
    const existente = carrito.find(p => p.id === producto.id);

    if (existente) {
        existente.cantidad = producto.cantidad;
    } else {
        carrito.push(producto);
    }

    guardarCarrito(carrito);
}
