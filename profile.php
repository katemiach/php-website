<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: user.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Validate and sanitize inputs
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);

    // Save the data (you might want to save this in a database)
    $_SESSION['user_name'] = $name;
    $_SESSION['user_phone'] = $phone;

    $message = "Інформацію оновлено успішно!";
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профіль</title>
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
        .user-info, .user-form, .logout-link {
            text-align: center;
        }
        .logout-link {
            margin-top: 20px;
        }
        .logout-link a {
            color: black;
            text-decoration: none;
        }
        .logout-link a:hover {
            text-decoration: underline;
        }
        .user-form input {
            display: block;
            margin: 10px auto;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: calc(100% - 40px);
            max-width: 400px;
        }
        .user-form button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #fbff00;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .user-form button:hover {
            background-color: black;
            color: #fbff00;
        }
        .message {
            color: green;
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
                <li><a href="profile.php">Профіль</a></li>
                <li><a href="logout.php">Вихід</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Профіль</h1>
        <div class="user-info">
            <p>Ви увійшли як: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['user_phone'])): ?>
                <p>Ваше ім'я: <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
                <p>Ваш номер телефону: <?php echo htmlspecialchars($_SESSION['user_phone']); ?></p>
            <?php endif; ?>
        </div>
        <div class="user-form">
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Ваше ім'я" value="<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>" required>
                <input type="text" name="phone" placeholder="Ваш номер телефону" value="<?php echo isset($_SESSION['user_phone']) ? htmlspecialchars($_SESSION['user_phone']) : ''; ?>" required>
                <button type="submit">Оновити інформацію</button>
            </form>
            <?php if (isset($message)) { echo '<p class="message">'.$message.'</p>'; } ?>
        </div>
        <div class="logout-link">
            <p><a href="logout.php">Вийти</a></p>
        </div>
    </main>
</body>
</html>
