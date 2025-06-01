<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$id = $_POST['id'] ?? null;
$estado = $_POST['estado'] ?? '';

if (!$id || !in_array($estado, ['Pendiente', 'Completado', 'Cancelado'])) {
    echo json_encode(["success" => false, "error" => "Datos inválidos"]);
    exit;
}

$stmt = $pdo->prepare("UPDATE Pedidos SET Estado = ? WHERE Id = ?");
if ($stmt->execute([$estado, $id])) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "No se pudo actualizar"]);
}
