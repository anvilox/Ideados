<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION['usuario'])) {
    echo json_encode([
        "logged" => true,
        "usuario" => $_SESSION['usuario']
    ]);
} else {
    echo json_encode([
        "logged" => false
    ]);
}
?>
