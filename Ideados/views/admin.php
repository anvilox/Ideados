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
  <title>Panel de Administración</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/admin.css">
  <link rel="stylesheet" href="../assets/css/animaciones.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="admin-box fade-in">

    <div class="d-flex justify-content-end mb-2">
        <button class="btn btn-outline-danger btn-sm" onclick="cerrarSesion()">Cerrar sesión</button>
    </div>

    <p class="text-start fw-semibold mb-2">
        Bienvenido, <span class="text-primary"><?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
    </p>
      <h2 class="admin-title text-center mb-4">Panel de Administración</h2>

      <div class="d-grid gap-3">
        <button class="btn btn-primary admin-btn">Gestionar productos</button>
        <button class="btn btn-secondary admin-btn">Gestionar usuarios</button>
        <button class="btn btn-warning admin-btn">Gestionar pedidos</button>
        <button class="btn btn-dark admin-btn">Ver estadísticas</button>
        <button class="btn btn-outline-info admin-btn" onclick="verVistaCliente()">Ver vista cliente</button>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin.js"></script>
</body>
</html>
