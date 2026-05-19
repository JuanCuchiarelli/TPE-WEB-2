<?php
require_once __DIR__ . '/../models/ConcertModel.php';
require_once __DIR__ . '/../views/ConcertView.php';
require_once __DIR__ . '/../views/error.view.php';

class ConcertController {
    private $model;
    private $view;
    private $errorView;
    private $db;

    public function __construct() {
        $this->model = new ConcertModel();
        $this->view = new ConcertView();
        $this->errorView = new ErrorView();
        $this->db = getDBConnection();
    }

    public function showConcerts($req) {
        $concerts = $this->model->getAllConcerts();
        $this->view->showConcerts($concerts);
    }

    public function showConcert($req) {
        $id = $req->id;
        if (!$id) {
            return $this->errorView->renderError("ID de concierto no especificado.");
        }
        $concert = $this->model->getConcertById($id);
        $this->view->showConcertDetail($concert);
    }

    public function showAdminPanel($req) {
        $concerts = $this->model->getAllConcerts();
        
        $query = $this->db->query("SELECT id_banda, nombre FROM bandas");
        $bandas = $query->fetchAll(PDO::FETCH_OBJ);
        
        $this->view->showAdminPanel($concerts, $bandas);
    }

    public function addConcert($req) {
        if (
            !isset($_POST['fecha']) || empty($_POST['fecha']) ||
            !isset($_POST['lugar']) || empty($_POST['lugar']) ||
            !isset($_POST['id_banda']) || empty($_POST['id_banda'])
        ) {
            return $this->errorView->renderError("Por favor, complete todos los campos obligatorios.");
        }

        $this->model->insertConcert(
            $_POST['fecha'], $_POST['lugar'], $_POST['ciudad'], $_POST['id_banda'],
            $_POST['precio_platea'], $_POST['precio_campo'], $_POST['precio_popular']
        );

        header("Location: " . BASE_URL . "admin-conciertos");        
    }

    public function deleteConcert($req) {
        $id = $req->id;
        $concert = $this->model->getConcertById($id);

        if (!$concert) {
            return $this->errorView->renderError("No existe el concierto con el id=$id");
        }

        $this->model->deleteConcert($id);
        header("Location: " . BASE_URL . "admin-conciertos");
    }

    public function editConcert($req) {
        $id = $req->id;
        if (!$id) {
            header("Location: " . BASE_URL . "admin-conciertos");
            die();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateConcert(
                $id, $_POST['fecha'], $_POST['lugar'], $_POST['ciudad'], $_POST['id_banda'],
                $_POST['precio_platea'], $_POST['precio_campo'], $_POST['precio_popular']
            );
            header("Location: " . BASE_URL . "admin-conciertos");
            die();
        }

        $concert = $this->model->getConcertById($id);
        $query = $this->db->query("SELECT id_banda, nombre FROM bandas");
        $bandas = $query->fetchAll(PDO::FETCH_OBJ);

        $this->view->showEditForm($concert, $bandas);
    }

    public function showByBanda($req) {
        $id_banda = $req->id;
        if (!$id_banda) {
            return $this->errorView->renderError(
                "Banda no especificada."
            );
        }
        $concerts = $this->model->getByBanda($id_banda);
        $this->view->showConcertsByBanda($concerts);
    }
}
