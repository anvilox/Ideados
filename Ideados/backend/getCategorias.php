<?php
header("Content-Type: application/json");
require_once "database/conexion.php";

try {
    $stmt = $pdo->query("SELECT Id, Nombre FROM Categorias ORDER BY Nombre ASC");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categorias);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
