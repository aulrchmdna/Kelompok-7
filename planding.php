<?php
session_start();

// Database connection for checking login state
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

// Check login status
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang di Perpustakaan Digital</title>
    <style>
        /* Reset & base */
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }
        
        body {
            background: url('login2.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        header {
            padding: 1rem 2rem;
            background-color: rgba(0,0,0,0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            transition: background-color 0.3s ease;
        }
        header:hover {
            background-color: rgba(0,0,0,0.5);
        }
        header h1 {
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 0.05em;
        }
        nav a {
            color: #f5f5f5;
            text-decoration: none;
            margin-left: 1rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }
        main h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
            font-family: 'Playfair Display', serif;
            animation: slideIn 1s ease forwards;
            opacity: 0;
            transform: translateY(-20px);
        }
        @keyframes slideIn {
            to { opacity: 1; transform: translateY(0); }
        }
        main p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            line-height: 1.5;
            max-width: 600px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.5);
            animation: fadeIn 1s ease forwards;
            opacity: 0;
            animation-delay: 0.5s;
        }
        main a.button {
            background-color: rgb(170, 98, 11);
            color: #fff;
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(255,140,0,0.5);
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        main a.button:hover {
            background-color: #ffa733;
            transform: scale(1.05);
        }
        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: rgba(0,0,0,0.2);
            font-size: 0.9rem;
            color: #ddd;
            transition: background-color 0.3s ease;
        }
        footer:hover {
            background-color: rgba(0,0,0,0.3);
        }
        @media (max-width:600px) {
            main h2 { font-size: 2rem; }
            main p { font-size: 1rem; }
            header h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Perpustakaan Digital</h1>
        <nav>
            <?php if ($loggedIn): ?>
                <a href="pindex.php">Dashboard</a>
                <a href="plogin.php?logout=1">Logout (<?=htmlspecialchars($_SESSION['user'])?>)</a>
            <?php else: ?>
                <a href="plogin.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <h2>Selamat Datang di Perpustakaan Digital</h2>
        <p>Kelola koleksi buku, pinjam, dan kembalikan buku dengan mudah melalui aplikasi perpustakaan kami. Nikmati pengalaman membaca yang modern dan terorganisir dengan baik.</p>
        <?php if ($loggedIn): ?>
            <a class="button" href="pindex.php">Masuk ke Dashboard</a>
        <?php else: ?>
            <a class="button" href="plogin.php">Mulai Sekarang</a>
        <?php endif; ?>
    </main>

    <footer>
        &copy; <?= date('Y') ?> Perpustakaan Digital. All rights reserved.
    </footer>
</body>
</html>
