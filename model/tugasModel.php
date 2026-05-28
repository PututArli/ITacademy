<?php
class tugasModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllTugas() {
        $query = "SELECT tugas.*, users.nama AS nama_siswa 
                  FROM tugas 
                  JOIN users ON tugas.user_id = users.id 
                  ORDER BY tugas.id ASC";
        return mysqli_query($this->conn, $query);
    }

    public function updateStatusTugas($id_tugas, $status) {
        $id = intval($id_tugas);
        $status_bersih = mysqli_real_escape_string($this->conn, $status);
        $query = "UPDATE tugas SET status = '$status_bersih' WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function getTotalTugasMenunggu() {
        $query = "SELECT COUNT(*) as total FROM tugas WHERE status = 'Menunggu'";
        $result = mysqli_query($this->conn, $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }
}
?>