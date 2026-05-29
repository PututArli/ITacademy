<?php
class sertifikatModel {
    private $conn;

    public function __construct() {
        global $conn; 
        $this->conn = $conn; 
    }

    public function tambahSertifikat($id_siswa, $id_tugas, $no_sertifikat) {
        $tanggal_terbit = date("Y-m-d");
        $query = "INSERT INTO sertifikat (id_siswa, id_tugas, no_sertifikat, tanggal_terbit) 
                  VALUES ('$id_siswa', '$id_tugas', '$no_sertifikat', '$tanggal_terbit')";
        return mysqli_query($this->conn, $query);
    }
}
?>