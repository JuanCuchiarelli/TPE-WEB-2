<?php
<<<<<<< HEAD
require_once __DIR__ . '/../config.php';
=======
>>>>>>> 4e7772db04f094b9a25864ce9fc0483579a7664e

class BandasModel {
    private $db;

    public function __construct(){
<<<<<<< HEAD
         $this->db = getDBConnection();
=======
        $this->db = new PDO('mysql:host=localhost;dbname=db_buscador_conciertos;charset=utf8', 'root', '');
>>>>>>> 4e7772db04f094b9a25864ce9fc0483579a7664e
    }

    //listado de categorias(bandas)
    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM bandas');
        $query->execute();

        $bandas = $query->fetchAll(PDO::FETCH_OBJ);

        return $bandas;
    }

    public function get($id){
        $query = $this->db->prepare('SELECT * FROM bandas WHERE id_banda = ?');
<<<<<<< HEAD
        $query->execute([$id]);
=======
        $query->execute($id);
>>>>>>> 4e7772db04f094b9a25864ce9fc0483579a7664e

        return $query->fetch(PDO::FETCH_OBJ);
    }

<<<<<<< HEAD
=======
    //listado de items por categoria -> deberia estar en ConciertosModel?
    public function getByBanda($banda){
        $query = $this->db->prepare('SELECT * FROM conciertos WHERE id_banda = ?');
        $query->execute([$id_banda]);

        $conciertos = $query->fetchAll(PDO::FETCH_OBJ);
        return $conciertos;
    }

>>>>>>> 4e7772db04f094b9a25864ce9fc0483579a7664e
    public function insert($nombre, $genero, $pais_de_origen, $img, $descripcion){
        $query = $this->db->prepare(
            'INSERT INTO bandas (`nombre`, `genero`, `pais_de_origen`, `img`, `descripcion`) 
             VALUES (?,?,?,?,?)'
        );
        $query->execute([$nombre, $genero, $pais_de_origen, $img, $descripcion]);
        return $this->db->lastInsertId();
    }

    public function delete($id){
        $query = $this->db->prepare('DELETE FROM bandas WHERE id_banda = ?');
        $query->execute([$id]);
        return $query->rowCount(); //$this->db->rowCount();
    }

    public function update($id_banda, $nombre, $genero, $pais_de_origen, $img, $descripcion){
        $query = $this->db->prepare(
            'UPDATE bandas SET `nombre`=?, `genero`=?, `pais_de_origen`=?, `img`=?, `descripcion`=?
            WHERE id_banda = ?'
        );
        $query->execute([$nombre, $genero, $pais_de_origen, $img, $descripcion, $id_banda]);
        return $query->rowCount(); //$this->db->rowCount();       
    }
}