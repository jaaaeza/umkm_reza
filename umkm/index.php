<?php
session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"]["role"] == "admin") {
        header("Location: admin/dashboard_admin.php");
    } else {
        header("Location: user/dashboard_user.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Selamat Datang di Aplikasi CRUD PHP</h1>
    <p>Silakan login atau register untuk melanjutkan.</p>
    <a href="login.php">Login</a> | <a href="register.php">Register</a>
</body>
</html>
