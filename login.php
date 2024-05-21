<?php
require 'database.php';

session_start(); 

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/', $email);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!validateEmail($email)) {
        echo "Invalid email format.";
        exit;
    }

    $db = new Database();
    $conn = $db->getConnection();

    try {
        $user = $db->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['user_email'] = $user['email']; 
            echo "Login successful.";
            header('Location: profile.php'); 
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $db->closeConnection();
}
?>
































