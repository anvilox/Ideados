<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$id = $_POST['id'] ?? null;
$nuevoRol = $_POST['nuevoRol'] ?? null;

if (!$id || !in_array($nuevoRol, ['0', '1'])) {
    echo json_encode(["success" => false, "error" => "Datos inválidos"]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE Usuarios SET Rol = ? WHERE Id = ?");
    $stmt->execute([$nuevoRol, $id]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
