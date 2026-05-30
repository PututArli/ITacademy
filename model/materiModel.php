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

    public function tambahMateri($judul, $link, $deskripsi) {
        // Ambil urutan terbaru
        $query_cek = "SELECT MAX(urutan) as max_urutan FROM materi";
        $result    = mysqli_query($this->conn, $query_cek);
        $data      = mysqli_fetch_assoc($result);
        $urutan_baru = ($data['max_urutan'] ?? 0) + 1;

        $judul    = mysqli_real_escape_string($this->conn, $judul);
        $link     = mysqli_real_escape_string($this->conn, $link);
        $deskripsi = mysqli_real_escape_string($this->conn, $deskripsi);

        $query = "INSERT INTO materi (judul_materi, link_embed_yt, deskripsi, urutan) 
                  VALUES ('$judul', '$link', '$deskripsi', '$urutan_baru')";
        return mysqli_query($this->conn, $query);
    }
}