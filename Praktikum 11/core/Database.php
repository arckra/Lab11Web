<?php
class Database {
    protected $host;
    protected $user;
    protected $pass;
    protected $db;
    protected $conn;

    public function __construct() {
        // Ambil config dari /config/database.php
        $config = [];
        require __DIR__ . '/../config/database.php';

        $this->host = $config['host'] ?? 'localhost';
        $this->user = $config['username'] ?? 'root';
        $this->pass = $config['password'] ?? '';
        $this->db   = $config['db_name'] ?? '';

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escape($value) {
        return $this->conn->real_escape_string($value);
    }
}
