<?php
    class Database {
        private $conn;

        public function connect() {
            $this->conn = null;
            $hostname = getenv('hostname');
            $username = getenv('username');
            $password = getenv('password');
            $database = getenv('database');
            $dsn = "mysql:host={$hostname};dbname={$database}";
            try {
                $this->conn = new PDO($dsn, $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $error) {
                echo 'Connection Error: ' . $error->getMessage();
            }
            return $this->conn;
        }
    }
