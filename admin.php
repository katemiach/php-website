<?php
session_start();
require 'database.php';

// Администраторский пароль
$admin_password = 'qwerty123456';

// Если пароль не введен или неверен, отображаем форму ввода пароля
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['admin_password'] === $admin_password) {
            $_SESSION['admin_logged_in'] = true;
        } else {
            echo "Неправильний пароль адміністратора.";
        }
    }

    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        ?>
        <!DOCTYPE html>
        <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Адмін-панель</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                main {
                    max-width: 400px;
                    margin: 100px auto;
                    padding: 20px;
                    background-color: white;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                    text-align: center;
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
            </style>
        </head>
        <body>
            <main>
                <h2>Вхід до адмін-панелі</h2>
                <form action="admin.php" method="POST">
                    <input type="password" name="admin_password" placeholder="Пароль адміністратора" required>
                    <button type="submit">Увійти</button>
                </form>
            </main>
        </body>
        </html>
        <?php
        exit;
    }
}

$db = new Database();
$conn = $db->getConnection();

try {
    $sql = "SELECT id, email, created_at FROM users";
    $stmt = $conn->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching users: " . $e->getMessage();
}

$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/809052.ico">
    <title>Користувачі</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    
    <main>
        <h1>Список користувачів</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Дата реєстрації</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
