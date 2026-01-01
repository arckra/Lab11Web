<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../config/database.php";

class Auth extends Database {

    public function login($username, $password) {

        $username = $this->escape($username);

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = $this->query($sql);

        if ($result && $result->num_rows === 1) {
            $users = $result->fetch_assoc();

            if (password_verify($password, $users['password'])) {

                $_SESSION['login']   = true;
                $_SESSION['user_id'] = $users['id_user'];
                $_SESSION['username'] = $users['username'];
                return true;
            }
        }
        
        return false;
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }
}
