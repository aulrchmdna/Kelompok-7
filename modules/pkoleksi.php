<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Koleksi Buku Populer</title>
<style>
  body {
    background: #f8f4f1;
    font-family: 'Layfair Display', serif;
    margin: 0;
    padding: 0;
    color: #3e2723;
  }
  header {
    background: #6d4c41;
    padding: 1.5rem 1rem;
    color: white;
    text-align: center;
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: 1.2px;
    box-shadow: 0 4px 8px rgba(109, 76, 65, 0.4);
  }
  main {
    max-width: 1000px;
    margin: 3rem auto 6rem;
    padding: 0 1rem;
  }
  h1 {
    margin-bottom: 2rem;
    text-align: center;
    color: #6d4c41;
    font-weight: 700;
  }
  .books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.8rem;
  }
  .book-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(109, 76, 65, 0.15);
    padding: 1rem;
    display: flex;
    flex-direction: column;
  }
  .book-cover {
    width: 100%;
    height: 280px;
    background: #d7ccc8 no-repeat center;
    background-size: cover;
    border-radius: 8px;
    margin-bottom: 1rem;
  }
  .book-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #6d4c41;
    margin-bottom: 0.5rem;
    flex-shrink: 0;
  }
  .book-author {
    font-style: italic;
    color: #8d6e63;
    margin-bottom: 1rem;
    flex-shrink: 0;
  }
  .book-description {
    color: #3e2723;
    flex-grow: 1;
    line-height: 1.3;
  }
  footer {
    text-align: center;
    margin-top: 3rem;
    color: #7f8c8d;
    font-size: 0.9rem;
  }
  @media (max-width: 480px) {
    .book-cover {
      height: 200px;
    }
  }
</style>
</head>
<body>
<header>
  Koleksi Buku Populer
  <a href="plogout.php" 
     style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); 
            background:#dc3545; color:#fff; padding:6px 12px; border-radius:5px; text-decoration:none; font-size: 0.9rem;">
     Logout
  </a>
</header>
<main>
  <h1>Temukan Buku Terpopuler</h1>
  <section class="books-grid" id="booksGrid">
    <?php
      $books = [
        [
          "title" => "Laut Bercerita",
          "author" => "Leila S. Chudori",
          "description" => "Sebuah novel yang menggali sisi kemanusiaan dan sejarah Indonesia melalui kisah personal dan emosional.",
          "cover" => "Laut.jpg" // Gambar Laut Bercerita
        ],
        [
          "title" => "Bumi Manusia",
          "author" => "Pramoedya Ananta Toer",
          "description" => "Karya sastra legendaris yang menggambarkan kehidupan sosial dan perjuangan pada masa kolonial Belanda.",
          "cover" => "BumiManusia.jpg" // Gambar Bumi Manusia
        ],
        [
          "title" => "Supernova: Ksatria, Puteri, dan Bintang Jatuh",
          "author" => "Dee Lestari",
          "description" => "Novel yang memadukan ilmu pengetahuan, filosofi, dan kisah manusia dengan gaya penceritaan yang unik.",
          "cover" => "PutriBintang.jpg" // Gambar Supernova
        ],
        [
          "title" => "Negeri 5 Menara",
          "author" => "A. Fuadi",
          "description" => "Cerita inspiratif tentang perjuangan dan persahabatan di pondok pesantren yang penuh semangat dan nilai kehidupan.",
          "cover" => "5Menara.jpg" // Gambar Negeri 5 Menara
        ],
        [
          "title" => "The Power of Now",
          "author" => "Eckhart Tolle",
          "description" => "Buku self-help populer yang mengajarkan pentingnya kesadaran dan hidup pada saat ini untuk kedamaian batin.",
          "cover" => "ThePower.jpg" // Gambar The Power of Now
        ],
        [
          "title" => "Atomic Habits",
          "author" => "James Clear",
          "description" => "Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk melalui perubahan kecil yang konsisten.",
          "cover" => "Atomic.jpg" // Gambar Atomic Habits
        ]
      ];

      foreach ($books as $book) {
        echo '<article class="book-card">';
        echo '<div class="book-cover" style="background-image: url(\'' . $book["cover"] . '\');"></div>';
        echo '<h2 class="book-title">' . $book["title"] . '</h2>';
        echo '<p class="book-author">Oleh: ' . $book["author"] . '</p>';
        echo '<p class="book-description">' . $book["description"] . '</p>';
        echo '</article>';
      }
    ?>
  </section>
</main>
<footer>
  &copy; 2024 Perpustakaan Digital - Semua Hak Dilindungi
</footer>
</body>
</html>
