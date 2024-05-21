<?php

class Database {
    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
        $this->initializeDatabase();
    }

    public function getConnection() {
        $databasePath = __DIR__ . '/../data/database.sqlite';
        try {
            if (!file_exists(__DIR__ . '/../data')) {
                mkdir(__DIR__ . '/../data', 0777, true);
            }
            $this->conn = new PDO("sqlite:" . $databasePath);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }

    private function initializeDatabase() {
        try {
            $this->conn->beginTransaction();
            $this->createTables();
            $this->fillTables();
            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            die("Error initializing database: " . $e->getMessage());
        }
    }

    public function createTables() {  // Изменение видимости на public
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            price REAL NOT NULL
        );
        CREATE TABLE IF NOT EXISTS cart (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            product_id INTEGER,
            quantity INTEGER,
            FOREIGN KEY (product_id) REFERENCES products(id)
        );";
        $this->conn->exec($sql);
    }

    private function fillTables() {
        // Приклад заповнення таблиці продуктів
        $products = [
            ['name' => 'Product1', 'description' => 'Description1', 'price' => 9.99],
            ['name' => 'Product2', 'description' => 'Description2', 'price' => 19.99],
            ['name' => 'Product3', 'description' => 'Description3', 'price' => 29.99],
        ];

        foreach ($products as $product) {
            $this->addProduct($product['name'], $product['description'], $product['price']);
        }
    }

    public function addUser($email, $password) {
        try {
            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error Code: " . $e->errorInfo[0] . "<br>";
            echo "Error Message: " . $e->getMessage() . "<br>";
            die("Error adding user: " . $e->getMessage());
        }
    }

    public function getUserByEmail($email) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching user: " . $e->getMessage());
        }
    }

    public function addProduct($name, $description, $price) {
        try {
            $sql = "INSERT INTO products (name, description, price) VALUES (:name, :description, :price)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error adding product: " . $e->getMessage());
        }
    }

    public function fetchProducts() {
        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    }

    public function removeFromCart($productId) {
        try {
            $sql = "DELETE FROM cart WHERE product_id = :productId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error removing from cart: " . $e->getMessage());
        }
    }
}
?>
