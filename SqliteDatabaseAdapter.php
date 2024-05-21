<?php
require_once 'DatabaseAdapter.php';

class SqliteDatabaseAdapter implements DatabaseAdapter {
    private $pdo;

    public function connect() {
        $config = require 'config.php';
        $path = $config['sqlite']['path'];

        $dsn = "sqlite:$path";
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($sql) {
        $stmt = $this->pdo->query($sql);

        if ($stmt === FALSE) {
            die("Помилка запиту: " . $this->pdo->errorInfo()[2]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);

        if ($stmt === FALSE) {
            die("Помилка запиту: " . $this->pdo->errorInfo()[2]);
        }

        $stmt->execute($params);
    }
}
?>
