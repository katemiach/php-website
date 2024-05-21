<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['payment_method'] = $_POST['payment_method'];
    $_SESSION['delivery_method'] = $_POST['delivery_method'];
    header('Location: invoice.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір способу оплати і доставки</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-size: 18px;
            color: #666;
            margin: 10px 0;
            width: 100%;
            text-align: left;
        }
        select, input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }
        select:focus, input[type="submit"]:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }
        input[type="submit"] {
            background-color: #FFD700;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        input[type="submit"]:hover {
            background-color: #ffcc00;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Вибір способу оплати і доставки</h1>
        <form action="checkout.php" method="POST">
            <label for="payment_method">Виберіть спосіб оплати:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="online">Онлайн оплата</option>
                <option value="cod">Оплата при отриманні</option>
            </select>
            <label for="delivery_method">Виберіть спосіб отримання:</label>
            <select id="delivery_method" name="delivery_method" required>
                <option value="courier">Доставка кур'єром</option>
                <option value="pickup">Самовивіз</option>
            </select>
            <input type="submit" value="Продовжити">
        </form>
    </div>
</body>
</html>
