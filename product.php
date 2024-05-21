<?php
session_start();

// Встановлення заголовка Content-Type для правильного кодування
header('Content-Type: text/html; charset=utf-8');

// Збір інформації про користувача
$agent = $_SERVER['HTTP_USER_AGENT'];
$uri = $_SERVER['REQUEST_URI'];
$user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : "Ні";
$ip = $_SERVER['REMOTE_ADDR'];
$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "Ні";
$dtime = date('r');

// Форматування рядка для запису
$entry_line = "$dtime - IP: $ip | Agent: $agent | URL: $uri | Referrer: $ref | Username: $user\n";

// Запис у файл
$fp = fopen("logs.txt", "a");
if ($fp) {
    fputs($fp, $entry_line);
    fclose($fp);
}

// XML-файл для роботи
$xml_file = 'data.xml';

// Створення об'єкта DOM
$dom = new DOMDocument('1.0', 'UTF-8');

// Перевірка, чи існує XML-документ
if (file_exists($xml_file)) {
    // Завантаження існуючого XML-документа
    $dom->load($xml_file);
    $root = $dom->documentElement;
} else {
    // Створення нового XML-документа з кореневим елементом <users>
    $root = $dom->createElement('users');
    $dom->appendChild($root);
    $dom->save($xml_file);
}

// Додавання нового користувача в XML
$newUser = $dom->createElement('user');
$newUser->appendChild($dom->createElement('ip', $ip));
$newUser->appendChild($dom->createElement('agent', $agent));
$newUser->appendChild($dom->createElement('uri', $uri));
$newUser->appendChild($dom->createElement('user', $user));
$newUser->appendChild($dom->createElement('referrer', $ref));
$newUser->appendChild($dom->createElement('date', $dtime));

$root->appendChild($newUser);

// Збереження змін в XML-файлі
$dom->save($xml_file);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBeeShop</title>
    <script src="script.js"></script>
    <link rel="icon" href="img/809052.ico">
    <style>
        header {
            height: 70px; 
            overflow: auto; 
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo a {
            color: black;
            text-decoration: none;
            font-size: 32px;
            font-weight: bold;
            margin-left: 100px; 
            text-shadow: 2px 2px 5px yellow;
            font-family: Arial; 
        }
        nav ul {
            list-style-type: none;
            margin: 20;
            padding: 0;
            display: flex;
        }
        nav li {
            margin-right: 100px;
            margin-left: -60px;
        }
        nav a {
            color: black;
            text-decoration: none;
            font-size: 22px;
            background-color: white;
            border-radius: 20px;
            transition: color 0.3s, background-color 0.3s;
            padding: 5px;
            font-family: Comic Sans MS; 
        }
        nav a:hover {
            color: yellow;
            background-color: black;
        }
        
        .container {
            display: flex;
            justify-content: center;
        }

        .sidebar {
            width: 200px;
            padding: 20px;
            margin-top: 10px;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-top: 200px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            display: block;
            text-decoration: none;
            color: black;
            font-family: Comic Sans MS;
            font-weight: bold;
            background-color: white;
            border-radius: 20px;
            transition: color 0.3s, background-color 0.3s;
            padding: 5px; 
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            color: #BCBCBC;
        }

        .sidebar ul li a.active {
            color:  #BCBCBC; 
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: -200px;
        }

        .product {
            width: calc(25% - 20px); 
            margin: 10px;
            padding: 20px;
            background-color: white;
            text-align: center;
            color: black;
            border-radius: 20px;
            font-size: 18px;
            font-family: Arial;
            transition: color 0.3s, background-color 0.3s;
            text-decoration: none;
        }

        .product:hover {
            background-color: #FBF076;
        }

        .buy select,
        .buy input[type="number"],
        .buy button {
            box-sizing: border-box; /* Включає паддінги і рамки в розрахунок ширини */
            width: 300px; /* Фіксована ширина для кращого контролю розмірів */
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            font-size: 16px;
            font-family: Arial;
            display: block; /* Гарантує, що елементи розтягуються на всю вказану ширину */
            margin-left: auto; /* Центрування елементів форми */
            margin-right: auto;
        }

        .buy button {
            color: #fff;
            background-color: #000;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .buy button:hover {
            background-color: #444;
        }
        .footer {
            height: 300px;
            padding-top: 100px; 
            padding-bottom: 20px; 
            text-align: center; 
            background-color: #F6F6F6;
        }

        .footer-info {
            font-size: 26px;
            font-family: Arial;
            font-weight: bold;
        }
        .footer-info-adress {
            font-size: 18px;
            font-family: Arial;
        
        }
        .footer img {
            width: 50px; 
            height: auto;
        }

        /* Додаткові стилі для таблиці */
        table.product-table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        table.product-table th, table.product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table.product-table th {
            background-color: #f2f2f2;
            color: black;
        }

        table.product-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table.product-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index1.php">EcoBeeShop</a>
            </div>
            <ul>
                <li><a href="product.php">Товари</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="deliver.php">Доставка</a></li>
                <li><a href="basket.php">Кошик</a></li>
                <li><a href="user.php">Вхід</a></li>
            </ul>
        </nav>
    </header>
   
    <div class="main-content">
        <div class="products">
        <?php
        
// Абстрактний клас для всіх товарів
abstract class Item {
    protected $name;
    protected $price;
    protected $image;

    // Конструктор
    public function __construct($name, $price, $image) {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    // Метод для відображення товару
    public function display() {
        echo '<a href="product.php?id='.$this->getId().'" class="product">';
        echo '<img src="'.$this->image.'" width="220" height="250"><br><br>';
        echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">'.$this->name.'</span><br><br>';
        echo $this->price.' грн';
        echo '</a>';
    }

    // Абстрактний метод для отримання ідентифікатора товару
    abstract protected function getId();
}

// Клас для представлення свічок
class Candle extends Item {
    protected $size;

    // Конструктор
    public function __construct($name, $price, $image, $size) {
        parent::__construct($name, $price, $image);
        $this->size = $size;
    }

    // Метод для отримання ідентифікатора свічки
    protected function getId() {
        return 'candle_'.$this->size;
    }
}

// Клас для представлення подарункових наборів
class GiftSet extends Item {
    protected $components;

    // Конструктор
    public function __construct($name, $price, $image, $components) {
        parent::__construct($name, $price, $image);
        $this->components = $components;
    }

    // Метод для отримання ідентифікатора подарункового набору 
    protected function getId() {
        return 'giftset_'.$this->components;
    }
}

// Створення об'єктів товарів
$items = array(
    new Candle('Свічка з вощини, 13 см х 4,5 см', 80, '1.jpg', 'big'),
    new GiftSet('Подарунковий набір (свічка+пилок+мед)', 550, '3.jpg', 'full'),
    new Candle('Набір свічок (4 шт), 13 см х 4,5 см', 350, '2.jpg', 'big'),
    new GiftSet('Подарунковий набір (пилок+мед)', 650, '4.jpg', 'half'),
    new Candle('Свічка з вощини, 6,5 см х 4,5 см', 65, '5.jpg', 'small'),
    new Candle('Набір свічок (2 шт), 13 см х 4,5 см', 170, '6.jpg', 'big'),
);

// Відображення товарів
foreach ($items as $item) {
    $item->display();
}

?>
        </div>
    </div>
    
    <?php
    // PHP HTML parser
    class MyHTMLParser {
        private $dom;
        private $tableData;

        public function __construct() {
            $this->dom = new DOMDocument();
            $this->tableData = [];
        }

        public function parse($html) {
            libxml_use_internal_errors(true);
            $this->dom->loadHTML('<?xml encoding="UTF-8">' . $html);
            libxml_clear_errors();

            $this->traverse($this->dom);
        }

        private function traverse(DOMNode $node) {
            if ($node->nodeType == XML_ELEMENT_NODE) {
                $this->handle_starttag($node);
            }

            if ($node->nodeType == XML_TEXT_NODE) {
                $this->handle_data($node->nodeValue);
            }

            foreach ($node->childNodes as $child) {
                $this->traverse($child);
            }

            if ($node->nodeType == XML_ELEMENT_NODE) {
                $this->handle_endtag($node);
            }
        }

        private function handle_starttag(DOMNode $node) {
            // Обробка стартових тегів
        }

        private function handle_endtag(DOMNode $node) {
            // Обробка кінцевих тегів
        }

        private function handle_data($data) {
            if (trim($data)) {
                $this->tableData[] = trim($data);
            }
        }

        public function getTableData() {
            return $this->tableData;
        }
    }

    // HTML content for parsing
    $html_content = '
    <table>
        <tr>
            <th>Продукт</th>
            <th>Ціна</th>
        </tr>
        <tr>
            <td>Свічка з вощини, 13 см х 4,5 см</td>
            <td>80 грн</td>
        </tr>
        <tr>
            <td>Набір свічок (4 шт), 13 см х 4,5 см</td>
            <td>350 грн</td>
        </tr>
        <tr>
            <td>Подарунковий набір (свічка+пилок+мед)</td>
            <td>550 грн</td>
        </tr>
        <tr>
            <td>Подарунковий набір (пилок+мед)</td>
            <td>650 грн</td>
        </tr>
        <tr>
            <td>Свічка з вощини, 6,5 см х 4,5 см</td>
            <td>65 грн</td>
        </tr>
        <tr>
            <td>Набір свічок (2 шт), 13 см х 4,5 см</td>
            <td>170 грн</td>
        </tr>
    </table>
    ';

    // Створення і запуск парсера
    $parser = new MyHTMLParser();
    $parser->parse($html_content);
    $tableData = $parser->getTableData();

    // Виведення HTML-таблиці
    echo "<table class='product-table'>
            <tr>
                <th>Продукт</th>
                <th>Ціна</th>
            </tr>";

    for ($i = 2; $i < count($tableData); $i += 2) {
        echo "<tr>";
        echo "<td>{$tableData[$i]}</td>";
        echo "<td>{$tableData[$i + 1]}</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

<div class="buy">
    <form method="POST" action="add_to_basket.php">
        <select name="item">
            <option value="item1">Свічка з вощини, 13 см х 4,5 см</option>
            <option value="item2">Набір свічок (4 шт), 13 см х 4,5 см</option>
            <option value="item3">Подарунковий набір (свічка+пилок+мед)</option>
            <option value="item4">Подарунковий набір (пилок+мед)</option>
            <option value="item5">Свічка з вощини, 6,5 см х 4,5 см</option>
            <option value="item6">Набір свічок (2 шт), 13 см х 4,5 см</option>
        </select>
        <input type="number" name="quantity" min="1" value="1">
        <button type="submit" name="buy">Додати в кошик</button>
    </form>
</div>

    </body>
    <footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="socials">
            <a href="https://www.etsy.com/shop/EcoBeeShop"><img src="etsy.png"></a>
            <a href="https://www.facebook.com/profile.php?id=100075163906258"><img src="facebook.png"></a>
            <a href="https://www.instagram.com/podarochki_ot_pchelki?igsh=Y2V1anYyMWw2MHFo"><img src="instagram.png"></a>
            </div>
            <div class="footer-info">
                <p>Зроби замовлення та <br>насолоджуйся товарами з <br>EcoBeeShop</p>
                </div>
                <div class="footer-info-adress">
                <p>Кривий Ріг, Площа Визволення, 15</p>
                <p>Телефон: +380662788132</p>
            </div>
        </div>
    </div>
</footer>
</html>
