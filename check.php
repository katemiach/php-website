<?php
// Перевірка автомобільного номера
function validateCarNumber($number) {
    $regions = [
        'AA' => 'Київ',
        'AB' => 'Вінницька область',
        'AE' => 'Дніпропетровська область',
        'AH' => 'Донецька область',
        'AI' => 'Житомирська область',
        'AK' => 'Закарпатська область',
        'AM' => 'Запорізька область',
        'AO' => 'Івано-Франківська область',
        'AP' => 'Київська область',
        'AT' => 'Кіровоградська область',
        'AX' => 'Львівська область',
        'BA' => 'Миколаївська область',
        'BB' => 'Одеська область',
        'BC' => 'Полтавська область',
        'BE' => 'Рівненська область',
        'BH' => 'Сумська область',
        'BI' => 'Тернопільська область',
        'BK' => 'Харківська область',
        'BM' => 'Херсонська область',
        'BO' => 'Хмельницька область',
        'BT' => 'Черкаська область',
        'BX' => 'Чернігівська область',
        'CA' => 'Чернівецька область'
    ];

    if (preg_match('/^[A-Z]{2} \d{4} [A-Z]{2}$/', $number, $matches)) {
        $regionCode = substr($number, 0, 2);
        if (isset($regions[$regionCode])) {
            return "Автомобільний номер правильний. Область: " . $regions[$regionCode];
        } else {
            return "Автомобільний номер правильний, але область не визначена.";
        }
    } else {
        return "Автомобільний номер неправильний.";
    }
}

// Перевірка поштового індексу
function validatePostalCode($code) {
    $postalCodes = [
        '01000' => 'Київ',
        '21000' => 'Вінницька область',
        '49000' => 'Дніпропетровська область',
        '83000' => 'Донецька область',
        '10000' => 'Житомирська область',
        '88000' => 'Закарпатська область',
        '69000' => 'Запорізька область',
        '76000' => 'Івано-Франківська область',
        '07000' => 'Київська область',
        '25000' => 'Кіровоградська область',
        '79000' => 'Львівська область',
        '54000' => 'Миколаївська область',
        '65000' => 'Одеська область',
        '36000' => 'Полтавська область',
        '33000' => 'Рівненська область',
        '40000' => 'Сумська область',
        '46000' => 'Тернопільська область',
        '61000' => 'Харківська область',
        '73000' => 'Херсонська область',
        '29000' => 'Хмельницька область',
        '18000' => 'Черкаська область',
        '14000' => 'Чернігівська область',
        '58000' => 'Чернівецька область'
    ];

    if (preg_match('/^\d{5}$/', $code, $matches)) {
        if (isset($postalCodes[$code])) {
            return "Поштовий індекс правильний. Область: " . $postalCodes[$code];
        } else {
            return "Поштовий індекс правильний, але область не визначена.";
        }
    } else {
        return "Поштовий індекс неправильний.";
    }
}

// Визначення дня тижня
function getDayOfWeek($day, $month, $year) {
    $daysOfWeek = [
        'Monday' => 'Понеділок',
        'Tuesday' => 'Вівторок',
        'Wednesday' => 'Середа',
        'Thursday' => 'Четвер',
        'Friday' => 'П’ятниця',
        'Saturday' => 'Субота',
        'Sunday' => 'Неділя'
    ];

    if (checkdate($month, $day, $year)) {
        $date = new DateTime("$year-$month-$day");
        $dayOfWeek = $date->format('l');
        return $daysOfWeek[$dayOfWeek];
    } else {
        return "Невірна дата.";
    }
}

// Видати код кольору в шістнадцятковому форматі відповідно до його імені
function getColorHexCode($colorName) {
    $colors = [
        'червоний' => '#FF0000',
        'зелений' => '#00FF00',
        'синій' => '#0000FF',
        'білий' => '#FFFFFF',
        'чорний' => '#000000',
        'жовтий' => '#FFFF00',
        'фіолетовий' => '#800080',
        'помаранчевий' => '#FFA500',
        'рожевий' => '#FFC0CB',
        'коричневий' => '#A52A2A'
    ];

    $colorNameLower = mb_strtolower($colorName, 'UTF-8'); // Зробити ім'я кольору нижнім регістром для порівняння

    if (isset($colors[$colorNameLower])) {
        return "Код кольору для $colorName: " . $colors[$colorNameLower];
    } else {
        return "Код кольору для $colorName не знайдено.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Перевірка дня тижня
    if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
        $day = intval($_GET['day']);
        $month = intval($_GET['month']);
        $year = intval($_GET['year']);
        $dayOfWeek = getDayOfWeek($day, $month, $year);
    }
}
// Обчислення відстані між двома точками за формулою Haversine
function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // радіус Землі у кілометрах

    // Перетворення градусів у радіани
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Формула Haversine
    $dLat = $lat2 - $lat1;
    $dLon = $lon2 - $lon1;
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos($lat1) * cos($lat2) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Відстань у кілометрах
    $distance = $earthRadius * $c;

    return $distance;
}

// Витягування координат за допомогою регулярних виразів
function extractCoordinates($input) {
    $pattern = '/^\s*(-?\d+(?:\.\d+)?)\s*[,:\s]\s*(-?\d+(?:\.\d+)?)\s*$/';
    if (preg_match($pattern, $input, $matches)) {
        $latitude = $matches[1];
        $longitude = $matches[2];
        return [$latitude, $longitude];
    } else {
        return [null, null];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['coordinates1']) && isset($_POST['coordinates2'])) {
    list($lat1, $lon1) = extractCoordinates($_POST['coordinates1']);
    list($lat2, $lon2) = extractCoordinates($_POST['coordinates2']);

    if ($lat1 !== null && $lon1 !== null && $lat2 !== null && $lon2 !== null) {
        $distance = calculateDistance($lat1, $lon1, $lat2, $lon2);
        $distanceMessage = "Відстань між точками: " . round($distance, 2) . " км.";
    } else {
        $distanceMessage = "Неправильний формат координат.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перевірка номерів та індексів</title>
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
        form input, form button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            background-color: #ffcc00;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #e6b800;
        }
        .result {
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
        <section id="check-section">
            <h2>Перевірка автомобільного номера та поштового індексу</h2>
            <form action="" method="POST">
                <input type="text" name="carNumber" placeholder="Введіть автомобільний номер" required>
                <button type="submit" name="checkCarNumber">Перевірити номер</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkCarNumber'])) {
                $carNumber = $_POST['carNumber'];
                $result = validateCarNumber($carNumber);
                echo "<h3>Результат перевірки автомобільного номера:</h3>";
                echo "<div class='result'>" . htmlspecialchars($result) . "</div>";
            }
            ?>

            <form action="" method="POST">
                <input type="text" name="postalCode" placeholder="Введіть поштовий індекс" required>
                <button type="submit" name="checkPostalCode">Перевірити індекс</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkPostalCode'])) {
                $postalCode = $_POST['postalCode'];
                $result = validatePostalCode($postalCode);
                echo "<h3>Результат перевірки поштового індексу:</h3>";
                echo "<div class='result'>" . htmlspecialchars($result) . "</div>";
            }
            ?>
        </section>
        <section id="date-section">
            <h2>Визначення дня тижня</h2>
            <form action="" method="GET">
                <input type="number" name="day" placeholder="День" required>
                <input type="number" name="month" placeholder="Місяць" required>
                <input type="number" name="year" placeholder="Рік" required>
                <button type="submit">Визначити день тижня</button>
            </form>
            <?php
            if (isset($dayOfWeek)) {
                echo "<h3>Результат визначення дня тижня:</h3>";
                echo "<div class='result'>" . htmlspecialchars($dayOfWeek) . "</div>";
            }
            ?>
        </section>
        <section id="color-section">
            <h2>Перевірка коду кольору</h2>
            <form action="" method="POST">
                <input type="text" name="colorName" placeholder="Введіть ім'я кольору" required>
                <button type="submit" name="checkColor">Перевірити колір</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkColor'])) {
                $colorName = $_POST['colorName'];
                $result = getColorHexCode($colorName);
                echo "<h3>Результат перевірки кольору:</h3>";
                echo "<div class='result'>" . htmlspecialchars($result) . "</div>";
            }
            ?>
        </section>
        <section id="distance-section">
            <h2>Обчислення відстані між двома точками</h2>
            <form action="" method="POST">
                <input type="text" name="coordinates1" placeholder="Введіть перші координати (широта, довгота)" required>
                <input type="text" name="coordinates2" placeholder="Введіть другі координати (широта, довгота)" required>
                <button type="submit">Обчислити відстань</button>
            </form>
            <?php
            if (isset($distanceMessage)) {
                echo "<h3>Результат обчислення відстані:</h3>";
                echo "<div class='result'>" . htmlspecialchars($distanceMessage) . "</div>";
            }
            ?>
        </section>
    </main>
</body>
</html>
