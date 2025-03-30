<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

try {

    $stmt = $pdo->query("SELECT Id, Nombre, Descripcion, Precio, Imagen FROM Productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($productos);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
