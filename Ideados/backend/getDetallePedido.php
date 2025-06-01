<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT dp.Cantidad, dp.Precio_Unitario, p.Nombre
    FROM DetallePedido dp
    JOIN Productos p ON dp.Producto_Id = p.Id
    WHERE dp.Pedido_Id = ?
");
$stmt->execute([$id]);
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($detalles);
