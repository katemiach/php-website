<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBeeShop</title>
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
        }
        h1, h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form input {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ffcc00;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #e6b800;
        }
        .toggle-link {
            text-align: center;
            margin-top: 20px;
        }
        .toggle-link a {
            color: #007bff;
            text-decoration: none;
        }
        .toggle-link a:hover {
            text-decoration: underline;
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
    <main>
        <section id="login-section">
            <h2>Вхід</h2>
            <form action="login.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Увійти</button>
            </form>
            <div class="toggle-link">
                <p>Немає акаунту? <a href="register.php">Зареєструватися тут</a></p>
            </div>
        </section>
    </main>
</body>
</html>
