<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

// Obtener la fecha hace un mes
$unMesAtras = date("Y-m-d H:i:s", strtotime("-1 month"));

try {
    // Total de usuarios
    $usuarios = $pdo->query("SELECT COUNT(*) FROM Usuarios")->fetchColumn();

    // Total de administradores
    $admins = $pdo->query("SELECT COUNT(*) FROM Usuarios WHERE Rol = 1")->fetchColumn();

    // Total de productos
    $productos = $pdo->query("SELECT COUNT(*) FROM Productos")->fetchColumn();

    // Total de pedidos
    $pedidos = $pdo->query("SELECT COUNT(*) FROM Pedidos")->fetchColumn();

    // Total ventas del último mes
    $stmt = $pdo->prepare("SELECT SUM(Precio_Total) FROM Pedidos WHERE Fecha >= ? AND Estado = 'Completado'");
    $stmt->execute([$unMesAtras]);
    $ventasUltimoMes = $stmt->fetchColumn() ?? 0;

    echo json_encode([
        "usuarios" => (int)$usuarios,
        "admins" => (int)$admins,
        "productos" => (int)$productos,
        "pedidos" => (int)$pedidos,
        "ventasUltimoMes" => number_format($ventasUltimoMes, 2)
    ]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al obtener estadísticas: " . $e->getMessage()]);
}