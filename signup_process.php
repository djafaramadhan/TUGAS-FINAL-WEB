<?php
// Koneksi ke database
$host = 'localhost'; // Ganti dengan host Anda jika menggunakan hosting
$dbname = 'suara_nesia'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil email dan password dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data ke database
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        // Redirect ke halaman login setelah berhasil signup
        header('Location: login.php');
        exit();
    } else {
        echo "Terjadi kesalahan saat membuat akun.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-box">
            <div class="header-text">
                <img src="WEB/Aset/Logo.PNG" alt="SuaraNesia Logo" class="wave-logo">
                <span class="brand-name">SuaraNesia</span>
                <h2>Create Password</h2>
                <p>Password anda harus terdiri dari 1 huruf besar, 1 angka atau special karakter (example: # ? ! &) & minimal 10 karakter</p>
            </div>

            <!-- Password Requirements Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Requirement</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1 Uppercase Letter</td>
                        <td id="uppercase-status"><span style="color: red;">❌</span></td>
                    </tr>
                    <tr>
                        <td>1 Number or Special Character</td>
                        <td id="number-status"><span style="color: red;">❌</span></td>
                    </tr>
                    <tr>
                        <td>Minimum 10 Characters</td>
                        <td id="length-status"><span style="color: red;">❌</span></td>
                    </tr>
                </tbody>
            </table>
            
            <form id="password-form" class="password-form" method="POST" action="signup_process.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit" class="signup-btn" id="next-btn">Next</button>
            </form>
            <div class="footer">
                <p>This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a> apply.</p>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const uppercaseStatus = document.getElementById('uppercase-status');
        const numberStatus = document.getElementById('number-status');
        const lengthStatus = document.getElementById('length-status');
        const nextButton = document.getElementById('next-btn');

        // Function to validate password
        function validatePassword() {
            const password = passwordInput.value;
            const hasUppercase = /[A-Z]/.test(password);
            const hasNumberOrSpecialChar = /[0-9!@#$%^&*(),.?":{}|<>]/.test(password);
            const hasMinLength = password.length >= 10;

            // Update the table based on password validation
            uppercaseStatus.innerHTML = hasUppercase ? '<span style="color: green;">✔️</span>' : '<span style="color: red;">❌</span>';
            numberStatus.innerHTML = hasNumberOrSpecialChar ? '<span style="color: green;">✔️</span>' : '<span style="color: red;">❌</span>';
            lengthStatus.innerHTML = hasMinLength ? '<span style="color: green;">✔️</span>' : '<span style="color: red;">❌</span>';

            // If all requirements are met, enable the 'Next' button
            if (hasUppercase && hasNumberOrSpecialChar && hasMinLength) {
                nextButton.disabled = false;
            } else {
                nextButton.disabled = true;
            }
        }

        // Attach event listener for password input
        passwordInput.addEventListener('input', validatePassword);

        // Handle form submission (Redirect to login page after successful password creation)
        document.getElementById('password-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Simulate successful password creation and redirect to the login page
            alert("Password Created Successfully!");
            window.location.href = "login.php";  // Redirect to login page
        });
    </script>
</body>
</html>
