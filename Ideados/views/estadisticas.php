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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Estadísticas - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <main class="container my-5">
        <a href="admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
        <h1 class="text-center mb-4">Estadísticas Generales</h1>
        <div class="row g-4" id="estadisticas">
            <!-- Tarjetas generadas dinámicamente -->
        </div>
        <div class="text-center mt-4">
            <a href="admin.php" class="btn btn-outline-light">Volver al panel</a>
        </div>
    </main>
    <script src="../assets/js/estadisticas.js"></script>
</body>
</html>