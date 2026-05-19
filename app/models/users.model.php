<?php
require_once __DIR__ . '/../../config.php';

class UsersModel {
   private $db;

   public function __construct() {
      $this->db = getDBConnection();
   }

   public function getByEmail($email) {
      $query = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
      $query->execute([$email]);
      return $query->fetch(PDO::FETCH_OBJ);
   }
}
