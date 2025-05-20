<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

try {
    $stmt = $pdo->query("SELECT Id, Nombre, Descripcion, Precio, Imagen FROM Productos ORDER BY RAND() LIMIT 6");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "productos" => $productos]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
