<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin/dashboard_admin.php");
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Selamat Datang, Admin <?= htmlspecialchars($username) ?></h2>

<ul>
    <li><a href="crud_user.php">Kelola Pengguna</a></li>
    <li><a href="dashboard.php">Kembali ke Dashboard Umum</a></li>
</ul>

<a href="logout.php">Logout</a>
</body>
</html>
