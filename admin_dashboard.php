<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome Admin</h1>
    </header>
    <section>
        <p>Manage your platform here...</p>
        <a href="add_song.php">Add Song</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="logout.php">Logout</a>
    </section>
</body>
</html>
