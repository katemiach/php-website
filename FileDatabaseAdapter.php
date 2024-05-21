<?php
require_once 'DatabaseAdapter.php';

class FileDatabaseAdapter implements DatabaseAdapter {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function connect() {
    }

    public function query($sql) {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $data = file_get_contents($this->filePath);
        return json_decode($data, true);
    }

    public function save($data) {
        // Збереження даних у файл
        $jsonData = json_encode($data);
        file_put_contents($this->filePath, $jsonData);
    }
}
?>
