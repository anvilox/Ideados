<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$pagina = $_GET['pagina'] ?? 1;
$porPagina = 20;
$offset = ($pagina - 1) * $porPagina;

$sql = "SELECT p.Id, CONCAT(u.Nombre, ' ', u.Apellidos) AS Cliente, p.Fecha, p.Precio_Total, p.Estado
        FROM Pedidos p
        JOIN Usuarios u ON p.Usuario_Id = u.Id
        ORDER BY p.Id DESC
        LIMIT :offset, :limite";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
$stmt->bindValue(':limite', (int)$porPagina, PDO::PARAM_INT);
$stmt->execute();

$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $pdo->query("SELECT COUNT(*) FROM Pedidos")->fetchColumn();

echo json_encode([
    "pedidos" => $pedidos,
    "total" => (int)$total
]);
