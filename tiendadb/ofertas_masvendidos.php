<?php

// Incluir la configuración de la base de datos
require 'Configuracion.php';

try {
    // Consulta para obtener las ofertas
    $queryOfertas = 'SELECT NProducto AS titulo, Precio AS precio, enlace AS enlace FROM ofertas';
    $resultOfertas = $db->query($queryOfertas);

    if (!$resultOfertas) {
        throw new Exception("Error al obtener las ofertas: " . $db->error);
    }

    $ofertas = [];
    while ($row = $resultOfertas->fetch_assoc()) {
        $ofertas[] = $row;
    }

    // Consulta para obtener los productos más vendidos
    $queryMasVendidos = 'SELECT NProducto AS titulo, Precio AS precio, enlace AS enlace FROM productos_mas_vendidos';
    $resultMasVendidos = $db->query($queryMasVendidos);

    if (!$resultMasVendidos) {
        throw new Exception("Error al obtener los productos más vendidos: " . $db->error);
    }

    $masVendidos = [];
    while ($row = $resultMasVendidos->fetch_assoc()) {
        $masVendidos[] = $row;
    }

    // Combinar los resultados en un solo array
    $result = [
        'ofertas' => $ofertas,
        'masVendidos' => $masVendidos
    ];

    // Devolver los datos en formato JSON
    echo json_encode($result);

} catch (Exception $e) {
    // En caso de error, devolver un mensaje de error en formato JSON
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $db->close();
}
?>
