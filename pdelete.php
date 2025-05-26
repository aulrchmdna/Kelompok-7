<?php
session_start();

// Database connection
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

// Handle deletion
if (!isset($_GET['id'])) {
    header('Location: pindex.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    // Check if book exists
    $stmt = $pdo->prepare("SELECT judul FROM buku WHERE id = ?");
    $stmt->execute([$id]);
    $book = $stmt->fetch();
    
    if (!$book) {
        header('Location: pindex.php');
        exit;
    }
    
    // Delete book
    $stmt = $pdo->prepare("DELETE FROM buku WHERE id = ?");
    $stmt->execute([$id]);
    
    // Redirect with success message
    header('Location: pindex.php?success=delete');
    exit;
    
} catch (PDOException $e) {
    // Redirect with error
    header('Location: pindex.php?error=delete_failed');
    exit;
}
?>