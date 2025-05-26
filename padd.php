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

// Proses tambah data buku
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $stok = (int)$_POST['stok'];

    try {
        $stmt = $pdo->prepare("INSERT INTO buku (judul, pengarang, penerbit, stok) VALUES (?, ?, ?, ?)");
        $stmt->execute([$judul, $pengarang, $penerbit, $stok]);

        header("Location: pindex.php?success=add");
        exit;
    } catch (PDOException $e) {
        $error = "Gagal menambahkan buku: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        button, a.btn-secondary {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #28a745;
            color: white;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
        .error {
            background-color: #f8d7da;
            padding: 10px;
            border: 1px solid #f5c6cb;
            color: #721c24;
            margin-bottom: 20px;
            border-radius: 6px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-bottom: 15px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="pindex.php" class="back-link">← Kembali ke Daftar Buku</a>
        <h2>📘 Tambah Buku Baru</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="judul">Judul Buku:</label>
                <input type="text" id="judul" name="judul" required maxlength="255">
            </div>

            <div class="form-group">
                <label for="pengarang">Pengarang:</label>
                <input type="text" id="pengarang" name="pengarang" required maxlength="255">
            </div>

            <div class="form-group">
                <label for="penerbit">Penerbit:</label>
                <input type="text" id="penerbit" name="penerbit" required maxlength="255">
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" required min="0" max="9999">
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-primary">💾 Simpan Buku</button>
                <a href="pindex.php" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
