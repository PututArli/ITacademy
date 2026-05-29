<?php
class materiModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllMateri() {
        $query = "SELECT * FROM materi ORDER BY urutan ASC";
        return mysqli_query($this->conn, $query);
    }

    public function getMateriById($id) {
    $query = "SELECT * FROM materi WHERE id = " . intval($id);
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_assoc($result);
}
}
?>