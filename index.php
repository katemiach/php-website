<?php
require_once 'vendor/autoload.php';
require_once 'Router.php';
require_once 'Controller.php';
require_once 'View.php';
require_once 'Model.php';
require_once 'ModelFactory.php';
require_once 'PriceCalculationStrategy.php';
require_once 'DiscountPriceCalculationStrategy.php';
require_once 'SimplePriceCalculationStrategy.php';
require_once 'PriceCalculator.php';
require_once 'DatabaseAdapter.php';
require_once 'SqliteDatabaseAdapter.php';
require_once 'LoggerDecorator.php';
require_once 'ProductModel.php';

// Завантаження конфігурації
$config = require 'config.php';

// Ініціалізація бази даних SQLite і створення таблиці
function initializeDatabase($adapter) {
    $adapter->connect();
    $createTableSql = "
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            message TEXT NOT NULL
        )
    ";
    $adapter->execute($createTableSql);
}

// Ініціалізація маршрутизатора
$router = Router::getInstance();

// Визначення маршрутів
$router->addRoute('/', function() use ($config) {
    $sqliteAdapter = new SqliteDatabaseAdapter();
    initializeDatabase($sqliteAdapter);

    $sqliteAdapter->connect();
    $result = $sqliteAdapter->query("SELECT message FROM products ORDER BY id DESC LIMIT 1");
    $data = !empty($result) ? $result[0] : ["message" => "Це дані продукту"];

    $model = new ProductModel();
    $model->setData($data['message']);
    $view = new View($model);
    $controller = new Controller($model, $view);
    $controller->handleRequest();
    $view->render();
});

$router->addRoute('/index.php', function() use ($config) {
    $sqliteAdapter = new SqliteDatabaseAdapter();
    initializeDatabase($sqliteAdapter);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newData = $_POST['data'] ?? 'Немає даних';
        $product = new ProductModel();
        $product->setMessage($newData);
        $product->save($sqliteAdapter);
    }

    $sqliteAdapter->connect();
    $result = $sqliteAdapter->query("SELECT message FROM products ORDER BY id DESC LIMIT 1");
    $data = !empty($result) ? $result[0] : ["message" => "Це дані продукту"];

    $model = new ProductModel();
    $model->setData($data['message']);
    $view = new View($model);
    $controller = new Controller($model, $view);
    $controller->handleRequest();
    $view->render();
});

// Обробка запиту
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->route($request);
?>

<!-- Форма для відправки POST-запиту -->
<form method="POST" action="">
    <input type="text" name="data" placeholder="Введіть дані" />
    <button type="submit">Відправити</button>
</form>
