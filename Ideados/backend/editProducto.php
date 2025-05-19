<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
require_once "database/conexion.php";


$id = $_POST['id'] ?? null;
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$categoria = $_POST['categoria'] ?? null;
$stock = $_POST['stock'] ?? 0;
$precio = $_POST['precio'] ?? 0;

// Validaciones básicas
if (!$id || !$nombre || !$descripcion || !$categoria || !is_numeric($stock) || !is_numeric($precio)) {
    echo json_encode(["success" => false, "error" => "Datos incompletos o inválidos."]);
    exit;
}

// Validaciones con expresiones regulares
$nombreRegex = '/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{2,}$/';
$descripcionRegex = '/^.{5,}$/';

if (!preg_match($nombreRegex, $nombre)) {
    echo json_encode(["success" => false, "error" => "Nombre inválido. Solo letras y espacios, mínimo 2 caracteres."]);
    exit;
}

if (!preg_match($descripcionRegex, $descripcion)) {
    echo json_encode(["success" => false, "error" => "Descripción inválida. Debe tener al menos 5 caracteres."]);
    exit;
}

if ($stock < 0) {
    echo json_encode(["success" => false, "error" => "El stock no puede ser negativo."]);
    exit;
}

if ($precio <= 0) {
    echo json_encode(["success" => false, "error" => "El precio debe ser mayor que 0."]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE Productos 
                           SET Nombre = ?, Descripcion = ?, Categoria_Id = ?, Stock = ?, Precio = ?
                           WHERE Id = ?");
    $stmt->execute([$nombre, $descripcion, $categoria, $stock, $precio, $id]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
