<?php
session_start();
if(isset($_POST['buy'])) {
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    if (!isset($_SESSION['basket'][$item])) {
        $_SESSION['basket'][$item] = 0;
    }
    $_SESSION['basket'][$item] += $quantity;

    header("Location: basket.php"); // Перенаправлення на сторінку кошика після додавання
    exit;
}
?>