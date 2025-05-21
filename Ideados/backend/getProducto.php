<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["success" => false, "error" => "ID no especificado."]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT Id, Nombre, Descripcion, Precio, Stock, Imagen FROM Productos WHERE Id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        echo json_encode(["success" => true, "producto" => $producto]);
    } else {
        echo json_encode(["success" => false, "error" => "Producto no encontrado."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
