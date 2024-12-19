<?php
// Start the session for login
session_start();

// Database connection
$servername = "localhost";
$username = "root";  // Adjust if needed
$password = "";      // Adjust if needed
$dbname = "suara_nesia";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ** LOGIN PROCESS **
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query to fetch user data based on username and password
    $sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
    } else {
        echo "Username or password is incorrect!";
    }
}

// ** SIGN UP PROCESS **
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prevent SQL Injection
    $email = $conn->real_escape_string($email);

    // Insert new user data into the database
    $sql = "INSERT INTO users (email, username, password, role) VALUES ('$email', '', '', 'user')";
    if ($conn->query($sql) === TRUE) {
        echo "Sign Up successful! Please log in.";
    } else {
        echo "Error: " . $conn->error;
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
            <form action="" method="POST" class="signup-form">
                <input type="email" name="email" placeholder="name@domain.com" required>
                <button type="submit" class="signup-btn">Next</button>
            </form>
            <div class="footer">
                <p>Already have an account? <a href="#login-form">Log In Here</a></p>
            </div>
        </div>
    </div>

    <!-- LOGIN FORM -->
    <div class="login-container" id="login-form">
        <div class="login-box">
            <div class="header-text">
                <img src="WEB/Aset/Logo.PNG" alt="SuaraNesia Logo" class="suara-logo">
                <span class="brand-name">SuaraNesia</span>
                <h2>Login to SuaraNesia</h2>
                <p>Mari dengarkan, jelajahi, dan nikmati musik terbaik hanya di SuaraNesia.</p>
            </div>
            <form action="" method="POST" class="login-form">
                <input type="text" name="username" placeholder="Email or Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#">Forgot your password?</a>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <div class="footer">
                <p>Don’t have an account? <a href="#signup-form">Sign Up for SuaraNesia</a></p>
            </div>
        </div>
    </div>
</body>
</html>
