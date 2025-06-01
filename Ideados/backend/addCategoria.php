<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$nombre = $_POST['nombre_categoria'] ?? '';

if (!$nombre) {
    echo json_encode(["success" => false, "error" => "Nombre vacío."]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO Categorias (Nombre) VALUES (?)");
    $stmt->execute([$nombre]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
