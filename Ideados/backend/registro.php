<?php
header("Content-Type: application/json");

$dsn = "mysql:dbname=ideados;host=127.0.0.1";
$usuario = "root";
$clave = "";

try {
    $pdo = new PDO($dsn, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $cp = $_POST['cp'] ?? '';
    $provincia = $_POST['provincia'] ?? '';

    $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Correo, Contraseña, Dirección, Teléfono, Código_Postal, Provincia, Admin)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $email, $password, $direccion, $telefono, $cp, $provincia]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
