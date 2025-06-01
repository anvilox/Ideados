<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$porPagina = 20;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $porPagina;

try {
    $stmt = $pdo->prepare("
        SELECT p.Id, p.Nombre, p.Descripcion, p.Stock, p.Precio, p.Imagen, c.Nombre AS Categoria
        FROM Productos p
        JOIN Categorias c ON p.Categoria_Id = c.Id
        ORDER BY p.Id DESC
        LIMIT :inicio, :limite
    ");

    $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
    $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
    $stmt->execute();

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalStmt = $pdo->query("SELECT COUNT(*) FROM Productos");
    $totalProductos = $totalStmt->fetchColumn();

    echo json_encode([
        "productos" => $productos,
        "total" => (int)$totalProductos,
        "porPagina" => $porPagina
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "error" => "Error al obtener productos: " . $e->getMessage()
    ]);
}
