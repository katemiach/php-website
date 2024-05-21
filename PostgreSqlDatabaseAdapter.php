<?php
require_once 'DatabaseAdapter.php';

class PostgreSqlDatabaseAdapter implements DatabaseAdapter {
    private $connection;

    public function connect() {
        $host = 'localhost';  // Змініть на ваш хост
        $db = 'your_database';  // Змініть на вашу базу даних
        $user = 'your_username';  // Змініть на вашого користувача
        $pass = 'your_password';  // Змініть на ваш пароль

        $connectionString = "host=$host dbname=$db user=$user password=$pass";
        $this->connection = pg_connect($connectionString);

        if (!$this->connection) {
            die("Підключення не вдалося: " . pg_last_error());
        }
    }

    public function query($sql) {
        $result = pg_query($this->connection, $sql);

        if (!$result) {
            die("Помилка запиту: " . pg_last_error());
        }

        return $result;
    }
}
?>
