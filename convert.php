<?php
require_once 'src/Convert/TextConverter.php';
require_once 'src/Pages/WebPage.php';

use Convert\TextConverter;
use Pages\WebPage;

$page = new WebPage();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перетворення тексту</title>
    <link rel="icon" href="img/809052.ico">
    <?php echo $page->getStyles(); ?>
</head>
<body>
    <?php
    $page->displayHeader();
    ?>
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
                    $convertedText = TextConverter::convertToHTML($inputText);
                    echo "<h3>Перетворено в HTML:</h3>";
                    echo "<div class='converted-text'>" . htmlspecialchars($convertedText) . "</div>";
                } elseif (isset($_POST['fromHTML'])) {
                    $convertedText = TextConverter::convertFromHTML($inputText);
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
                    TextConverter::convertFileToHTML($inputFile, $outputFile);
                } elseif (isset($_POST['convertFileFromHTML'])) {
                    TextConverter::convertFileFromHTML($inputFile, $outputFile);
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
    <?php
    $page->displayFooter();
    ?>
</body>
</html>
