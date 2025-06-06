<?php
$dsn = "mysql:host=localhost";
$usuario = "root";
$clave = "";
$nombreBD = "prueba";

try {
    // Crear la conexión PDO
    $bd = new PDO($dsn, $usuario, $clave);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la base de datos si no existe
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $nombreBD CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $bd->exec($sql_create_db);
    $bd->exec("USE $nombreBD");

    echo "Base de datos creada correctamente.<br>";

    // Crear tabla de usuarios
    $sql_usuarios = "CREATE TABLE IF NOT EXISTS Usuarios (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Nombre VARCHAR(100),
        Apellidos VARCHAR(100),
        Correo VARCHAR(100) UNIQUE,
        Contraseña VARCHAR(255),
        Teléfono VARCHAR(15),
        Dirección VARCHAR(255),
        Código_Postal VARCHAR(10),
        Provincia VARCHAR(50),
        Rol BOOLEAN NOT NULL DEFAULT FALSE
    )";

    // Crear tabla de categorías
    $sql_categorias = "CREATE TABLE IF NOT EXISTS Categorias (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Nombre VARCHAR(100) UNIQUE
    )";

    // Crear tabla de productos
    $sql_productos = "CREATE TABLE IF NOT EXISTS Productos (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Nombre VARCHAR(255),
        Descripcion TEXT,
        Precio DECIMAL(10,2),
        Stock INT DEFAULT 0,
        Imagen VARCHAR(255),
        Categoria_Id INT,
        FOREIGN KEY (Categoria_Id) REFERENCES Categorias(Id)
    )";

    // Crear tabla de detalle del pedido
    $sql_detalle_pedido = "CREATE TABLE IF NOT EXISTS DetallePedido (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Pedido_Id INT,
        Producto_Id INT,
        Cantidad INT,
        Precio_Unitario DECIMAL(10,2),
        FOREIGN KEY (Pedido_Id) REFERENCES Pedidos(Id) ON DELETE CASCADE,
        FOREIGN KEY (Producto_Id) REFERENCES Productos(Id) ON DELETE CASCADE
    )";

    // Crear tabla de pedidos
    $sql_pedidos = "CREATE TABLE IF NOT EXISTS Pedidos (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Usuario_Id INT,
        Precio_Total DECIMAL(10,2),
        Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Estado ENUM('Pendiente', 'Pagado', 'Completado', 'Cancelado'),
        FOREIGN KEY (Usuario_Id) REFERENCES Usuarios(Id)
    )";

    // Ejecutar la creación de tablas
    $bd->exec($sql_usuarios);
    $bd->exec($sql_categorias);
    $bd->exec($sql_productos);
    $bd->exec($sql_pedidos);
    $bd->exec($sql_detalle_pedido);

    echo "Tablas creadas correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
