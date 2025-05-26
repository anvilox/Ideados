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

        fetch("../backend/verificarSesion.php")
            .then(res => res.json())
            .then(usuario => {
            const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

            if (!usuario.logueado) {
                contenido.innerHTML = `
                <p class="mensaje-carrito">Debes iniciar sesión para comprar.</p>
                <div class="d-flex justify-content-center">
                    <a href="login.html" class="btn btn-outline-light">Iniciar sesión</a>
                </div>
                `;
                return;
            }

            if (carrito.length === 0) {
                contenido.innerHTML = `
                <p class="mensaje-carrito">Tu carrito está vacío. Añade los productos que deseas.</p>
                `;
                return;
            }

            let html = `<ul class="lista-carrito">`;

            let total = 0;
            carrito.forEach(item => {
                const subtotal = item.precio * item.cantidad;
                total += subtotal;

                html += `
                <li class="item-carrito">
                    <span>${item.nombre}</span>
                    <span>${item.cantidad} x ${item.precio.toFixed(2)}€</span>
                </li>
                `;
            });

            html += `</ul>
                <hr>
                <div class="total-carrito text-end mb-3">
                <strong>Total:</strong> ${total.toFixed(2)}€
                </div>
                <div class="d-grid">
                <button class="btn btn-success">Realizar pedido</button>
                </div>
            `;

            contenido.innerHTML = html;
            });
    }
});
