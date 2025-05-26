<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $name     = $_POST['name'] ?? '';

    if (strlen($username) < 3 || strlen($password) < 5 || empty($name)) {
        $errorRegister = "Lengkapi semua kolom dengan benar (username min 3 karakter, password min 5 karakter).";
    } else {
        // Cek apakah username sudah terdaftar
        $stmt = $pdo->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->execute([$username]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            $errorRegister = "Username sudah terdaftar.";
        } else {
            // Hash password dan simpan user baru
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO login (username, password, name, status) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$username, $hashedPassword, $name]);

            header('Location: plogin.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('login5.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Playfair Display', serif;
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .container {
            width: 500px;
            padding: 2rem;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.54);
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes slideIn { to { opacity: 1; transform: translateY(0); } }
        .error {
            color: red;
            margin-bottom: 1rem;
            text-align: center;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .btn-brown {
            background-color: rgba(139, 69, 19, 0.74);
            color: white;
        }
        .btn-brown:hover {
            background-color: #A0522D;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Daftar Akun Perpustakaan Digital</h2>
    <?php if (isset($errorRegister)): ?>
        <p class="error"><?= htmlspecialchars($errorRegister) ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="name">Nama Lengkap:</label>
            <input type="text" id="name" name="name" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-brown btn-block">Daftar</button>
        <p class="mt-3 text-center">
            Sudah punya akun? <a href="plogin.php">Login sekarang</a>
        </p>
    </form>
</div>
</body>
</html>
