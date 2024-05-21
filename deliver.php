<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доставка</title>
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
        .image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .delivery-options {
            text-align: left;
            margin-top: 20px;
        }
        .delivery-options h2 {
            color: #FFCC00;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .delivery-options ul {
            list-style-type: none;
            padding: 0;
        }
        .delivery-options li {
            margin-bottom: 10px;
            font-size: 18px;
            color: #666;
        }
        .delivery-options li span {
            font-weight: bold;
            color: #333;
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
            <h1>Доставка</h1>
            <p>Ми пропонуємо різні варіанти доставки, щоб ви могли отримати ваші замовлення зручно та швидко.</p>
            <p>Детальніше про варіанти доставки ви можете дізнатись під час оформлення замовлення.</p>
            <div class="delivery-options">
                <h2>Варіанти доставки:</h2>
                <ul>
                    <li><span>Кур'єрська доставка:</span> Отримуйте свої замовлення безпосередньо до дверей.</li>
                    <li><span>Самовивіз:</span> Забирайте свої замовлення з нашого магазину в зручний для вас час.</li>
                    <li><span>Пошта:</span> Доставка замовлень у будь-яке відділення пошти у вашому місті.</li>
                </ul>
            </div>
            <p>Якщо у вас виникли питання, зв'яжіться з нашою службою підтримки.</p>
        </div>
    </main>
</body>
</html>
