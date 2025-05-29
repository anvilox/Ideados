<?php
session_start();
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['productos']) || !is_array($data['productos'])) {
    echo json_encode(["success" => false, "error" => "Datos inválidos."]);
    exit;
}

try {
    $pdo->beginTransaction();

    $usuarioId = $_SESSION['usuario']['id'];
    $total = 0;

    foreach ($data['productos'] as $p) {
        $total += $p['precio'] * $p['cantidad'];
    }

    // Insertar pedido
    $stmt = $pdo->prepare("INSERT INTO Pedidos (Usuario_Id, Precio_Total, Estado) VALUES (?, ?, 'Pendiente')");
    $stmt->execute([$usuarioId, $total]);
    $pedidoId = $pdo->lastInsertId();

    // Insertar detalles y actualizar stock
    foreach ($data['productos'] as $p) {
        // Insertar detalle
        $stmt = $pdo->prepare("INSERT INTO DetallePedido (Pedido_Id, Producto_Id, Cantidad, Precio_Unitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pedidoId, $p['id'], $p['cantidad'], $p['precio']]);

        // Actualizar stock
        $stmt = $pdo->prepare("UPDATE Productos SET Stock = Stock - ? WHERE Id = ?");
        $stmt->execute([$p['cantidad'], $p['id']]);
    }

    $pdo->commit();

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(["success" => false, "error" => "Error al guardar el pedido: " . $e->getMessage()]);
}