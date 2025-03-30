<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$id = $_POST['id'] ?? null;

if ($id && is_numeric($id)) {
    try {
        // Obtener nombre de la imagen antes de borrar
        $stmt = $pdo->prepare("SELECT Imagen FROM Productos WHERE Id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch();

        if ($producto && !empty($producto['Imagen'])) {
            $rutaImagen = "../assets/img/productos/" . $producto['Imagen'];
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen); // Eliminar imagen física
            }
        }

        // Eliminar producto de la base de datos
        $stmt = $pdo->prepare("DELETE FROM Productos WHERE Id = ?");
        $stmt->execute([$id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID inválido."]);
}
