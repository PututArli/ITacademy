<?php
class userModel {
    private $db;
    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function getTotalPengguna() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role IN ('free', 'premium')";
        $result = mysqli_query($this->db, $query);
        return mysqli_fetch_assoc($result)['total'];
    }
    public function getTotalPremium() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'premium'";
        $result = mysqli_query($this->db, $query);
        return mysqli_fetch_assoc($result)['total'];
    }
    public function getAllPengguna() {
        $query = "SELECT * FROM users WHERE role IN ('free', 'premium') ORDER BY id DESC";
        $result = mysqli_query($this->db, $query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotalMentor() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'mentor'";
        $result = mysqli_query($this->db, $query);
        return mysqli_fetch_assoc($result)['total'];
    }
    public function getAllMentor() {
        $query = "SELECT * FROM users WHERE role = 'mentor' ORDER BY id DESC";
        $result = mysqli_query($this->db, $query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotalTugasMenunggu() {
        $query = "SELECT COUNT(*) as total FROM tugas WHERE status = 'Menunggu'";
        $result = mysqli_query($this->db, $query);
        if($result) return mysqli_fetch_assoc($result)['total'];
        return 0;
    }
    public function getAllTugasMenunggu() {
        $query = "SELECT tugas.*, users.nama AS nama_siswa FROM tugas JOIN users ON tugas.user_id = users.id WHERE tugas.status = 'Menunggu' ORDER BY tugas.id DESC";
        $result = mysqli_query($this->db, $query);
        $data = [];
        if($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }
    public function getTotalSertifikat() {
        $query = "SELECT COUNT(*) as total FROM tugas WHERE status IN ('Selesai', 'Disetujui')";
        $result = mysqli_query($this->db, $query);
        if($result) return mysqli_fetch_assoc($result)['total'];
        return 0;
    }
}