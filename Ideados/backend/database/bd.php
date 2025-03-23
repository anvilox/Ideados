<?php
$dsn = "mysql:host=localhost";
$usuario = "root";
$clave = "";
$nombreBD = "ideados";

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
        Metodo_Pago VARCHAR(100),
        Admin BOOLEAN NOT NULL DEFAULT FALSE
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

    // Crear tabla de carrito
    $sql_carrito = "CREATE TABLE IF NOT EXISTS Carrito (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Usuario_Id INT,
        Estado ENUM('Pendiente', 'Pagado', 'Completado') DEFAULT 'Pendiente',
        FOREIGN KEY (Usuario_Id) REFERENCES Usuarios(Id)
    )";

    // Crear tabla de detalle del carrito
    $sql_detalle_carrito = "CREATE TABLE IF NOT EXISTS DetalleCarrito (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Carrito_Id INT,
        Producto_Id INT,
        Cantidad INT,
        Precio_Unitario DECIMAL(10,2),
        FOREIGN KEY (Carrito_Id) REFERENCES Carrito(Id) ON DELETE CASCADE,
        FOREIGN KEY (Producto_Id) REFERENCES Productos(Id) ON DELETE CASCADE
    )";

    // Crear tabla de pedidos
    $sql_pedidos = "CREATE TABLE IF NOT EXISTS Pedidos (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Carrito_Id INT,
        Usuario_Id INT,
        Precio_Total DECIMAL(10,2),
        Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Estado ENUM('Pendiente', 'Pagado', 'Completado', 'Cancelado'),
        FOREIGN KEY (Carrito_Id) REFERENCES Carrito(Id),
        FOREIGN KEY (Usuario_Id) REFERENCES Usuarios(Id)
    )";

    // Ejecutar la creación de tablas
    $bd->exec($sql_usuarios);
    $bd->exec($sql_categorias);
    $bd->exec($sql_productos);
    $bd->exec($sql_carrito);
    $bd->exec($sql_detalle_carrito);
    $bd->exec($sql_pedidos);

    echo "Tablas creadas correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
