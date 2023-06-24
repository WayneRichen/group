<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $phone = $_POST['phone'];
    $custom1 = $_POST['custom1'];
    $custom2 = $_POST['custom2'];
    $selectQuery = 'SELECT * FROM users WHERE username = ?';
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $checkResult = $stmt->get_result();
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('該帳號已被使用，請選擇其他帳號。'); window.location.replace('register.html');</script>";
    } else {
        if ($password != $confirmPassword) {
            echo "<script>alert('輸入的兩次密碼不同，請再試一次。'); window.location.replace('register.html');</script>";
            exit;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (username, password, phone, custom1, custom2) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $username, $hashedPassword, $phone, $custom1, $custom2);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            $stmt->close();
            $conn->close();
            echo "<script>alert('註冊成功'); window.location.replace('profile.php');</script>";
        } else {
            echo "<script>alert('註冊失敗'); window.location.replace('register.html');</script>";
        }
    }
}