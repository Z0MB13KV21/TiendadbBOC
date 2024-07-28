<?php
require_once __DIR__ . '/controllers/UsuarioController.php';
require_once __DIR__ . '/controllers/CategoriaController.php';
require_once __DIR__ . '/controllers/ProductoController.php';
require_once __DIR__ . '/controllers/FacturaController.php';
require_once __DIR__ . '/controllers/PedidoController.php';
require_once __DIR__ . '/controllers/HistoricoUsuarioController.php';

$usuarioController = new UsuarioController();
$categoriaController = new CategoriaController();
$productoController = new ProductoController();
$facturaController = new FacturaController();
$pedidoController = new PedidoController();
$historicoUsuarioController = new HistoricoUsuarioController();

$request_method = $_SERVER['REQUEST_METHOD'];
$path = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
$segmentosDeUrl = explode('/', $path);

$rutaControlador = array_shift($segmentosDeUrl);
$id = !empty($segmentosDeUrl) ? end($segmentosDeUrl) : null;

switch ($rutaControlador) {
    case 'usuarios':
        switch ($request_method) {
            case 'GET':
                $usuarioController->get($id);
                break;
            case 'POST':
                $usuarioController->post();
                break;
            case 'PUT':
                $usuarioController->put($id);
                break;
            case 'DELETE':
                $usuarioController->delete($id);
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case 'categorias':
        switch ($request_method) {
            case 'GET':
                $categoriaController->get($id);
                break;
            case 'POST':
                $categoriaController->post();
                break;
            case 'PUT':
                $categoriaController->put($id);
                break;
            case 'DELETE':
                $categoriaController->delete($id);
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case 'productos':
        switch ($request_method) {
            case 'GET':
                $productoController->get($id);
                break;
            case 'POST':
                $productoController->post();
                break;
            case 'PUT':
                $productoController->put($id);
                break;
            case 'DELETE':
                $productoController->delete($id);
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case 'facturas':
        switch ($request_method) {
            case 'GET':
                $facturaController->get($id);
                break;
            case 'POST':
                $facturaController->post();
                break;
            case 'PUT':
                $facturaController->put($id);
                break;
            case 'DELETE':
                $facturaController->delete($id);
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case 'pedidos':
        switch ($request_method) {
            case 'GET':
                $pedidoController->get($id);
                break;
            case 'POST':
                $pedidoController->post();
                break;
            case 'PUT':
                $pedidoController->put($id);
                break;
            case 'DELETE':
                $pedidoController->delete($id);
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case 'historicousuario':
        switch ($request_method) {
            case 'GET':
                $historicoUsuarioController->get($id);
                break;
            case 'POST':
                $historicoUsuarioController->post();
                break;
            case 'PUT':
                $historicoUsuarioController->put($id);
                break;
            case 'DELETE':
                $historicoUsuarioController->delete($id);
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Ruta no encontrada']);
        break;
}
?>
