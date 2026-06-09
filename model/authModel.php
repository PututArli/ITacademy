<?php
class authModel {
    private $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }
    public function getUserByEmail($email) {
        $email = mysqli_real_escape_string($this->db, $email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->db, $query);
        return mysqli_fetch_assoc($result);
    }
    public function isEmailRegistered($email) {
        $email = mysqli_real_escape_string($this->db, $email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->db, $query);
        return mysqli_num_rows($result) > 0;
    }
    public function registerUser($nama, $email, $password, $role) {
        $nama     = mysqli_real_escape_string($this->db, $nama);
        $email    = mysqli_real_escape_string($this->db, $email);
        $role     = mysqli_real_escape_string($this->db, $role);
        // Hash password dengan bcrypt sebelum disimpan
        $hashed   = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$hashed', '$role')";
        return mysqli_query($this->db, $query);
    }
}