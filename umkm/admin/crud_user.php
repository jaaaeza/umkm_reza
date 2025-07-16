<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$result = $conn->query("SELECT id, username, role FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Daftar User</h2>
<table>
    <tr>
        <th>ID</th><th>Username</th><th>Role</th><th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= $row['role'] ?></td>
        <td>
            <a href="edit_user.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">Kembali</a>
</body>
</html>