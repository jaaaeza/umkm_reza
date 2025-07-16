<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT username, role FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username, $role);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username']);
    $new_role = $_POST['role'];
    $new_password = $_POST['password'];

    if (!empty($new_password)) {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $update->bind_param("sssi", $new_username, $hashed, $new_role, $id);
    } else {
        $update = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $update->bind_param("ssi", $new_username, $new_role, $id);
    }

    if ($update->execute()) {
        header("Location: crud_user.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Edit User</h2>
<form method="post">
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required><br>
    <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"><br>
    <select name="role">
        <option value="user" <?= $role == 'user' ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= $role == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br>
    <button type="submit">Simpan</button>
</form>
<a href="crud_user.php">Kembali</a>
</body>
</html>