<?php
require_once __DIR__ . '/../../config.php';

class ConcertModel {
    private $db;

    public function __construct() {
        $this->db = getDBConnection(); // Llama a la función de auto-deploy automático
    }

    public function getAllConcerts() {
        $query = $this->db->prepare("SELECT conciertos.*, bandas.nombre AS banda_nombre FROM conciertos INNER JOIN bandas ON conciertos.id_banda = bandas.id_banda");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getConcertById($id) {
        $query = $this->db->prepare("SELECT conciertos.*, bandas.nombre AS banda_nombre FROM conciertos INNER JOIN bandas ON conciertos.id_banda = bandas.id_banda WHERE conciertos.id_concierto = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insertConcert($fecha, $lugar, $ciudad, $id_banda, $p_platea, $p_campo, $p_popular) {
        $query = $this->db->prepare("INSERT INTO conciertos (fecha, lugar, ciudad, id_banda, precio_platea, precio_campo, precio_popular) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$fecha, $lugar, $ciudad, $id_banda, $p_platea, $p_campo, $p_popular]);
    }

    public function deleteConcert($id) {
        $query = $this->db->prepare("DELETE FROM conciertos WHERE id_concierto = ?");
        $query->execute([$id]);
    }

    public function updateConcert($id, $fecha, $lugar, $ciudad, $id_banda, $p_platea, $p_campo, $p_popular) {
        $query = $this->db->prepare("UPDATE conciertos SET fecha = ?, lugar = ?, ciudad = ?, id_banda = ?, precio_platea = ?, precio_campo = ?, precio_popular = ? WHERE id_concierto = ?");
        $query->execute([$fecha, $lugar, $ciudad, $id_banda, $p_platea, $p_campo, $p_popular, $id]);
    }

    //listado de items por categoria
    public function getByBanda($id_banda){
        $query = $this->db->prepare('SELECT * FROM conciertos WHERE id_banda = ?');
        $query->execute([$id_banda]);

        $conciertos = $query->fetchAll(PDO::FETCH_OBJ);
        return $conciertos;
    }
}
