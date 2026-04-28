<?php
//agregar archivos requeridos

// define la base URL del sitio
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


// accion por default
$action = 'issues';

// leo la accion que viene por parámetro
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: staff/juan --> ['staff', juan]
$params = explode('/', $action);

// rutea según la acción
switch ($params[0]) {
    case 'issues':
        $controller = new IssuesController();
        $controller->showAll();
        break;

    case 'add':
        $controller = new IssuesController();
        $controller->add();
        break;
    
    case 'delete':
        $controller = new IssuesController();
        $controller->delete($params[1]);
        break;

    default:
        echo '404 error';
        break;
}
