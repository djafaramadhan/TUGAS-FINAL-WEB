<?php
// Koneksi ke database
$servername = "localhost";  // Ganti dengan server Anda
$username = "root";         // Ganti dengan username database Anda
$password = "";             // Ganti dengan password database Anda
$dbname = "suara_nesia";     // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $email = $_POST['email'];

    // Memastikan bahwa email tidak kosong dan valid
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Menyimpan data email ke dalam database
        $sql = "INSERT INTO users (email) VALUES ('$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Pendaftaran berhasil!";
            // Arahkan ke halaman login setelah berhasil mendaftar
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email tidak valid!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up to Start Listening</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-box">
            <div class="header-text">
                <img src="WEB/Aset/Logo.PNG" alt="SuaraNesia Logo" class="wave-logo">
                <span class="brand-name">SuaraNesia</span>
                <h2>Sign Up to Start Listening</h2>
                <p>Temukan suara terbaik, dukung karya lokal, dan jadilah bagian dari perjalanan musik Indonesia yang semakin berkembang.</p>
            </div>
            <!-- Formulir Pendaftaran -->
            <form action="sign_up.php" method="POST" class="signup-form">
                <input type="email" name="email" placeholder="name@domain.com" required>
                <button type="submit" class="signup-btn">Next</button>
            </form>
            <div class="footer">
                <p>Already have an account? <a href="login.html">Log In Here</a></p>
                <div class="social-login">
                    <button class="social-btn google">G</button>
                    <button class="social-btn facebook">F</button>
                    <button class="social-btn apple">A</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
