<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
$servername = "localhost";
$username = "root";  // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$dbname = "suara_nesia";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data lagu
$sql = "SELECT * FROM songs";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - SuaraNesia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, User!</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section>
        <h2>Song List</h2>
        <table>
            <thead>
                <tr>
                    <th>Song Name</th>
                    <th>Artist</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['song_name']; ?></td>
                        <td><?php echo $row['artist']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
<?php $conn->close(); ?>
