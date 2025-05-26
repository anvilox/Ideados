<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] !== null) {
    echo json_encode([
        "logueado" => true,
        "nombre" => $_SESSION['usuario']['nombre'],
        "esAdmin" => $_SESSION['usuario']['rol'] == 1
    ]);
} else {
    echo json_encode([
        "logueado" => false
    ]);
}