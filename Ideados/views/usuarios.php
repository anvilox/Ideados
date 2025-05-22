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
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <main class="admin-main container">
        <a href="admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
        <h2 class="text-center mb-4">Gestión de Usuarios</h2>

        <div class="row justify-content-center mb-4">
            <div class="col-md-4">
                <input type="text" id="filtroNombre" class="form-control" placeholder="Filtrar por nombre...">
            </div>
            <div class="col-md-4">
                <input type="text" id="filtroEmail" class="form-control" placeholder="Filtrar por correo...">
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-dark table-hover table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Código Postal</th>
                        <th>Provincia</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tablaUsuarios"></tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-secondary me-2" id="anterior">Anterior</button>
            <button class="btn btn-outline-secondary" id="siguiente">Siguiente</button>
        </div>

        <div class="indicador-wrapper">
            <div class="text-center text-light mt-2" id="indicadorPagina"></div>
        </div>
    </main>

    <script src="../assets/js/gestionUsuarios.js"></script>
    
    <link rel="stylesheet" href="../assets/css/usuarios.css">
</body>
</html>
