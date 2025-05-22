document.addEventListener("DOMContentLoaded", () => {
    fetch("../backend/getDestacados.php")
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const contenedor = document.querySelector(".productos-grid");
                contenedor.innerHTML = ""; 

                data.productos.forEach(prod => {
                    const enlace = document.createElement("a");
                    enlace.href = `producto.html?id=${prod.Id}&origen=index`;
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
                console.error("Error al cargar productos destacados:", data.error);
            }
        })
        .catch(err => console.error("Error en la petición:", err));
});
