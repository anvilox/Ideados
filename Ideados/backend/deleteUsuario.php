<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["success" => false, "error" => "ID no recibido"]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT Rol FROM Usuarios WHERE Id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo json_encode(["success" => false, "error" => "Usuario no encontrado"]);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM Usuarios WHERE Id = ?");
    $stmt->execute([$id]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
