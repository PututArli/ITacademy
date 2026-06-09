<?php
class adminController { 
    private $userModel; 

    public function __construct() {
        if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/index.php?page=login");
            exit();
        }
        require_once 'model/userModel.php';
        $this->userModel = new userModel(); 
    }

    public function dashboardAdmin() {
        $nama_user = $_SESSION['nama'];
        
        $total_pengguna       = $this->userModel->getTotalPengguna();
        $total_premium        = $this->userModel->getTotalPremium();
        $total_mentor         = $this->userModel->getTotalMentor();
        $total_sertifikat     = $this->userModel->getTotalSertifikat();
        $total_tugas_menunggu = $this->userModel->getTotalTugasMenunggu();
        
        $daftar_pengguna = $this->userModel->getAllPengguna();
        $daftar_mentor   = $this->userModel->getAllMentor();
        $daftar_tugas    = $this->userModel->getAllTugasMenunggu();
        
        require_once 'view/admin/dashboardAdmin.php';
    }

    public function penggunaAdmin() {
        $nama_user = $_SESSION['nama'];
        $pesan_sukses = '';
        $pesan_error  = '';

        // Tambah User
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'tambah_user') {
            $nama     = trim($_POST['nama'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $role     = trim($_POST['role'] ?? 'free');

            if (!$nama || !$email || !$password) {
                $pesan_error = "Semua field wajib diisi.";
            } elseif (strlen($password) < 8) {
                $pesan_error = "Password minimal harus 8 karakter.";
            } elseif ($this->userModel->isEmailExists($email)) {
                $pesan_error = "Email sudah terdaftar.";
            } else {
                if ($this->userModel->tambahPengguna($nama, $email, $password, $role)) {
                    $pesan_sukses = "Pengguna berhasil ditambahkan.";
                } else {
                    $pesan_error = "Gagal menambahkan pengguna.";
                }
            }
        }

        // Edit User
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'edit_user') {
            $id   = intval($_POST['id'] ?? 0);
            $nama = trim($_POST['nama'] ?? '');
            $role = trim($_POST['role'] ?? 'free');
            if (!$id || !$nama) {
                $pesan_error = "Data tidak lengkap.";
            } else {
                if ($this->userModel->updatePengguna($id, $nama, $role)) {
                    $pesan_sukses = "Data pengguna berhasil diperbarui.";
                } else {
                    $pesan_error = "Gagal memperbarui data pengguna.";
                }
            }
        }

        // Hapus User
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'hapus_user') {
            $id = intval($_POST['id'] ?? 0);
            if ($id && $this->userModel->hapusPengguna($id)) {
                $pesan_sukses = "Pengguna berhasil dihapus.";
            } else {
                $pesan_error = "Gagal menghapus pengguna.";
            }
        }

        $total_pengguna = $this->userModel->getTotalPengguna();
        $total_premium  = $this->userModel->getTotalPremium();
        $semua_pengguna = $this->userModel->getAllPengguna();
        require_once 'view/admin/penggunaAdmin.php';
    }

    public function mentorAdmin() {
        $nama_user = $_SESSION['nama'];
        $pesan_sukses = '';
        $pesan_error  = '';

        // Tambah Mentor
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'tambah_mentor') {
            $nama     = trim($_POST['nama'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!$nama || !$email || !$password) {
                $pesan_error = "Semua field wajib diisi.";
            } elseif (strlen($password) < 8) {
                $pesan_error = "Password minimal harus 8 karakter.";
            } elseif ($this->userModel->isEmailExists($email)) {
                $pesan_error = "Email sudah terdaftar.";
            } else {
                if ($this->userModel->tambahPengguna($nama, $email, $password, 'mentor')) {
                    $pesan_sukses = "Mentor berhasil ditambahkan.";
                } else {
                    $pesan_error = "Gagal menambahkan mentor.";
                }
            }
        }

        // Edit Mentor
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'edit_mentor') {
            $id   = intval($_POST['id'] ?? 0);
            $nama = trim($_POST['nama'] ?? '');
            if (!$id || !$nama) {
                $pesan_error = "Data tidak lengkap.";
            } else {
                if ($this->userModel->updateNama($id, $nama)) {
                    $pesan_sukses = "Data mentor berhasil diperbarui.";
                } else {
                    $pesan_error = "Gagal memperbarui data mentor.";
                }
            }
        }

        // Hapus Mentor
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'hapus_mentor') {
            $id = intval($_POST['id'] ?? 0);
            if ($id && $this->userModel->hapusPengguna($id)) {
                $pesan_sukses = "Mentor berhasil dihapus.";
            } else {
                $pesan_error = "Gagal menghapus mentor.";
            }
        }

        $total_mentor = $this->userModel->getTotalMentor();
        $semua_mentor = $this->userModel->getAllMentor();
        require_once 'view/admin/mentorAdmin.php';
    }

    public function kursusAdmin() {
        $nama_user = $_SESSION['nama'];        
        require_once 'view/admin/kursusAdmin.php';
    }

    public function profilAdmin() {
        $nama_user = $_SESSION['nama'];
        $pesan_sukses = '';
        $pesan_error  = '';

        // Ambil data admin dari DB
        global $conn;
        $id_admin = $_SESSION['id_siswa'] ?? 0;
        $query = "SELECT * FROM users WHERE id = " . intval($id_admin) . " AND role = 'admin' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $data_admin = mysqli_fetch_assoc($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'update_profil_admin') {
            $nama_baru = trim($_POST['nama'] ?? '');
            $password_baru = trim($_POST['password_baru'] ?? '');
            $konfirmasi    = trim($_POST['konfirmasi'] ?? '');

            if (!$nama_baru) {
                $pesan_error = "Nama tidak boleh kosong.";
            } elseif ($password_baru && strlen($password_baru) < 8) {
                $pesan_error = "Password baru minimal harus 8 karakter.";
            } elseif ($password_baru && $password_baru !== $konfirmasi) {
                $pesan_error = "Konfirmasi password tidak cocok.";
            } else {
                if ($this->userModel->updateProfilAdmin($id_admin, $nama_baru, $password_baru)) {
                    $_SESSION['nama'] = $nama_baru;
                    $nama_user = $nama_baru;
                    // Refresh data
                    $result2 = mysqli_query($conn, "SELECT * FROM users WHERE id = " . intval($id_admin) . " LIMIT 1");
                    $data_admin = mysqli_fetch_assoc($result2);
                    $pesan_sukses = "Profil berhasil diperbarui.";
                } else {
                    $pesan_error = "Gagal memperbarui profil.";
                }
            }
        }
        
        require_once 'view/admin/profilAdmin.php';
    }
}
?>