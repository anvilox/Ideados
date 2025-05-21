<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

// Obtener parámetros GET
$nombre = $_GET['nombre'] ?? '';
$precioMin = $_GET['precioMin'] ?? '';
$precioMax = $_GET['precioMax'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$orden = $_GET['orden'] ?? '';


$condiciones = [];
$parametros = [];

// Filtro por nombre
if (!empty($nombre)) {
    $condiciones[] = "p.Nombre LIKE ?";
    $parametros[] = "%$nombre%";
}

// Filtro por precio mínimo
if (is_numeric($precioMin)) {
    $condiciones[] = "p.Precio >= ?";
    $parametros[] = $precioMin;
}

// Filtro por precio máximo
if (is_numeric($precioMax)) {
    $condiciones[] = "p.Precio <= ?";
    $parametros[] = $precioMax;
}

// Filtro por categoría
if (!empty($categoria)) {
    $condiciones[] = "p.Categoria_Id = ?";
    $parametros[] = $categoria;
}

// Armar la consulta
$sql = "SELECT p.Id, p.Nombre, p.Descripcion, p.Precio, p.Imagen
        FROM Productos p";

if (!empty($condiciones)) {
    $sql .= " WHERE " . implode(" AND ", $condiciones);
}

// Ordenar resultados
if ($orden === "asc") {
    $sql .= " ORDER BY p.Precio ASC";
} elseif ($orden === "desc") {
    $sql .= " ORDER BY p.Precio DESC";
} else {
    $sql .= " ORDER BY p.Nombre ASC";
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($parametros);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "productos" => $productos]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
