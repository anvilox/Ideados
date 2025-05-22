<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";

$pagina = $_GET['pagina'] ?? 1;
$nombre = $_GET['nombre'] ?? '';
$correo = $_GET['correo'] ?? '';
$porPagina = 20;
$offset = ($pagina - 1) * $porPagina;

try{
    $stmt = $pdo->prepare("
            SELECT Id, Nombre, Apellidos, Correo, Teléfono, Código_Postal, Provincia, Rol
            FROM Usuarios
            WHERE (Nombre LIKE :nombre OR Apellidos LIKE :nombre)
            AND Correo LIKE :correo
            LIMIT :offset, :limite
        ");
    $stmt->bindValue(':nombre', "%$nombre%", PDO::PARAM_STR);
    $stmt->bindValue(':correo', "%$correo%", PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);

    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $pdo->prepare("
            SELECT COUNT(*) FROM Usuarios
            WHERE (Nombre LIKE :nombre OR Apellidos LIKE :nombre)
            AND Correo LIKE :correo
        ");
        $countStmt->bindValue(':nombre', "%$nombre%", PDO::PARAM_STR);
        $countStmt->bindValue(':correo', "%$correo%", PDO::PARAM_STR);
        $countStmt->execute();
        $total = $countStmt->fetchColumn();
        
    echo json_encode([
        "usuarios" => $usuarios,
        "total" => (int)$total
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "error" =>  $e->getMessage()
    ]);
}
