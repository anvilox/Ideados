<?php
session_start();
header("Content-Type: application/json");

// Crear una sesión con nombre "Invitado"
$_SESSION['usuario'] = [
    'id' => null,
    'nombre' => 'Invitado',
    'correo' => null,
    'rol' => false
];

echo json_encode(["success" => true]);
?>
