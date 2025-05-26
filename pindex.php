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

// Pagination
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search
$search = $_GET['search'] ?? '';
$searchQuery = $search ? "WHERE judul LIKE :search" : '';
$stmt = $pdo->prepare("SELECT COUNT(*) FROM buku $searchQuery");
if ($search) {
    $stmt->execute(['search' => "%$search%"]);
} else {
    $stmt->execute();
}
$total = $stmt->fetchColumn();
$totalPages = ceil($total / $limit);

// Fetch books
$stmt = $pdo->prepare("SELECT * FROM buku $searchQuery ORDER BY id LIMIT :limit OFFSET :offset");
if ($search) {
    $stmt->bindValue(':search', "%$search%");
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$books = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .add-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }
        .add-btn:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .action-btn {
            padding: 6px 12px;
            margin: 2px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }
        .edit-btn {
            background-color: #007bff;
            color: white;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .no-data {
            text-align: center;
            padding: 50px;
            color: #666;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div style="max-width:1200px; margin:20px auto; text-align: right;">
        <a href="plogout.php" 
           style="background:#dc3545; color:#fff; padding:8px 15px; border-radius:5px; text-decoration:none;">
           Logout
        </a>
    </div>

    <div class="container">
        <h1>📚 Daftar Buku Perpustakaan</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php
                if ($_GET['success'] == 'update') echo 'Buku berhasil diperbarui!';
                elseif ($_GET['success'] == 'delete') echo 'Buku berhasil dihapus!';
                elseif ($_GET['success'] == 'add') echo 'Buku berhasil ditambahkan!';
                ?>
            </div>
        <?php endif; ?>
        
        <!-- Search Form -->
        <form method="GET" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Cari buku..." 
                   value="<?= htmlspecialchars($search) ?>" 
                   style="padding: 8px; width: 300px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Cari</button>
            <?php if ($search): ?>
                <a href="pindex.php" style="margin-left: 10px; color: #6c757d; text-decoration: none;">Reset</a>
            <?php endif; ?>
        </form>
        
        <a href="padd.php" class="add-btn">+ Tambah Buku Baru</a>
        
        <?php if (count($books) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['id']) ?></td>
                            <td><?= htmlspecialchars($book['judul']) ?></td>
                            <td><?= htmlspecialchars($book['pengarang']) ?></td>
                            <td><?= htmlspecialchars($book['penerbit']) ?></td>
                            <td><?= htmlspecialchars($book['stok']) ?></td>
                            <td>
                                <a href="pedit.php?id=<?= $book['id'] ?>" class="action-btn edit-btn">✏️ Edit</a>
                                <a href="pdelete.php?id=<?= $book['id'] ?>" 
                                   class="action-btn delete-btn" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <p>Belum ada data buku. <a href="padd.php">Tambah buku pertama</a></p>
            </div>
        <?php endif; ?>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div style="text-align: center; margin-top: 20px;">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?=$i?>&search=<?=htmlspecialchars($search)?>" 
                       class="action-btn <?= ($i == $page) ? 'edit-btn' : 'delete-btn' ?>" 
                       style="margin: 2px;"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto hide alert after 3 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
</body>
</html>