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
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Perpustakaan - Pinjam & Kembalikan Buku</title>
<style>
  body {
    background:rgba(255, 255, 255, 0.57);
    font-family: 'Playfair Display';
    margin: 0;
    padding: 0;
    color: #3e2723;
    opacity: 0;
    animation: fadeIn 1.2s ease forwards;
    background: url('member.jpg') no-repeat center center fixed;
    background-size: cover;
  }
    input[type="text"],
    input[type="date"],
    select,
  button {
    font-family: 'Playfair Display';
  }
  @keyframes fadeIn {
    to {
      opacity: 1;
    }
  }
  header {
    background:rgb(159, 90, 17);
    padding: 1.2rem;
    color: white;
    text-align: center;
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: 1.2px;
  }
  main {
    max-width: 900px;
    margin: 2rem auto 4rem;
    background:rgba(255, 255, 255, 0.76);
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 2rem;
  }
  h2 {
    color: #6d4c41;
    text-align: center;
    border-bottom: 3px solidrgb(163, 89, 24);
    padding-bottom: 0.5rem;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
  }
  label {
    display: block;
    margin-bottom: 0.4rem;
    font-weight: 600;
    color:rgb(62, 50, 35);
  }
  input[type="text"],
  input[type="date"],
  select {
    width: 100%;
    padding: 0.5rem 0.8rem;
    margin-bottom: 1rem;
    border: 1.8px solidrgba(215, 204, 200, 0.77);
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s;
  }
  input[type="text"]:focus,
  input[type="date"]:focus,
  select:focus {
    outline: none;
    border-color: #6d4c41;
  }
  button {
    background-color:rgb(146, 62, 10);
    color: white;
    border: none;
    padding: 0.7rem 1.5rem;
    font-size: 1.1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #8B4513;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 1rem;
  }
  table thead tr {
    background-color:rgb(178, 96, 13);
    color: white;
  }
  table th,
  table td {
    padding: 0.7rem;
    text-align: center;
    border: 1px solid #ddd;
  }
  .fine {
    color:rgb(199, 105, 28);
    font-weight: 700;
  }
  .returned {
    color:rgb(183, 43, 12);
    font-weight: 700;
  }
  .not-returned {
    color: #c0392b;
    font-weight: 700;
  }
  .btn-return {
    background-color:rgb(198, 106, 19);
    padding: 0.4rem 0.8rem;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    color: white;
  }
  .btn-return:hover {
    background-color:rgb(203, 127, 27);
  }
  .footer-note {
    text-align: center;
    color: #7f8c8d;
    margin-top: 2rem;
    font-size: 0.9rem;
  }
  .flex-grid {
    display: flex;
    gap: 1.5rem;
  }
  .flex-child {
    flex: 1;
  }
  @media (max-width: 650px) {
    .flex-grid {
      flex-direction: column;
    }
  }
  .btn-back {
    display: inline-block;
    margin-top: 2rem;
    text-align: center;
    padding: 10px 20px;
    background-color: #6d4c41;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
  }
  .btn-back:hover {
    background-color: #5a3a31;
  }
        
</style>
</head>
<body>
<header>
  Perpustakaan - Sistem Peminjaman Buku
</header>
<main>
  <section>
    <h2>Peminjaman</h2>
    <form id="borrowForm">
      <label for="bookTitle">Judul Buku</label>
      <input type="text" id="bookTitle" name="bookTitle" placeholder="Masukkan judul buku" required />
      <label for="borrowDate">Tanggal Pinjam</label>
      <input type="date" id="borrowDate" name="borrowDate" required />
      <button type="submit">Pinjam</button>
    </form>
  </section>

  <section>
    <h2>Detail Peminjaman Buku</h2>
    <table id="borrowedBooksTable" aria-label="Daftar Buku Dipinjam">
      <thead>
        <tr>
          <th>Judul Buku</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Kembali</th>
          <th>Status</th>
          <th>Denda</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data akan dimasukkan via JavaScript -->
      </tbody>
    </table>
  </section>

  <!-- Tombol kembali -->
  <div style="text-align: center;">
    <a href="pkoleksi.php" class="btn-back">← Kembali ke Koleksi Buku Populer</a>
  </div>
</main>

<script>
(() => {
  const LOAN_PERIOD_DAYS = 7;
  const FINE_PER_DAY = 2000;
  const borrowForm = document.getElementById('borrowForm');
  const borrowedBooksTableBody = document.querySelector('#borrowedBooksTable tbody');
  let borrowedBooks = JSON.parse(localStorage.getItem('borrowedBooks')) || [];

  function formatDate(dateStr) {
    const d = new Date(dateStr);
    return isNaN(d) ? '-' : d.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
  }

  function calculateDueDate(borrowDateStr) {
    const borrowDate = new Date(borrowDateStr);
    borrowDate.setDate(borrowDate.getDate() + LOAN_PERIOD_DAYS);
    return borrowDate.toISOString().split('T')[0];
  }

  function calculateFine(dueDateStr, returnDateStr) {
    const dueDate = new Date(dueDateStr);
    const today = returnDateStr ? new Date(returnDateStr) : new Date();
    if (today <= dueDate) return 0;
    const lateDays = Math.floor((today - dueDate) / (1000 * 3600 * 24));
    return lateDays * FINE_PER_DAY;
  }

  function renderTable() {
    borrowedBooksTableBody.innerHTML = '';
    if (borrowedBooks.length === 0) {
      borrowedBooksTableBody.innerHTML = '<tr><td colspan="6" style="text-align:center; color: #7f8c8d;">Tidak ada buku yang sedang dipinjam.</td></tr>';
      return;
    }

    borrowedBooks.forEach((book, index) => {
      const dueDate = calculateDueDate(book.borrowDate);
      const fine = calculateFine(dueDate, book.returnDate);
      const fineFormatted = fine.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
      const status = book.returnDate ? 'Kembali' : 'Dipinjam';
      const statusClass = book.returnDate ? 'returned' : 'not-returned';
      const returnBtn = book.returnDate
        ? '-'
        : <button class="btn-return" data-index="${index}">Kembalikan</button>;

      borrowedBooksTableBody.insertAdjacentHTML('beforeend', `
        <tr>
          <td>${book.title}</td>
          <td>${formatDate(book.borrowDate)}</td>
          <td>${book.returnDate ? formatDate(book.returnDate) : '-'}</td>
          <td class="${statusClass}">${status}</td>
          <td class="fine">${fine > 0 ? fineFormatted : '-'}</td>
          <td>${returnBtn}</td>
        </tr>
      `);
    });

    // Tambahkan event listener pada tombol kembalikan
    document.querySelectorAll('.btn-return').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const index = e.target.getAttribute('data-index');
        borrowedBooks[index].returnDate = new Date().toISOString().split('T')[0];
        localStorage.setItem('borrowedBooks', JSON.stringify(borrowedBooks));
        renderTable();
      });
    });
  }

  borrowForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const title = borrowForm.bookTitle.value.trim();
    const borrowDate = borrowForm.borrowDate.value;
    if (!title || !borrowDate) return alert('Judul buku dan tanggal pinjam wajib diisi.');

    borrowedBooks.push({
      title,
      borrowDate,
      returnDate: null
    });

    localStorage.setItem('borrowedBooks', JSON.stringify(borrowedBooks));
    borrowForm.reset();
    renderTable();
  });

  // Set default pinjam tanggal ke hari ini
  borrowForm.borrowDate.value = new Date().toISOString().split('T')[0];

  // Render table saat awal buka halaman
  renderTable();
})();
</script>
</body>
</html>