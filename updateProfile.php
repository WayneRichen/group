<?php
session_start();
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $phone = $_POST["phone"];
    $custom1 = $_POST["custom1"];
    $custom2 = $_POST["custom2"];

    if (!empty($currentPassword) && !empty($newPassword) && !empty($confirmPassword)) {
        if ($newPassword !== $confirmPassword) {
            echo "<script>alert('新密碼與確認密碼不一致！'); window.location.replace('profile.php');</script>";
        } else {
            $selectQuery = 'SELECT * FROM users WHERE id = ' . $_SESSION['user_id'];
            $result = $conn->query($selectQuery);
            $row = $result->fetch_assoc();
            if (!password_verify($currentPassword, $row['password'])) {
                echo "<script>alert('新密碼與舊密碼不一致！'); window.location.replace('profile.php');</script>";
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = ?, phone = ?, custom1 = ?, custom2 = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssi", $hashedPassword, $phone, $custom1, $custom2, $_SESSION['user_id']);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                echo "<script>alert('資料更新成功！'); window.location.replace('profile.php');</script>";
            }
        }
    } else {
        $sql = "UPDATE users SET phone = ?, custom1 = ?, custom2 = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $phone, $custom1, $custom2, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        echo "<script>alert('資料更新成功！'); window.location.replace('profile.php');</script>";
    }
}