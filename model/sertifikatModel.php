<?php
class sertifikatModel {
    private $conn;

    public function __construct() {
        global $conn; 
        $this->conn = $conn;
    }

    public function tambahSertifikat($id_siswa, $id_tugas, $no_sertifikat) {
        $id_siswa = intval($id_siswa);
        $id_tugas = intval($id_tugas);
        $no_sertifikat = mysqli_real_escape_string($this->conn, $no_sertifikat);

        $res_tugas = mysqli_query($this->conn, "SELECT id_mentor FROM tugas WHERE id_tugas = '$id_tugas' LIMIT 1");
        $row_tugas = $res_tugas ? mysqli_fetch_assoc($res_tugas) : null;
        $id_mentor = $row_tugas ? intval($row_tugas['id_mentor']) : 0;

        if (!$id_mentor) {
            $res_mentor = mysqli_query($this->conn, "SELECT id FROM users WHERE role = 'mentor' LIMIT 1");
            $row_mentor = $res_mentor ? mysqli_fetch_assoc($res_mentor) : null;
            $id_mentor  = $row_mentor ? intval($row_mentor['id']) : 1;
        }

        $query = "INSERT INTO sertifikat (id_siswa, id_tugas, id_mentor, nomor_sertifikat, tgl_terbit) 
                  VALUES ('$id_siswa', '$id_tugas', '$id_mentor', '$no_sertifikat', NOW())";
        
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            error_log("Error Query Sertifikat: " . mysqli_error($this->conn));
            return false;
        }
        return $result;
    }

    public function getSertifikatBySiswaId($id_siswa) {
        $id_siswa = intval($id_siswa);
        $query = "SELECT s.*, u.nama AS nama_siswa 
                  FROM sertifikat s 
                  LEFT JOIN users u ON s.id_siswa = u.id
                  WHERE s.id_siswa = '$id_siswa' 
                  ORDER BY s.id_sertifikat DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }
}
?>