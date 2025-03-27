<?php
$dsn = "mysql:dbname=ideados;host=127.0.0.1";
$usuario = "root";
$clave = "";

try {
    // Crear conexión con la base de datos
    $pdo = new PDO($dsn, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado a la base de datos 'ideados' correctamente.<br>";

    // Categorías de muebles
    $categorias = [
        "Sillas", "Mesas", "Armarios", "Sofás"
    ];

    foreach ($categorias as $categoria) {
        $sql = "INSERT INTO Categorias (Nombre) VALUES (?) ON DUPLICATE KEY UPDATE Nombre = VALUES(Nombre)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categoria]);
        echo "Categoría $categoria insertada con éxito.<br>";
    }

    // Obtener IDs de categorías
    $categorias_ids = [];
    foreach ($categorias as $categoria) {
        $categorias_ids[$categoria] = $pdo->query("SELECT Id FROM Categorias WHERE Nombre = '$categoria'")->fetchColumn();
    }

    // Productos de ejemplo
    $productos = [
        ["Silla de Madera", "Silla cómoda de madera con respaldo alto.", 49.99, 10, "silla_madera.jpg", "Sillas"],
        ["Mesa de Centro", "Mesa de centro moderna con acabado en roble.", 119.99, 5, "mesa_centro.jpg", "Mesas"],
        ["Armario de 3 Puertas", "Armario espacioso con 3 puertas y estantes internos.", 299.99, 3, "armario_3_puertas.jpg", "Armarios"],
        ["Sofá de 3 Plazas", "Sofá amplio y cómodo con tapizado en terciopelo.", 399.99, 4, "sofa_3_plazas.jpg", "Sofás"]
    ];

    foreach ($productos as $producto) {
        [$nombre, $descripcion, $precio, $stock, $imagen, $categoria] = $producto;
        $categoria_id = $categorias_ids[$categoria];

        $sql = "INSERT INTO Productos (Categoria_Id, Nombre, Descripcion, Precio, Stock, Imagen)
                VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE 
                Descripcion = VALUES(Descripcion), Precio = VALUES(Precio), Stock = VALUES(Stock), Imagen = VALUES(Imagen)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categoria_id, $nombre, $descripcion, $precio, $stock, $imagen]);

        echo "Producto $nombre insertado con éxito.<br>";
    }

    // Insertar usuarios de ejemplo
    $usuarios = [
        [
            "nombre" => "Ángel",
            "apellidos" => "Admin",
            "correo" => "admin@gmail.com",
            "password" => "admin",
            "direccion" => "Calle Central 1",
            "telefono" => "600000001",
            "cp" => "28001",
            "provincia" => "Madrid",
            "admin" => 1
        ],
        [
            "nombre" => "Angel",
            "apellidos" => "Cliente",
            "correo" => "test@gmail.com",
            "password" => "test",
            "direccion" => "Avenida Norte 5",
            "telefono" => "600000002",
            "cp" => "08001",
            "provincia" => "Barcelona",
            "admin" => 0
        ]
    ];

    foreach ($usuarios as $u) {
        $stmt = $pdo->prepare("INSERT INTO Usuarios (Nombre, Apellidos, Correo, Contraseña, Dirección, Teléfono, Código_Postal, Provincia, Admin)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE Nombre = VALUES(Nombre)");

        $stmt->execute([
            $u['nombre'], $u['apellidos'], $u['correo'], $u['password'],
            $u['direccion'], $u['telefono'], $u['cp'], $u['provincia'], $u['admin']
        ]);

        echo "Usuario {$u['correo']} insertado correctamente.<br>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
