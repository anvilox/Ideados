<?php
session_start();
header("Content-Type: application/json");

$dsn = "mysql:dbname=ideados;host=127.0.0.1";
$usuario = "root";
$clave = "";

try {
    $pdo = new PDO($dsn, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM Usuarios WHERE Correo = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $usuario['Contraseña'] === $password) {
        $_SESSION['usuario'] = [
            'id' => $usuario['Id'],
            'nombre' => $usuario['Nombre'],
            'correo' => $usuario['Correo'],
            'admin' => $usuario['Admin']
        ];
        echo json_encode([
            "success" => true,
            "admin" => $usuario['Admin'] == 1
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
