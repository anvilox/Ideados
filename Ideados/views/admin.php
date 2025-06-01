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
  <title>Panel de Administración</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="../assets/css/admin.css">

  <link rel="stylesheet" href="../assets/css/animaciones.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="fade-in">
  <div class="container">
    <button class="btn btn-outline-danger btn-sm btn-salir" onclick="cerrarSesion()">Cerrar sesión</button>

    <div class="admin-header mb-4">
      <div class="welcome">Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></strong></div>
      <div class="datetime" id="datetime"></div>
    </div>

    <h2 class="text-center fw-semibold mb-4">Panel de Administración</h2>

    <div class="card-grid">
      <div class="card-action productos" onclick="location.href='productos.php?pagina=1'">
        <i class="bi bi-box-seam"></i>
        <div>Gestionar Productos</div>
      </div>
      <div class="card-action usuarios" onclick="location.href='usuarios.php'">
        <i class="bi bi-people-fill"></i>
        <div>Gestionar Usuarios</div>
      </div>
      <div class="card-action pedidos" onclick="location.href='pedidos.php'">
        <i class="bi bi-truck"></i>
        <div>Gestionar Pedidos</div>
      </div>
      <div class="card-action stats" onclick="location.href='estadisticas.php'">
        <i class="bi bi-bar-chart-fill"></i>
        <div>Ver estadísticas</div>
      </div>
      <div class="card-action cliente" onclick="verVistaCliente()">
        <i class="bi bi-eye"></i>
        <div>Ver vista cliente</div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin.js"></script>
</body>
</html>
