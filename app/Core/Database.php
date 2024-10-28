<?php
    namespace Khamid\Framework\Core;
    
    use PDO;

    class Database {
        private static $instance = null;
        private $pdo;

        private function __construct() {

            $host = config('database.DB_HOST');
            $dbname = config('database.DB_NAME');
            $user = config('database.DB_USER');
            $password = config('database.DB_PASS');

            
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function getConnection() {
            return $this->pdo;
        }
    }