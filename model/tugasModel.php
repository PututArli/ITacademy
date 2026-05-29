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
          JOIN users ON tugas.id_siswa = users.id
          ORDER BY tugas.id_tugas ASC";
        return mysqli_query($this->conn, $query);
    }

    public function updateStatusTugas($id_tugas, $status) {
        $id = intval($id_tugas);
        $status_bersih = mysqli_real_escape_string($this->conn, $status);
        $query = "UPDATE tugas SET status = '$status_bersih' WHERE id_tugas = '$id'";
        return mysqli_query($this->conn, $query);
    }

    public function getTotalTugasMenunggu() {
    $query = "SELECT COUNT(*) as total FROM tugas WHERE status = 'Menunggu'";
    $result = mysqli_query($this->conn, $query);
    $data = mysqli_query($this->conn, $query); 
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

public function getTugasById($id_tugas) {
    $query = "SELECT * FROM tugas WHERE id_tugas = '$id_tugas'";
    $result = mysqli_query($this->conn, $query); 
    return mysqli_fetch_assoc($result);
}

public function getTugasBySiswaId($id_siswa) {
    if (empty($id_siswa)) {
        return false;
    }
    $query = "SELECT * FROM tugas WHERE id_siswa = '$id_siswa' LIMIT 1";
    $result = mysqli_query($this->conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

public function tambahTugas($id_siswa, $judul_tugas, $nama_file) {
    $koneksi_lokal = mysqli_connect("localhost", "root", "", "it_academy"); 
    $id_siswa_paksa = 3; 
    $id_mentor_paksa = 2; 

    $query = "INSERT INTO tugas (id_siswa, id_mentor, judul_tugas, nama_file, status) 
              VALUES ('$id_siswa_paksa', '$id_mentor_paksa', '$judul_tugas', '$nama_file', 'Menunggu')";
              
    return mysqli_query($koneksi_lokal, $query);
}
public function getTugasMenungguDashboard() {
    $query = "SELECT tugas.*, users.nama FROM tugas 
              JOIN users ON tugas.id_siswa = users.id 
              WHERE tugas.status = 'Menunggu' ORDER BY tugas.id_tugas DESC LIMIT 3";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

public function hitungTugasByStatus($status) {
    $query = "SELECT COUNT(*) as total FROM tugas WHERE status = '$status'";
    $result = mysqli_query($this->conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

public function hitungTotalSiswa() {
    $query = "SELECT COUNT(*) as total FROM users WHERE role != 'mentor' AND role != 'admin'";
    $result = mysqli_query($this->conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

}
?>