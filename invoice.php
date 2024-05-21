<?php
session_start();

if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
    header('Location: basket.php');
    exit;
}

$products = [
    'item1' => ['name' => 'Свічка з вощини, 13 см х 4,5 см', 'price' => 80],
    'item2' => ['name' => 'Набір свічок (4 шт), 13 см х 4,5 см', 'price' => 350],
    'item3' => ['name' => 'Подарунковий набір (свічка+пилок+мед)', 'price' => 550],
    'item4' => ['name' => 'Подарунковий набір (пилок+мед)', 'price' => 650],
    'item5' => ['name' => 'Свічка з вощини, 6,5 см х 4,5 см', 'price' => 65],
    'item6' => ['name' => 'Набір свічок (2 шт), 13 см х 4,5 см', 'price' => 170],
];

$totalAmount = 0;
foreach ($_SESSION['basket'] as $item => $quantity) {
    if (isset($products[$item])) {
        $totalAmount += $quantity * $products[$item]['price'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SESSION['payment_method'] == 'online') {
        header('Location: payment.php');
        exit;
    } else {
       
        $_SESSION['basket'] = [];
        header('Location: success.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рахунок на оплату</title>
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
            max-width: 800px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FFD700;
            color: #333;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .button:hover {
            background-color: #ffcc00;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Рахунок на оплату</h1>
        <p>Спосіб оплати: <?php echo htmlspecialchars($_SESSION['payment_method']); ?></p>
        <p>Спосіб отримання: <?php echo htmlspecialchars($_SESSION['delivery_method']); ?></p>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Кількість</th>
                        <th>Ціна</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['basket'] as $item => $quantity) {
                        if (isset($products[$item])) {
                            $itemName = $products[$item]['name'];
                            $itemPrice = $products[$item]['price'];
                            echo "<tr>";
                            echo "<td>$itemName</td>";
                            echo "<td>$quantity</td>";
                            echo "<td>" . ($quantity * $itemPrice) . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="2" class="total">Загальна сума</td>
                        <td class="total"><?php echo $totalAmount; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php if ($_SESSION['payment_method'] == 'online'): ?>
            <form action="invoice.php" method="POST">
                <input type="hidden" name="action" value="online">
                <input type="submit" value="Оплатити онлайн" class="button">
            </form>
        <?php else: ?>
            <form action="invoice.php" method="POST">
                <input type="hidden" name="action" value="confirm">
                <input type="submit" value="Підтвердити замовлення" class="button">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
