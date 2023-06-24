<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}
include('db.php');
$selectQuery = 'SELECT * FROM users WHERE id = ' . $_SESSION['user_id'];
$result = $conn->query($selectQuery);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心
</title>
</head>
<body>
    <form action="updateProfile.php" method="POST">
        <fieldset>
            <legend>個人資料：</legend>
            <label for="username">使用者名稱：</label>
            <input type="text" id="username" name="username" value="<?= $row['username'] ?>" disabled><br><br>
            <label for="phone">電話號碼：</label>
            <input type="text" id="phone" name="phone" value="<?= $row['phone'] ?>"><br><br>
            <label for="custom1">客製欄位1：</label>
            <input type="text" id="custom1" name="custom1" value="<?= $row['custom1'] ?>"><br><br>
            <label for="custom2">客製欄位2：</label>
            <input type="text" id="custom2" name="custom2" value="<?= $row['custom2'] ?>"><br><br>
            <fieldset>
                <legend>修改密碼（如無須修改請留空）</legend>
                <label for="currentPassword">目前密碼：</label>
                <input type="password" id="currentPassword" name="currentPassword"><br><br>
                <label for="newPassword">新密碼：</label>
                <input type="password" id="newPassword" name="newPassword"><br><br>
                <label for="confirmPassword">新密碼確認：</label>
                <input type="password" id="confirmPassword" name="confirmPassword"><br>
            </fieldset><br>
            <input type="submit" value="更新會員資料">
        </fieldset>
    </form>
    <a href="./logout.php">登出</a>
</body>
</html>