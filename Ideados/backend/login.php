<?php
session_start();
header("Content-Type: application/json");
require_once "../backend/database/conexion.php";


try {

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
            'rol' => $usuario['Rol']
        ];
        echo json_encode([
            "success" => true,
            "rol" => $usuario['Rol'] == 1
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
