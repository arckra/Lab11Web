<?php
require_once __DIR__ . "/../../config/database.php";

class Auth extends Database {

    public function login($username, $password) {

        $username = trim($this->escape($username));
        $password = trim($password);

        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = $this->query($sql);

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if ($password === $user['password']) {
                $_SESSION['login'] = true;
                $_SESSION['user']  = $user;
                return true;
            }
        }
        return false;
    }

    public function logout() {
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }

    public function check() {
        return isset($_SESSION['login']);
    }
}
