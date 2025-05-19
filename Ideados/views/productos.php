<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] != 1) {
  header("Location: login.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/productos.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/gestionProductos.js"></script>

</head>
<body>

    <!-- Botón flotante para añadir -->
    <button class="btn btn-primary rounded-pill btn-fijo-top d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#modalAgregar">
        <i class="bi bi-plus-circle fs-5"></i>
        <span class="d-none d-sm-inline">Añadir producto</span>
    </button>

    <div class="container">
        <a href="admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
        <h2 class="mb-4 text-center">Gestión de Productos</h2>

        <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio (€)</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            <tbody id="tabla-productos">
            <!-- Aquí se cargan los productos dinámicamente -->
            </tbody>
        </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-outline-secondary me-2" id="anterior" disabled>Anterior</button>
            <button class="btn btn-outline-secondary" id="siguiente">Siguiente</button>
        </div>
    </div>

    <!-- Modal para añadir producto -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formAgregar" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select class="form-select" name="categoria" id="categoria-select" required>
                                <option value="">Selecciona una categoría</option>
                                <!-- Se rellena dinámicamente -->
                            </select>
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-1" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                                <i class="bi bi-plus-circle"></i> Añadir categoría
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" class="form-control" name="stock" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio (€)</label>
                            <input type="number" class="form-control" name="precio" step="0.01" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen (JPG)</label>
                            <input type="file" class="form-control" name="imagen" accept=".jpg" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Producto -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditar">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editar-id">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editar-nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="editar-descripcion" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="categoria" id="editar-categoria" required></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="editar-stock" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio (€)</label>
                        <input type="number" class="form-control" name="precio" id="editar-precio" step="0.01" min="0" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Categoría -->
    <div class="modal fade" id="modalCategoria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formCategoria">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la categoría</label>
                        <input type="text" class="form-control" name="nombre_categoria" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
