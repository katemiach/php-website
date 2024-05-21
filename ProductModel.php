<?php
require_once 'Model.php';

class ProductModel extends Model {
    private $id;
    private $message;

    public function __construct($id = null, $message = null) {
        $this->id = $id;
        $this->message = $message;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getData() {
        return $this->message;
    }

    public function setData($data) {
        $this->message = $data;
    }

    // Збереження продукту у базі даних
    public function save($adapter) {
        if ($this->id === null) {
            $adapter->execute("INSERT INTO products (message) VALUES (:message)", ['message' => $this->message]);
            $this->id = $adapter->lastInsertId();
        } else {
            $adapter->execute("UPDATE products SET message = :message WHERE id = :id", ['message' => $this->message, 'id' => $this->id]);
        }
    }

    // Видалення продукту з бази даних
    public function delete($adapter) {
        if ($this->id !== null) {
            $adapter->execute("DELETE FROM products WHERE id = :id", ['id' => $this->id]);
            $this->id = null;
            $this->message = null;
        }
    }

    // Завантаження продукту з бази даних
    public static function load($adapter, $id) {
        $result = $adapter->query("SELECT * FROM products WHERE id = :id", ['id' => $id]);
        if (!empty($result)) {
            return new self($result[0]['id'], $result[0]['message']);
        }
        return null;
    }

    // Завантаження всіх продуктів з бази даних
    public static function loadAll($adapter) {
        $result = $adapter->query("SELECT * FROM products");
        $products = [];
        foreach ($result as $row) {
            $products[] = new self($row['id'], $row['message']);
        }
        return $products;
    }
}
?>
