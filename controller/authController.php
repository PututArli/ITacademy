<?php
class authController {
    private $authModel;

    public function __construct() {
        require_once 'model/authModel.php';
        $this->authModel = new authModel();
    }

    public function checkInactivity() {
        if (isset($_SESSION['nama'])) {
            if (!isset($_SESSION['last_activity'])) {
                $_SESSION['last_activity'] = time();
            } else {
                $durasi_diam = time() - $_SESSION['last_activity'];
                $batas_maksimal = 1200;

                if ($durasi_diam > $batas_maksimal) {
                    $this->logout(true);
                }
            }
            $_SESSION['last_activity'] = time();
        }
    }

    public function login() {
        if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
            $this->redirectByRole($_SESSION['role'], $_SESSION['nama']);
        }

        $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email    = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->authModel->getUserByEmail($email);

            // Dukung password lama (plaintext) DAN baru (bcrypt hash)
            $login_valid = false;
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Password sudah di-hash — cara baru
                    $login_valid = true;
                } elseif (!empty($password) && $user['password'] === $password) {
                    // Password masih plaintext (akun lama belum dimigrate)
                    $login_valid = true;
                    // Upgrade otomatis ke hash setelah login berhasil
                    global $conn;
                    $new_hash = password_hash($password, PASSWORD_BCRYPT);
                    $new_hash_esc = mysqli_real_escape_string($conn, $new_hash);
                    $uid = intval($user['id']);
                    mysqli_query($conn, "UPDATE users SET password = '$new_hash_esc' WHERE id = '$uid'");
                }
            }

            if ($login_valid) {
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['last_activity'] = time();
                $_SESSION['id_siswa'] = $user['id']; 

                $this->redirectByRole($user['role'], $user['nama']);
            } else {
                $error = "Email atau Kata Sandi salah!";
            }
        }
        require_once 'view/auth/login.php';
    }

    public function register() {
        if (isset($_SESSION['nama'])) {
            header("Location: " . BASEURL . "/index.php");
            exit();
        }

        $error = "";
        $success = "";
        $plan_pilihan = isset($_GET['plan']) ? $_GET['plan'] : 'free';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama       = $_POST['nama'];
            $email      = $_POST['email'];
            $role       = $_POST['role'];
            $password   = $_POST['password'];
            $konfirmasi = $_POST['konfirmasi'];
            $role       = $_POST['role_hidden'];

            if (strlen($password) < 8) {
                $error = "Password minimal harus 8 karakter!";
            } elseif ($password !== $konfirmasi) {
                $error = "Konfirmasi password tidak cocok!";
            } else {
                if ($this->authModel->isEmailRegistered($email)) {
                    $error = "Email sudah terdaftar, gunakan email lain!";
                } else {
                    if ($this->authModel->registerUser($nama, $email, $password, $role)) {
                        $success = "Akun berhasil dibuat! Silakan masuk.";
                    } else {
                        $error = "Gagal menyimpan data akun baru.";
                    }
                }
            }
        }
        require_once 'view/auth/register.php';
    }

    public function logout($isTimeout = false) {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        if ($isTimeout) {
            header("Location: " . BASEURL . "/index.php?page=login&timeout=1");
        } else {
            header("Location: " . BASEURL . "/index.php?page=login");
        }
        exit();
    }

    private function redirectByRole($role, $nama) {
        $nama_url = urlencode($nama);
        if ($role === 'admin') {
            header("Location: " . BASEURL . "/index.php?page=dashboardAdmin&nama=" . $nama_url);
        } elseif ($role === 'mentor') {
            header("Location: " . BASEURL . "/index.php?page=dashboardMentor&nama=" . $nama_url);
        } else {
            header("Location: " . BASEURL . "/index.php?page=dashboard&nama=" . $nama_url);
        }
        exit();
    }
}