<?php
require_once __DIR__ . '/../models/bandas.model.php';
require_once __DIR__ . '/../views/bandas.view.php';
require_once __DIR__ . '/../views/error.view.php'; 

class BandasController{
    private $model;
    private $view;
    private $errorView; 

    public function __construct(){
        $this->model = new BandasModel();
        $this->view = new BandasView();
        $this->errorView = new ErrorView();
    }

    public function showAll($req){
        $bandas = $this->model->getAll();
        $this->view->renderBandas($bandas);
    }

    public function add($req){
        if(
            !isset($_POST['nombre']) || empty($_POST['nombre']) || 
            !isset($_POST['genero']) || empty($_POST['genero']) ||
            !isset($_POST['pais_de_origen']) || empty($_POST['pais_de_origen']) 
        ) {
            return $this->errorView->renderError("Por favor, complete todos los campos obligatorios.");
        }

        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $pais_de_origen = $_POST['pais_de_origen'];
        $img = $_POST['img'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;

        $id_banda = $this->model->insert($nombre, $genero, $pais_de_origen, $img, $descripcion);

        if(empty($id_banda)){
            return $this->errorView->renderError("Error al ingresar banda. Intente nuevamente.");
        }

        // redirige a la lista de bandas ---> REVISAR
        header("Location: " . BASE_URL );   
    }

    public function update($req){
        $id = $req->id;

        $banda = $this->model->get($id);

        if(!$banda){
            return $this->errorView->renderError("No existe la banda con el id=$id");
        }

        if (
            !isset($_POST['nombre']) || empty($_POST['nombre']) ||
            !isset($_POST['genero']) || empty($_POST['genero']) ||
            !isset($_POST['pais_de_origen']) || empty($_POST['pais_de_origen'])
        ) {

            return $this->errorView->renderError("Por favor complete los campos obligatorios.");
        }

        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $pais = $_POST['pais_de_origen'];
        $img = $_POST['img'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;

        $this->model->update(
            $id,
            $nombre,
            $genero,
            $pais_de_origen,
            $img,
            $descripcion
        );

        header("Location: " . BASE_URL ); //REVISAR CON RUTEO
    }

    public function delete($req){
        $id = $req->id;
        $banda = $this->model->get($id);

        if(!$banda){
            return $this->errorView->renderError("No existe la banda con el id=$id");
        }

        $this->model->delete($id);

        header("Location: " . BASE_URL );
    }
}   