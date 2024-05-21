<?php

function convertToHTML($string) {
    // Перетворення спеціальних символів у HTML-сутності
    $string = htmlspecialchars($string);

    // Заміна **жирного тексту** на <strong>жирний текст</strong>
    $string = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $string);

    // Заміна *курсиву* на <em>курсив</em>
    $string = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $string);

    return $string;
}

function convertFromHTML($html) {
    // Заміна <strong>жирного тексту</strong> на **жирний текст**
    $html = preg_replace('/<strong>(.*?)<\/strong>/', '**$1**', $html);

    // Заміна <em>курсиву</em> на *курсив*
    $html = preg_replace('/<em>(.*?)<\/em>/', '*$1*', $html);

    // Перетворення HTML-сутностей назад у спеціальні символи
    $html = htmlspecialchars_decode($html);

    return $html;
}

function convertFileToHTML($inputFilePath, $outputFilePath) {
    if (!file_exists($inputFilePath)) {
        echo "Input file does not exist.";
        return;
    }

    $inputContent = file_get_contents($inputFilePath);
    $htmlContent = convertToHTML($inputContent);
    file_put_contents($outputFilePath, $htmlContent);
    echo "File converted to HTML successfully. <a href='$outputFilePath' download>Download</a>";
}

function convertFileFromHTML($inputFilePath, $outputFilePath) {
    if (!file_exists($inputFilePath)) {
        echo "Input file does not exist.";
        return;
    }

    $inputContent = file_get_contents($inputFilePath);
    $textContent = convertFromHTML($inputContent);
    file_put_contents($outputFilePath, $textContent);
    echo "File converted from HTML successfully. <a href='$outputFilePath' download>Download</a>";
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перетворення тексту</title>
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
        form textarea, form input[type="file"] {
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
        .converted-text {
            margin-top: 20px;
            padding: 10px;
            background-color: #f4f4f4;
            border-radius: 4px;
            white-space: pre-wrap;
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
        <section id="conversion-section">
            <h2>Перетворення тексту та файлів</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <textarea name="inputText" placeholder="Введіть текст для перетворення" rows="5" cols="50"></textarea>
                <button type="submit" name="toHTML">Перетворити в HTML</button>
                <button type="submit" name="fromHTML">Перетворити з HTML</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $inputText = $_POST['inputText'] ?? '';
                if (isset($_POST['toHTML'])) {
                    $convertedText = convertToHTML($inputText);
                    echo "<h3>Перетворено в HTML:</h3>";
                    echo "<div class='converted-text'>" . htmlspecialchars($convertedText) . "</div>";
                } elseif (isset($_POST['fromHTML'])) {
                    $convertedText = convertFromHTML($inputText);
                    echo "<h3>Перетворено з HTML:</h3>";
                    echo "<div class='converted-text'>" . htmlspecialchars($convertedText) . "</div>";
                }
            }
            ?>

            <h2>Перетворення файлів</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="inputFile" required>
                <button type="submit" name="convertFileToHTML">Перетворити файл в HTML</button>
                <button type="submit" name="convertFileFromHTML">Перетворити файл з HTML</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['inputFile'])) {
                $inputFile = $_FILES['inputFile']['tmp_name'];
                $outputFile = 'output.txt';

                if (isset($_POST['convertFileToHTML'])) {
                    convertFileToHTML($inputFile, $outputFile);
                } elseif (isset($_POST['convertFileFromHTML'])) {
                    convertFileFromHTML($inputFile, $outputFile);
                }

                if (file_exists($outputFile)) {
                    echo "<h3>Результат перетворення:</h3>";
                    echo "<div class='converted-text'>" . htmlspecialchars(file_get_contents($outputFile)) . "</div>";
                    echo "<a href='$outputFile' download>Завантажити результат</a>";
                }
            }
            ?>
        </section>
    </main>
</body>
</html>
