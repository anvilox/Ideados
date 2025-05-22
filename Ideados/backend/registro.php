<?php
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";


try {

    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $cp = $_POST['cp'] ?? '';
    $provincia = $_POST['provincia'] ?? '';

    $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Correo, Contraseña, Dirección, Teléfono, Código_Postal, Provincia, Rol)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $email, $password, $direccion, $telefono, $cp, $provincia]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
