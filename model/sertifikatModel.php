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

    public function getSertifikatBySiswaId($id_siswa) {
        $id = intval($id_siswa);
        $query = "SELECT s.*, t.judul_tugas FROM sertifikat s 
                  JOIN tugas t ON s.id_tugas = t.id_tugas 
                  WHERE s.id_siswa = '$id' ORDER BY s.id_sertifikat DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }
}
?>