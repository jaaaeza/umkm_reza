<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: user/dashboard_user.php");
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pengguna</title>
</head>
<body>
<h2>Halo, <?= htmlspecialchars($username) ?>!</h2>
<p>Ini adalah halaman khusus pengguna biasa.</p>

<a href="index.php">Keluar</a> |
<a href="logout.php">Logout</a>
</body>
</html>