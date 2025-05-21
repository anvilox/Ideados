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
    <link rel="stylesheet" href="../assets/css/usuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="cabecera">
        <h1 class="logo"><a href="../index.html">Ideados</a></h1>
        <div class="usuario-info">
            <a href="admin.php" class="btn-header">← Volver al panel</a>
            <button onclick="cerrarSesion()" class="btn-header">Cerrar sesión</button>
        </div>
    </header>

    <main class="admin-main container">
        <h2 class="text-center text-warning mb-4">Gestión de Usuarios</h2>

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
            <button class="btn btn-outline-light me-2" id="anterior">Anterior</button>
            <button class="btn btn-outline-light" id="siguiente">Siguiente</button>
        </div>
    </main>

    <script src="../assets/js/gestionUsuarios.js"></script>
</body>
</html>
