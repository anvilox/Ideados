<?php
require_once "conexion.php"; 

try {
    // Leer el archivo SQL
    $sql = file_get_contents("ideados.sql"); 

    if ($sql === false) {
        throw new Exception("No se pudo leer el archivo SQL.");
    }

    // Ejecutar múltiples sentencias
    $pdo->exec($sql);

    echo "✅ Datos insertados correctamente en la base de datos.";
} catch (PDOException $e) {
    echo "❌ Error al insertar los datos: " . $e->getMessage();
} catch (Exception $e) {
    echo "❌ Error general: " . $e->getMessage();
}
?>