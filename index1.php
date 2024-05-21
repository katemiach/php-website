<?php
class WebPage {
    public function getStyles() {
        return '
            <style>
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
                background-color: white;
                border-radius: 20px;
                transition: color 0.3s, background-color 0.3s;
                padding: 5px;
                font-family: Comic Sans MS; 
            }
            nav a:hover {
                color: yellow;
                background-color: black;
            }
            .banner {
                margin-top: 20px; 
                width: 1100px; 
                height: auto;
                margin-left: auto;
                margin-right: auto;
                display: block;
            }  
            .shop-description {
                font-size: 28px; 
                margin-top: 100px;
                margin-bottom: -100px;
                text-align: center;
                color: black;
                font-family: Comic Sans MS; 
            }
            .container {
                display: flex;
                justify-content: center;
            }
            .sidebar {
                width: 200px;
                padding: 20px;
                margin-top: 200px;
            }
            .main-content {
                flex-grow: 1;
                padding: 20px;
                margin-top: 200px;
            }
            .sidebar ul {
                list-style: none;
                padding: 0;
            }
            .sidebar ul li {
                margin-bottom: 10px;
            }
            .sidebar ul li a {
                display: block;
                text-decoration: none;
                color: black;
                font-family: Comic Sans MS;
                font-weight: bold;
                background-color: white;
                border-radius: 20px;
                transition: color 0.3s, background-color 0.3s;
                padding: 5px; 
                font-size: 18px;
            }
            .sidebar ul li a:hover {
                color: #BCBCBC;
            }
            .sidebar ul li a.active {
                color:  #BCBCBC; 
            }
            .products {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            .product {
                width: calc(25% - 20px); 
                margin: 10px;
                padding: 20px;
                background-color: white;
                text-align: center;
                color: black;
                border-radius: 20px;
                font-size: 18px;
                font-family: Arial;
                transition: color 0.3s, background-color 0.3s;
                text-decoration: none;
            }
            .product:hover {
                background-color: #FBF076;
            }
            .footer {
                height: 300px;
                padding-top: 100px; 
                padding-bottom: 20px; 
                text-align: center; 
                background-color: #F6F6F6;
            }
            .footer-info {
                font-size: 26px;
                font-family: Arial;
                font-weight: bold;
            }
            .footer-info-adress {
                font-size: 18px;
                font-family: Arial;
            }
            .footer img {
                width: 50px; 
                height: auto;
            }
            #myChart {
                max-width: 600px;
                margin: 20px auto;
            }
            .chat-icon {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 70px;
                height: 70px;
                background-color: #FFCC00; 
                color: #333; 
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                font-size: 30px;
            }
            .chat-container {
                position: fixed;
                bottom: 100px;
                right: 20px;
                width: 300px;
                max-height: 500px;
                background-color: white;
                border: 2px solid #FFCC00; 
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                display: none;
                flex-direction: column;
                overflow: hidden;
            }
            .chat-header {
                background-color: #FFCC00; 
                color: #333;
                padding: 10px;
                text-align: center;
                font-weight: bold;
            }
            .chat-messages {
                flex-grow: 1;
                padding: 10px;
                overflow-y: auto;
                background-color: #f9f9f9;
            }
            .chat-input {
                display: flex;
                flex-direction: column;
                border-top: 2px solid #FFCC00; 
                padding: 10px;
                background-color: #fff;
            }
            .chat-input input {
                border: 2px solid #FFCC00; 
                padding: 10px;
                font-size: 16px;
                margin-bottom: 10px;
                border-radius: 5px;
            }
            .chat-input button {
                border: none;
                background-color: #FFCC00; 
                color: #333;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 5px;
                font-weight: bold;
            }
            .message {
                padding: 10px;
                margin: 5px 0;
                border-radius: 10px;
                background-color: #FFFAE6; 
                width: fit-content;
                max-width: 80%;
            }
            .timestamp {
                font-size: 0.8em;
                color: #888;
                margin-top: 5px;
            }
            </style>
        ';
    }

    public function __construct() {
        $this->category = 'box'; 
    }

    public function displayHeader() {
        ?>
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
        <?php
    }

    public function displayBanner() {
        echo "<img src='img/banner1.jpg' class='banner'>";
    }

    public function displayDescription() {
        ?>
        <p class="shop-description">Насолода у кожній дрібниці:</p>
        <p class="shop-description">унікальні товари для дому та красиві вироби від магазину EcoBeeShop.</p>
        <?php
    }

    public function displaySidebar($category) {
        ?>
        <div class="sidebar">
            <ul>
                <li><a href="?category=all" <?php if($category == 'all') echo 'class="active"'; ?>>Всі</a></li>
                <li><a href="?category=box" <?php if($category == 'box') echo 'class="active"'; ?>>Подарунковий набір</a></li>
                <li><a href="?category=candle" <?php if($category == 'candle') echo 'class="active"'; ?>>Свічки</a></li>
            </ul>
        </div>
        <?php
    }

    public function displayProducts($category) {
        ?>
        <div class="products">
            <?php
            switch ($category) {
                case 'all':
                    echo '<a href="product.php?id=1" class="product">';
                    echo '<img src="1.jpg" width="220" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Свічка з вощини, 13 см х 4,5 см</span><br><br>';
                    echo '80 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=2" class="product">';
                    echo '<img src="2.jpg" width="220" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Набір свічок (4 шт), 13 см х 4,5 см</span><br><br>';
                    echo '350 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=3" class="product">';
                    echo '<img src="3.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Подарунковий набір (свічка+пилок+мед)</span><br><br>';
                    echo '550 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=4" class="product">';
                    echo '<img src="4.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Подарунковий набір (пилок+мед)</span><br><br>';
                    echo '650 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=5" class="product">';
                    echo '<img src="5.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Свічка з вощини, 6,5 см х 4,5 см</span><br><br>';
                    echo '65 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=6" class="product">';
                    echo '<img src="6.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Набір свічок (2 шт), 13 см х 4,5 см</span><br><br>';
                    echo '170 грн';
                    echo '</a>';
                    break;
                case 'box':
                    echo '<a href="product.php?id=2" class="product">';
                    echo '<img src="2.jpg" width="220" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Набір свічок (4 шт), 13 см х 4,5 см</span><br><br>';
                    echo '350 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=3" class="product">';
                    echo '<img src="3.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Подарунковий набір (свічка+пилок+мед)</span><br><br>';
                    echo '550 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=4" class="product">';
                    echo '<img src="4.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Подарунковий набір (пилок+мед)</span><br><br>';
                    echo '650 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=6" class="product">';
                    echo '<img src="6.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Набір свічок (2 шт), 13 см х 4,5 см</span><br><br>';
                    echo '170 грн';
                    echo '</a>';
                    break;
                case 'candle':
                    echo '<a href="product.php?id=1" class="product">';
                    echo '<img src="1.jpg" width="220" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Свічка з вощини, 13 см х 4,5 см</span><br><br>';
                    echo '80 грн';
                    echo '</a>';
                    echo '<a href="product.php?id=5" class="product">';
                    echo '<img src="5.jpg" width="200" height="250"><br><br>';
                    echo '<span style="font-family: Arial, sans-serif; font-weight: bold;">Свічка з вощини, 6,5 см х 4,5 см</span><br><br>';
                    echo '65 грн';
                    echo '</a>';
                    break;
                default:
                    echo 'Виберіть категорію';
                    break;
            }
            ?>
        </div>
        <?php
    }

    public function displayFooter() {
        ?>
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-content">
                    <div class="socials">
                        <a href="https://www.etsy.com/shop/EcoBeeShop"><img src="etsy.png"></a>
                        <a href="https://www.facebook.com/profile.php?id=100075163906258"><img src="facebook.png"></a>
                        <a href="https://www.instagram.com/podarochki_ot_pchelki?igsh=Y2V1anYyMWw2MHFo"><img src="instagram.png"></a>
                    </div>
                    <div class="footer-info">
                        <p>Зроби замовлення та <br>насолоджуйся товарами з <br>EcoBeeShop</p>
                    </div>
                    <div class="footer-info-adress">
                        <p>Кривий Ріг, Площа Визволення, 15</p>
                        <p>Телефон: +380662788132</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }
}

class SpecialWebPage extends WebPage {
    public function displayHeader() {
        ?>
        <header>
            <nav>
                <div class="logo">
                    <a href="index1.php">EcoBeeShop</a>
                </div>
                <ul>
                    <li><a href="product.php">Товари</a></li>
                    <li><a href="new.php">Новинки</a></li>
                    <li><a href="sale.php">Розпродаж</a></li>
                    <li><a href="basket.php">Кошик</a></li>
                    <li><a href="user.php">Вхід</a></li>
                </ul>
            </nav>
        </header>
        <?php
    }
}

$page = new WebPage();
$category = isset($_GET['category']) ? $_GET['category'] : 'box';
$specialPage = new SpecialWebPage();
$page->displayHeader();
$page->displayBanner();
$page->displayDescription();
$page->displaySidebar($category);
$page->displayProducts($category);
$page->displayFooter();
?>

<?php
session_start();

$filename = 'visitors.txt';

function getVisitorData() {
    global $filename;
    if (!file_exists($filename)) {
        $data = ['visits' => 0, 'unique' => [], 'date' => date("Y-m-d")];
    } else {
        $data = json_decode(file_get_contents($filename), true);
        if ($data['date'] !== date("Y-m-d")) {
            $data = ['visits' => 0, 'unique' => [], 'date' => date("Y-m-d")];
        }
    }
    return $data;
}

function saveVisitorData($data) {
    global $filename;
    if (isset($data['unique']['::1'])) {
        unset($data['unique']['::1']);
    }
    if (isset($data['unique']['0'])) {
        unset($data['unique']['0']);
    }
    file_put_contents($filename, json_encode($data));
}

$data = getVisitorData();
$ip = $_SERVER['REMOTE_ADDR'];

if ($ip == '::1' || $ip == '0:0:0:0:0:0:0:1') {
    $ip = '127.0.0.1';
}

if (!isset($data['unique'][$ip])) {
    $data['unique'][$ip] = 0;
}

$data['unique'][$ip]++;
$data['visits']++;

saveVisitorData($data);

$hosts = count($data['unique']);
$hits = $data['visits'];

if (isset($data['unique']['::1'])) {
    unset($data['unique']['::1']);
}
if (isset($data['unique']['0'])) {
    unset($data['unique']['0']);
}

echo '<style>
        .statistics {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 15px;
            width: fit-content;
            margin: 20px auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .statistics p {
            font-size: 16px;
            color: #555;
        }
        .statistics strong {
            color: #000;
        }
        .ip-list {
            margin-top: 20px;
        }
        .ip-list li {
            font-size: 14px;
            color: #333;
        }
    </style>';

echo "<div class='statistics'>";
echo "<p><strong>Кількість унікальних відвідувачів:</strong> $hosts</p>";
echo "<p><strong>Загальна кількість відвідувань:</strong> $hits</p>";
echo "</div>";

echo "<div class='statistics ip-list'>";
echo "<strong>IP-адреси та кількість їхніх відвідувань:</strong>";
echo "<ul>";
foreach ($data['unique'] as $ip => $visits) {
    if ($ip == '::1' || $ip == '0') {
        continue;
    }
    echo "<li>$ip: $visits відвідувань</li>";
}
echo "</ul>";
echo "</div>";
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBeeShop</title>
    <link rel="icon" href="img/809052.ico">
    <?php echo $page->getStyles(); ?> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="400" style="margin-top: 20px;"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Унікальні відвідувачі', 'Загальна кількість відвідувань'],
                datasets: [{
                    label: 'Кількість відвідувань',
                    data: [<?= $hosts ?>, <?= $hits ?>],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <div class="chat-icon" id="chat-icon">&#x1F4AC;</div>
    <div class="chat-container" id="chat-container">
        <div class="chat-header">Чат</div>
        <div id="chat-messages" class="chat-messages"></div>
        <form id="chat-form" class="chat-input">
            <input type="text" id="user-name" placeholder="Ваше ім'я" required>
            <input type="text" id="user-input" placeholder="Напишіть повідомлення..." required>
            <button type="submit">Надіслати</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ws = new WebSocket('ws://localhost:8080');
            const chatMessages = document.getElementById('chat-messages');
            const chatIcon = document.getElementById('chat-icon');
            const chatContainer = document.getElementById('chat-container');

            const storedMessages = JSON.parse(localStorage.getItem('chatMessages')) || [];
            storedMessages.forEach(message => {
                appendMessage(message);
            });

            ws.onmessage = event => {
                console.log("Raw message received:", event.data);
                try {
                    const message = JSON.parse(event.data);
                    console.log("Parsed message received:", message);
                    appendMessage(message);
                    storeMessage(message);
                } catch (e) {
                    console.error("Error parsing message:", e);
                }
            };

            ws.onopen = () => {
                console.log("WebSocket connection established.");
            };

            ws.onerror = error => {
                console.error("WebSocket error:", error);
            };

            ws.onclose = () => {
                console.log("WebSocket connection closed.");
            };

            document.getElementById('chat-form').onsubmit = e => {
                e.preventDefault();
                const userName = document.getElementById('user-name').value;
                const userInput = document.getElementById('user-input').value;
                if (!userName || !userInput) {
                    alert('Please enter both a name and a message.');
                    return;
                }
                const message = {
                    user: userName,
                    text: userInput,
                    date: new Date().toLocaleString()
                };
                console.log("Sending message:", message);
                ws.send(JSON.stringify(message));
                document.getElementById('user-input').value = '';
                appendMessage(message);  // Отображаем сообщение немедленно
            };

            chatIcon.onclick = () => {
                chatContainer.style.display = chatContainer.style.display === 'flex' ? 'none' : 'flex';
            };

            function appendMessage(message) {
                if (!message.user || !message.text) {
                    console.error('Invalid message format:', message);
                    return;
                }
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message');
                messageDiv.innerHTML = `<strong>${message.user}:</strong> ${message.text} <div class="timestamp">${message.date}</div>`;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function storeMessage(message) {
                const messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
                messages.push(message);
                localStorage.setItem('chatMessages', JSON.stringify(messages));
            }
        });
    </script>
</body>
</html>
