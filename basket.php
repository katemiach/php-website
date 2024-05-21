<?php
session_start();

if(!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

$products = [
    'item1' => 'Свічка з вощини, 13 см х 4,5 см',
    'item2' => 'Набір свічок (4 шт), 13 см х 4,5 см',
    'item3' => 'Подарунковий набір (свічка+пилок+мед)',
    'item4' => 'Подарунковий набір (пилок+мед)',
    'item5' => 'Свічка з вощини, 6,5 см х 4,5 см',
    'item6' => 'Набір свічок (2 шт), 13 см х 4,5 см',
];

// Функціональність для видалення товару з кошика
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['item'])) {
    $itemToDelete = $_GET['item'];
    if(isset($_SESSION['basket'][$itemToDelete])) {
        unset($_SESSION['basket'][$itemToDelete]);
    }
    header("Location: basket.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
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
        .cart-container {
            background-color: #fff;
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            text-align: left;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .cart-header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .cart-item {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #eee;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: background-color 0.3s;
        }
        .cart-item:hover {
            background-color: #f0f0f0;
        }
        .cart-item-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .cart-item-details {
            font-size: 16px;
            color: #666;
            margin-top: 5px;
        }
        .cart-item-action {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #000; /* Чорний колір фону кнопки */
            color: #FFD700; /* Жовтий колір тексту */
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
        }
        .cart-item-action:hover {
            background-color: #31312D;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .cart-empty {
            text-align: center;
            font-size: 18px;
            color: #666;
        }
        .cart-checkout {
            text-align: center;
            margin-top: 20px;
        }
        .cart-checkout a {
            display: inline-block;
            padding: 5px 20px;
            background-color: #000; /* Чорний колір фону кнопки */
            color: #FFD700; /* Жовтий колір тексту */
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .cart-checkout a:hover {
            background-color: #31312D;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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

<?php
// Відображення вмісту кошика
echo "<div class='cart-container'>";
echo "<h1 class='cart-header'>Ваш кошик</h1>";
if(count($_SESSION['basket']) > 0) {
    foreach($_SESSION['basket'] as $item => $quantity) {
        $itemName = isset($products[$item]) ? $products[$item] : "Unknown Item";
        echo "<div class='cart-item'>";
        echo "<div class='cart-item-title'>$itemName</div>";
        echo "<div class='cart-item-details'>Кількість: $quantity</div>";
        echo "<a href='basket.php?action=delete&item=$item' class='cart-item-action'>Видалити</a>";
        echo "</div>";
    }
    echo "<div class='cart-checkout'><a href='checkout.php'>Купити</a></div>";
} else {
    echo "<p class='cart-empty'>Кошик порожній</p>";
}
echo "</div>";
?>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="socials">
                <a href="https://www.etsy.com/shop/EcoBeeShop"><img src="etsy.png"></a>
                <a href="https://www.facebook.com/profile.php?id=100075163906258"><img src="facebook.png"></a>
                <a href="https://www.instagram.com/podarochki_ot_pchelki?igshid=Y2V1anYyMWw2MHFo"><img src="instagram.png"></a>
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

</body>
</html>
