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

// Proses tambah data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $stok = (int)$_POST['stok'];
    
    // Validasi input
    if (empty($judul) || empty($pengarang) || empty($penerbit) || $stok < 0) {
        $error = "Semua field harus diisi dengan benar!";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO buku (judul, pengarang, penerbit, stok) VALUES (?, ?, ?, ?)");
            $stmt->execute([$judul, $pengarang, $penerbit, $stok]);
            
            header("Location: pindex.php?success=add");
            exit;
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru - Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 2px rgba(40,167,69,0.25);
        }
        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }
        button {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
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
            text-decoration: none;
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Kembali ke Daftar Buku</a>
        
        <h2>📚 Tambah Buku Baru</h2>
        
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="judul">Judul Buku <span class="required">*</span>:</label>
                <input type="text" id="judul" name="judul" 
                       value="<?= isset($_POST['judul']) ? htmlspecialchars($_POST['judul']) : '' ?>" 
                       required maxlength="255" placeholder="Masukkan judul buku">
            </div>
            
            <div class="form-group">
                <label for="pengarang">Pengarang <span class="required">*</span>:</label>
                <input type="text" id="pengarang" name="pengarang" 
                       value="<?= isset($_POST['pengarang']) ? htmlspecialchars($_POST['pengarang']) : '' ?>" 
                       required maxlength="255" placeholder="Masukkan nama pengarang">
            </div>
            
            <div class="form-group">
                <label for="penerbit">Penerbit <span class="required">*</span>:</label>
                <input type="text" id="penerbit" name="penerbit" 
                       value="<?= isset($_POST['penerbit']) ? htmlspecialchars($_POST['penerbit']) : '' ?>" 
                       required maxlength="255" placeholder="Masukkan nama penerbit">
            </div>
            
            <div class="form-group">
                <label for="stok">Stok <span class="required">*</span>:</label>
                <input type="number" id="stok" name="stok" 
                       value="<?= isset($_POST['stok']) ? htmlspecialchars($_POST['stok']) : '1' ?>" 
                       required min="0" max="9999" placeholder="Masukkan jumlah stok">
            </div>
            
            <div class="btn-group">
                <button type="submit" class="btn-primary">💾 Simpan Buku</button>
                <a href="index.php" class="btn-secondary">❌ Batal</a>
            </div>
        </form>
    </div>

    <script>
        // Auto focus on first input
        document.getElementById('judul').focus();
        
        // Confirm before leaving if form has content
        let formHasContent = false;
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input[type="text"], input[type="number"]');
        
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                formHasContent = Array.from(inputs).some(inp => inp.value.trim() !== '' && inp.value !== '1');
            });
        });
        
        window.addEventListener('beforeunload', (e) => {
            if (formHasContent) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
        
        // Don't show warning when submitting form
        form.addEventListener('submit', () => {
            formHasContent = false;
        });
    </script>
</body>
</html>