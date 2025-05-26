<?php
session_start();

// Konfigurasi database
$host = 'localhost';
$db   = 'perpustakaan';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Koneksi database gagal: ' . $e->getMessage());
}

// Tangani login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $pdo->prepare("SELECT * FROM login WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $row = $stmt->fetch();

    if ($row && password_verify($password, $row['password'])) {
        // Simpan sesi login
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['status'] = strtolower(trim($row['status'])); // Normalisasi status

        // Arahkan berdasarkan status
        if ($_SESSION['status'] === 'admin') {
            header("Location: pindex.php"); // Halaman admin
        } elseif ($_SESSION['status'] === 'user' || $_SESSION['status'] === 'member') {
            header("Location: buku_populer.php"); // Halaman buku populer
        } else {
            $errorLogin = "Status tidak dikenali.";
        }
        exit();
    } else {
        $errorLogin = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles here */
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Login Perpustakaan Digital</h2>
    <?php if (isset($errorLogin)): ?>
        <p class="error"><?= htmlspecialchars($errorLogin) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required autofocus />
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-brown btn-block">Login</button>
        <p class="mt-3 text-center">
            Belum punya akun? <a href="pregister.php" class="link-daftar">Daftar sekarang</a>
        </p>
    </form>
</div>
</body>
</html>
