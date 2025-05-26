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

// Proses update data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $stok = (int)$_POST['stok'];
    
    try {
        $stmt = $pdo->prepare("UPDATE buku SET judul = ?, pengarang = ?, penerbit = ?, stok = ? WHERE id = ?");
        $stmt->execute([$judul, $pengarang, $penerbit, $stok, $id]);
        
        header("Location: pindex.php?success=update");
        exit;
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Ambil data buku berdasarkan ID
if (!isset($_GET['id'])) {
    header("Location: pindex.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->execute([$id]);
$buku = $stmt->fetch();

if (!$buku) {
    die('Buku tidak ditemukan!');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - <?= htmlspecialchars($buku['judul']) ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        button, .btn-secondary {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            display: inline-block;
            text-align: center;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="pindex.php" class="back-link">← Kembali ke Daftar Buku</a>
        
        <h2>✏️ Edit Buku</h2>
        
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($buku['id']) ?>">
            
            <div class="form-group">
                <label for="judul">Judul Buku:</label>
                <input type="text" id="judul" name="judul" 
                       value="<?= htmlspecialchars($buku['judul']) ?>" 
                       required maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="pengarang">Pengarang:</label>
                <input type="text" id="pengarang" name="pengarang" 
                       value="<?= htmlspecialchars($buku['pengarang']) ?>" 
                       required maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="penerbit">Penerbit:</label>
                <input type="text" id="penerbit" name="penerbit" 
                       value="<?= htmlspecialchars($buku['penerbit']) ?>" 
                       required maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" 
                       value="<?= htmlspecialchars($buku['stok']) ?>" 
                       required min="0" max="9999">
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
                <a href="pindex.php" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
