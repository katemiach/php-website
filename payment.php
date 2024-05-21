<?php
session_start();

if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
    header('Location: basket.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Здесь может быть логика интеграции с реальной платежной системой
    echo "<script>alert('Оплата прошла успешно!');</script>";
    $_SESSION['basket'] = []; // Очистить корзину после успешной оплаты
    header('Location: success.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Онлайн Оплата</title>
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
        input[type="text"], input[type="number"], input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }
        input[type="text"]:focus, input[type="number"]:focus {
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
        <h1>Онлайн Оплата</h1>
        <form action="payment.php" method="POST">
            <input type="text" name="card_number" placeholder="Номер картки" required>
            <input type="text" name="card_name" placeholder="Ім'я на картці" required>
            <input type="number" name="card_expiry" placeholder="Термін дії (MMYY)" required>
            <input type="number" name="card_cvc" placeholder="CVC" required>
            <input type="submit" value="Оплатити">
        </form>
    </div>
</body>
</html>
