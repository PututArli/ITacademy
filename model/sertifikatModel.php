<?php
class sertifikatModel {
    private $conn;

    public function __construct() {
        global $conn; 
        $this->conn = $conn;
    }

    public function tambahSertifikat($id_siswa, $id_tugas, $no_sertifikat) {
        $id_mentor = 2; 
        $query = "INSERT INTO sertifikat (id_siswa, id_tugas, id_mentor, nomor_sertifikat, tgl_terbit) 
                  VALUES ('$id_siswa', '$id_tugas', '$id_mentor', '$no_sertifikat', NOW())";
        
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            die("Error Query Sertifikat: " . mysqli_error($this->conn));
        }
        return $result;
    }

    public function getSertifikatBySiswaId($id_siswa) {
        global $conn;
        $query = "SELECT * FROM sertifikat WHERE id_siswa = '$id_siswa' LIMIT 1";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }
}
?>