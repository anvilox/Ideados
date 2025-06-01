<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <a href="admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
        <h2 class="text-center mb-4">Gestión de Pedidos</h2>
        <div class="table-responsive">
            <table class="table table-dark table-hover text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Precio Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaPedidos"></tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-secondary me-2" id="anterior">Anterior</button>
            <button class="btn btn-outline-secondary" id="siguiente">Siguiente</button>
        </div>

        <div class="indicador-wrapper">
            <div class="text-center text-light mt-2" id="indicadorPagina"></div>
        </div>
    </div>


    <div class="modal fade" id="modal-detalles" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
        <div class="modal-header">
            <h5 class="modal-title">Detalles del pedido</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="modal-detalles-body">
            <!-- Aquí van los detalles -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/gestionPedidos.js"></script>

    <link rel="stylesheet" href="../assets/css/pedidos.css">
</body>
</html>