let paginaActual = 1;
const porPagina = 20;

document.addEventListener("DOMContentLoaded", () => {
    actualizarSelectCategorias();
    cargarProductos();

    document.getElementById("formCategoria").addEventListener("submit", function (e) {
        e.preventDefault();
        const datos = new FormData(this);

        const nombreCategoria = datos.get("nombre_categoria").trim();
        const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{2,}$/;

        if (!nombreRegex.test(nombreCategoria)) {
            alert("El nombre solo puede contener letras y espacios (mínimo 2 caracteres).");
            return;
        }

        fetch("../backend/addCategoria.php", {
            method: "POST",
            body: datos
        })
            .then(res => res.json())
            .then(data => {
            if (data.success) {
                alert("Categoría añadida.");
                bootstrap.Modal.getInstance(document.getElementById("modalCategoria")).hide();
                this.reset();
                actualizarSelectCategorias(); // Vuelve a cargar las categorías
            } else {
                alert("Error: " + (data.error || "No se pudo añadir la categoría."));
            }
            })
            .catch(err => {
            console.error("Error:", err);
        });
    });

    // Añadir producto
    document.getElementById("formAgregar").addEventListener("submit", function (e) {
        e.preventDefault();

        const datos = new FormData(this);

        fetch("../backend/addProducto.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(data => {
        if (data.success) {
            alert("Producto añadido correctamente.");
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById("modalAgregar")).hide();
            cargarProductos();
        } else {
            alert("Error al añadir producto.");
        }
        })
        .catch(err => {
        console.error("Error:", err);
        });
    });

    // Paginación
    document.getElementById("anterior").addEventListener("click", () => {
        if (paginaActual > 1) {
        paginaActual--;
        cargarProductos();
        }
    });

    document.getElementById("siguiente").addEventListener("click", () => {
        paginaActual++;
        cargarProductos();
    });
});

function actualizarSelectCategorias() {

    fetch("../backend/getCategorias.php")
    .then(res => res.json())
    .then(data => {
        const select = document.getElementById("categoria-select");
        select.innerHTML = ""; // Limpiar opciones existentes
        data.forEach(cat => {
        const option = document.createElement("option");
        option.value = cat.Id;
        option.textContent = cat.Nombre;
        select.appendChild(option);
        });
    })
    .catch(err => console.error("Error al cargar categorías:", err));
}

function cargarProductos() {
    fetch(`../backend/getProductosTabla.php?pagina=${paginaActual}`)
        .then(res => res.json())
        .then(data => {
        const tabla = document.getElementById("tabla-productos");
        tabla.innerHTML = "";

        const productos = data.productos;
        const total = data.total;

        productos.forEach(prod => {
            const stock = parseInt(prod.Stock);
            let claseStock = "stock-alto";
            if (stock <= 5) claseStock = "stock-bajo";
            else if (stock <= 10) claseStock = "stock-medio";
            let icono = "🔺";
            if (stock <= 5) icono = "🔻";
            else if (stock <= 10) icono = "➖";

            const fila = document.createElement("tr");
            fila.innerHTML = `
            <td>
                <img src="../assets/img/productos/${prod.Imagen}" alt="${prod.Nombre}" width="50" class="rounded">
            </td>
            <td>${prod.Nombre}</td>
            <td>${prod.Descripcion}</td>
            <td>${prod.Categoria}</td>
            <td class="${claseStock}">${icono} ${stock}</td>
            <td>${parseFloat(prod.Precio).toFixed(2)}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-2" title="Editar"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-outline-danger" onclick="eliminarProducto(${prod.Id})" title="Eliminar"><i class="bi bi-trash"></i></button>
            </td>
            `;
            tabla.appendChild(fila);
        });

        // Controlar botones de paginación
        document.getElementById("anterior").disabled = paginaActual === 1;
        const totalPaginas = Math.ceil(total / porPagina);
        document.getElementById("siguiente").disabled = paginaActual >= totalPaginas;
        })
        .catch(err => {
        console.error("Error al cargar productos:", err);
    });
}

function eliminarProducto(id) {
    if (!confirm("¿Estás seguro de que quieres eliminar este producto?")) return;

    fetch("../backend/deleteProducto.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
        alert("Producto eliminado correctamente.");
        cargarProductos();
        } else {
        alert("Error al eliminar producto.");
        }
    })
    .catch(err => {
        console.error("Error:", err);
    });
}
