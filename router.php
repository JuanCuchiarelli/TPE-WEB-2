<?php
require_once __DIR__ . '/app/controllers/ConcertController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

require_once __DIR__ . '/app/middlewares/session.middleware.php';
require_once __DIR__ . '/app/middlewares/guard.middleware.php';

session_start();

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'conciertos';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$req = new StdClass();
$req = (new SessionMiddleware())->run($req);

switch ($params[0]) {
    // ---- Vistas Públicas ----
    case 'conciertos':
        $controller = new ConcertController();
        $controller->showConcerts($req);
        break;

    case 'concierto':
        $controller = new ConcertController();
        $req->id = isset($params[1]) ? $params[1] : null;
        $controller->showConcert($req);
        break;

    // ---- Autenticación ----
    case 'login_form':
        $controller = new AuthController();
        $controller->showForm($req);
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login($req);
        break;

    // ---- Panel Admin y CRUD (Protegido por GuardMiddleware) ----
    case 'admin-conciertos':
        $req = (new GuardMiddleware())->run($req);
        $controller = new ConcertController();
        $controller->showAdminPanel($req);
        break;

    case 'agregar-concierto':
        $req = (new GuardMiddleware())->run($req);
        $controller = new ConcertController();
        $controller->addConcert($req);
        break;

    case 'eliminar-concierto':
        $req = (new GuardMiddleware())->run($req);
        $controller = new ConcertController();
        $req->id = isset($params[1]) ? $params[1] : null;
        $controller->deleteConcert($req);
        break;

    case 'editar-concierto':
        $req = (new GuardMiddleware())->run($req);
        $controller = new ConcertController();
        $req->id = isset($params[1]) ? $params[1] : null;
        $controller->editConcert($req);
        break;

    default:
        echo '404 error';
        break;
}
