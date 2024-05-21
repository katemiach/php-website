<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Про нас</title>
    <link rel="icon" href="img/809052.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
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
            background-color: #f4f4f4;
            border-radius: 20px;
            transition: color 0.3s, background-color 0.3s;
            padding: 5px;
            font-family: Comic Sans MS; 
        }
        nav a:hover {
            color: yellow;
            background-color: black;
        }
        main {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 20px;
        }
        .highlight {
            color: #FFCC00;
            font-weight: bold;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .images-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .image {
            max-width: 30%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
                <li><a href="logout.php">Вхід</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h1>Про нас</h1>
            <div class="images-row">
                <img src="2.jpg" alt="Про нас" class="image">
                <img src="7.jpg" alt="Про нас" class="image">
                <img src="3.jpg" alt="Про нас" class="image">
            </div>
            <p>Ласкаво просимо до <span class="highlight">EcoBeeShop</span>! Ми спеціалізуємось на унікальних та екологічно чистих продуктах, які приносять радість у кожний дім.</p>
            <p>Наші товари виготовлені з натуральних матеріалів та з любов'ю до природи. Ми прагнемо забезпечити вас найкращою продукцією та сервісом.</p>
            <p>Дякуємо, що ви з нами!</p>
        </div>
    </main>
</body>
</html>
