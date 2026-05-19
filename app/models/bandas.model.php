<?php
require_once __DIR__ . '/../config.php';

class BandasModel {
    private $db;

    public function __construct(){
         $this->db = getDBConnection();
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
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

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