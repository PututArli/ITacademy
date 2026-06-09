<?php
class userController {
    public function __construct() {
        if (!isset($_SESSION['nama']) || ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mentor')) {
            header("Location: " . BASEURL . "/index.php?page=login");
            exit();
        }
    }

    public function dashboard() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';

        // Load tugas status for dashboard
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;
        $status_tugas = 'Belum Mengirim';
        if ($id_siswa) {
            require_once 'model/tugasModel.php';
            $tugasModel = new tugasModel();
            $tugasSiswa = $tugasModel->getTugasBySiswaId($id_siswa);
            if ($tugasSiswa) {
                $status_tugas = $tugasSiswa['status'];
            }
        }

        require_once 'view/user/dashboard.php';
    }

   public function materi() {
    $nama_user = $_SESSION['nama'] ?? 'User';
    $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';

    require_once 'model/materiModel.php';
    $materiModel = new materiModel($GLOBALS['conn']);
    $id_materi = isset($_GET['id']) ? $_GET['id'] : 1;
    $list_materi = $materiModel->getAllMateri();
    $materi_aktif = $materiModel->getMateriById($id_materi);
    require_once 'view/user/materi.php';
    }

    public function kuis() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        require_once 'view/user/kuis.php';
    }

    public function tugas() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;

        if (empty($id_siswa) && !empty($nama_user)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_user);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        require_once 'model/tugasModel.php';
        $tugasModel = new tugasModel();
        $tugasSiswa = $tugasModel->getTugasBySiswaId($id_siswa);
        $status_tugas = $tugasSiswa ? $tugasSiswa['status'] : 'Belum Mengirim';

        require_once 'view/user/tugas.php';
    }

    public function kirimTugas() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $nama_siswa = isset($_SESSION['nama']) ? $_SESSION['nama'] : null;
        $id_siswa   = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;

        if (empty($id_siswa) && !empty($nama_siswa)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_siswa);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST) && empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=file_terlalu_besar");
                exit();
            }

            $judul_tugas = trim($_POST['judul_tugas'] ?? '');
            $file        = $_FILES['file_tugas'] ?? null;

            if (!$judul_tugas) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=judul_kosong");
                exit();
            }

            if ($file && ($file['error'] === UPLOAD_ERR_INI_SIZE || $file['error'] === UPLOAD_ERR_FORM_SIZE)) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=file_terlalu_besar");
                exit();
            }

            if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=file_gagal");
                exit();
            }

            $maks_ukuran = 20 * 1024 * 1024;
            if ($file['size'] > $maks_ukuran) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=file_terlalu_besar");
                exit();
            }

            $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $ekstensi_diizinkan = ['zip', 'rar', 'pdf'];
            if (!in_array($ekstensi, $ekstensi_diizinkan)) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=format_tidak_didukung");
                exit();
            }

            $mime_diizinkan = ['application/zip', 'application/x-zip-compressed', 'application/x-rar-compressed',
                               'application/vnd.rar', 'application/pdf', 'application/octet-stream'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime  = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            if (!in_array($mime, $mime_diizinkan) && $ekstensi !== 'rar') {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=format_tidak_didukung");
                exit();
            }

            $nama_bersih_file = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
            $nama_final  = $nama_bersih_file . '_' . time() . '.' . $ekstensi;
            $target_dir  = "assets/uploads/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $target_dir . $nama_final)) {
                header("Location: " . BASEURL . "/index.php?page=tugas&error=upload_gagal");
                exit();
            }

            require_once 'model/tugasModel.php';
            $tugasModel = new tugasModel();

            $tugas_lama = $tugasModel->getTugasBySiswaId($id_siswa);
            if ($tugas_lama && $tugas_lama['status'] === 'Revisi') {
                $tugasModel->updateTugasRevisi($tugas_lama['id_tugas'], $judul_tugas, $nama_final);
            } else {
                $tugasModel->tambahTugas($id_siswa, $judul_tugas, $nama_final);
            }

            header("Location: " . BASEURL . "/index.php?page=tugas&upload=sukses");
            exit();
        }
    }

    public function sertifikat() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;

        if (empty($id_siswa) && !empty($nama_user)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_user);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        require_once 'model/sertifikatModel.php';
        $sertifikatModel = new sertifikatModel();
        $sertifikatSiswa = null;

        if ($id_siswa) {
            $sertifikatSiswa = $sertifikatModel->getSertifikatBySiswaId($id_siswa);
        }

        require_once 'view/user/sertifikat.php';
    }

    public function profil() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;
        $pesan_sukses = '';
        $pesan_error  = '';

        if (empty($id_siswa) && !empty($nama_user)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_user);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        require_once 'model/userModel.php';
        $userModel = new userModel();
        $data_user = $userModel->getUserById($id_siswa);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi'])) {
            if ($_POST['aksi'] === 'update_profil') {
                $nama_baru     = trim($_POST['nama'] ?? '');
                $password_baru = trim($_POST['password_baru'] ?? '');
                $konfirmasi    = trim($_POST['konfirmasi'] ?? '');

                if (!$nama_baru) {
                    $pesan_error = "Nama tidak boleh kosong.";
                } elseif ($password_baru && strlen($password_baru) < 8) {
                    $pesan_error = "Password baru minimal harus 8 karakter.";
                } elseif ($password_baru && $password_baru !== $konfirmasi) {
                    $pesan_error = "Konfirmasi password tidak cocok.";
                } else {
                    if ($userModel->updateProfilUser($id_siswa, $nama_baru, $password_baru)) {
                        $_SESSION['nama'] = $nama_baru;
                        $nama_user = $nama_baru;
                        $data_user = $userModel->getUserById($id_siswa);
                        $pesan_sukses = "Profil berhasil diperbarui.";
                    } else {
                        $pesan_error = "Gagal memperbarui profil.";
                    }
                }
            } elseif ($_POST['aksi'] === 'upgrade_premium') {
                if ($userModel->upgradeToPremium($id_siswa)) {
                    $_SESSION['role'] = 'premium';
                    $status_keanggotaan = 'Premium Member';
                    $data_user = $userModel->getUserById($id_siswa);
                    $pesan_sukses = "Berhasil upgrade ke Premium! Nikmati akses penuh ke semua fitur.";
                } else {
                    $pesan_error = "Gagal memproses upgrade. Silakan coba lagi.";
                }
            }
        }

        $pecah_nama    = explode(" ", $nama_user);
        $nama_depan    = $pecah_nama[0];
        $nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";

        require_once 'view/user/profil.php';
    }
}