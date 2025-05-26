<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Dashboard</h2>
    <p>Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>!</p>

    <?php if ($role === 'admin'): ?>
        <h3>Admin Menu</h3>
        <ul>
            <li><a href="pedit.php">Edit Katalog Buku</a></li>
            <li><a href="pdelete.php">Hapus Katalog Buku</a></li>
            <li><a href="padd.php">Tambah Buku</a></li>
        </ul>
    <?php else: ?>
        <h3>User Menu</h3>
        <ul>
            <li><a href="view_catalog.php">Lihat Katalog Buku</a></li>
            <li><a href="borrow.php">Pinjam Buku</a></li>
            <li><a href="return.php">Kembalikan Buku</a></li>
        </ul>
    <?php endif; ?>
    
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
