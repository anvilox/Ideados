<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$categoria_id = $_POST['categoria'] ?? null;
$stock = $_POST['stock'] ?? 0;
$precio = $_POST['precio'] ?? 0;

// Validaciones básicas
if (!$nombre || !$descripcion || !$categoria_id || !is_numeric($stock) || !is_numeric($precio)) {
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
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

// Preparar nombre del archivo de imagen
$nombreArchivo = strtolower(str_replace(' ', '_', $nombre)) . ".jpg";
$rutaDestino = "../assets/img/productos/" . $nombreArchivo;

// Verificar si se subió imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $tipo = mime_content_type($_FILES['imagen']['tmp_name']);
    
    if ($tipo === 'image/jpeg') {
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            echo json_encode(["success" => false, "error" => "Error al guardar la imagen."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "error" => "Solo se permiten imágenes JPG."]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "error" => "Imagen no recibida."]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO Productos (Nombre, Descripcion, Categoria_Id, Stock, Precio, Imagen)
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $categoria_id, $stock, $precio, $nombreArchivo]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
