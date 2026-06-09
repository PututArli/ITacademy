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
        $query = "SELECT tugas.*, users.nama AS nama_siswa FROM tugas JOIN users ON tugas.id_siswa = users.id WHERE tugas.status = 'Menunggu' ORDER BY id_tugas DESC";
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

    // =====================
    // CRUD Pengguna & Mentor
    // =====================
    public function isEmailExists($email) {
        $email = mysqli_real_escape_string($this->db, $email);
        $result = mysqli_query($this->db, "SELECT id FROM users WHERE email = '$email' LIMIT 1");
        return mysqli_num_rows($result) > 0;
    }

    public function tambahPengguna($nama, $email, $password, $role) {
        $nama     = mysqli_real_escape_string($this->db, $nama);
        $email    = mysqli_real_escape_string($this->db, $email);
        $role     = mysqli_real_escape_string($this->db, $role);
        // Hash password sebelum disimpan
        $hashed   = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$hashed', '$role')";
        return mysqli_query($this->db, $query);
    }

    public function updatePengguna($id, $nama, $role) {
        $id   = intval($id);
        $nama = mysqli_real_escape_string($this->db, $nama);
        $role = mysqli_real_escape_string($this->db, $role);
        $query = "UPDATE users SET nama = '$nama', role = '$role' WHERE id = '$id'";
        return mysqli_query($this->db, $query);
    }

    public function updateNama($id, $nama) {
        $id   = intval($id);
        $nama = mysqli_real_escape_string($this->db, $nama);
        $query = "UPDATE users SET nama = '$nama' WHERE id = '$id'";
        return mysqli_query($this->db, $query);
    }

    public function hapusPengguna($id) {
        $id = intval($id);
        $query = "DELETE FROM users WHERE id = '$id'";
        return mysqli_query($this->db, $query);
    }

    public function getUserById($id) {
        $id = intval($id);
        $result = mysqli_query($this->db, "SELECT * FROM users WHERE id = '$id' LIMIT 1");
        return mysqli_fetch_assoc($result);
    }

    public function updateProfilUser($id, $nama, $password_baru = '') {
        $id   = intval($id);
        $nama = mysqli_real_escape_string($this->db, $nama);
        if ($password_baru) {
            // Hash password baru sebelum update
            $pw = password_hash($password_baru, PASSWORD_BCRYPT);
            $query = "UPDATE users SET nama = '$nama', password = '$pw' WHERE id = '$id'";
        } else {
            $query = "UPDATE users SET nama = '$nama' WHERE id = '$id'";
        }
        return mysqli_query($this->db, $query);
    }

    public function upgradeToPremium($id) {
        $id = intval($id);
        $query = "UPDATE users SET role = 'premium' WHERE id = '$id'";
        return mysqli_query($this->db, $query);
    }

    public function updateProfilAdmin($id, $nama, $password_baru = '') {
        return $this->updateProfilUser($id, $nama, $password_baru);
    }
}