<?php
header("Content-Type: application/json");
$dsn = "mysql:dbname=ideados;host=127.0.0.1";
$usuario = "root";
$clave = "";

try {
    $pdo = new PDO($dsn, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT Id, Nombre, Descripcion, Precio, Imagen FROM Productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($productos);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
