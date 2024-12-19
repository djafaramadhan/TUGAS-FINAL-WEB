<?php
// Mulai sesi dan cek apakah user sudah login
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";  // Ganti dengan nama host database Anda
$username = "root";         // Ganti dengan username database Anda
$password = "";             // Ganti dengan password database Anda
$dbname = "suara_nesia";     // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data lagu
$sql = "SELECT * FROM songs";
$songs_result = $conn->query($sql);

// Query untuk mendapatkan data artis
$sql_artists = "SELECT * FROM artists";
$artists_result = $conn->query($sql_artists);

// Query untuk mendapatkan data album
$sql_albums = "SELECT * FROM albums";
$albums_result = $conn->query($sql_albums);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuaraNesia</title>
    <!-- Fonts & Stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="WEB/Aset/Logo.PNG" alt="SuaraNesia Logo" class="wave-logo">
            <span class="brand-name">SuaraNesia</span>
        </div>
        <nav class="nav-header">
            <a href="signup.html" class="nav-link">Sign Up</a>
            <a href="login.php" class="nav-link">Log In</a>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="menu-item active">
            <img src="WEB/Aset/Home.png" alt="Home">
            <span>Beranda</span>
        </a>
        <a href="explore.html" class="menu-item">
            <img src="WEB/Aset/Explore.png" alt="Eksplorasi">
            <span>Eksplorasi</span>
        </a>
        <a href="#" class="menu-item">
            <img src="WEB/Aset/Koleksi.png" alt="Koleksi">
            <span>Koleksi</span>
        </a>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <!-- Background Image -->
        <div class="background-img">
            <img src="WEB/1723094678-1200x675.webp" alt="Background Music">
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Telusuri Lagu, Artis, Album">
            <button class="search-btn">🔍</button>
        </div>

        <!-- Lagu Paling Hits -->
        <section class="hits">
            <div class="section-header">
                <h2>LAGU PALING HITS PALING ENAK</h2>
                <a href="#" class="show-all">Show All</a>
            </div>
            <div class="songs">
                <?php while($row = $songs_result->fetch_assoc()) { ?>
                    <div class="song-item">
                        <strong><?php echo $row['song_name']; ?></strong><br>
                        <?php echo $row['artist']; ?>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- Artis Paling Hits -->
        <section class="hits-artis">
            <div class="section-header">
                <h2>ARTIS PALING HITS PALING ENAK</h2>
                <a href="#" class="show-all">Show All</a>
            </div>
            <div class="artists">
                <?php while($row = $artists_result->fetch_assoc()) { ?>
                    <div class="artist-item">
                        <img src="WEB/<?php echo $row['image']; ?>" alt="<?php echo $row['artist_name']; ?>"><br>
                        <span><?php echo $row['artist_name']; ?></span>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- Album Paling Hits -->
        <section class="hits-album">
            <div class="section-header">
                <h2>ALBUM PALING HITS PALING ENAK</h2>
                <a href="#" class="show-all">Show All</a>
            </div>
            <div class="albums">
                <?php while($row = $albums_result->fetch_assoc()) { ?>
                    <div class="album-item">
                        <img src="WEB/<?php echo $row['album_image']; ?>" alt="<?php echo $row['album_name']; ?>"><br>
                        <strong><?php echo $row['album_name']; ?></strong><br>
                        <?php echo $row['artist']; ?>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>

<?php
// Menutup koneksi database
$conn->close();
?>
