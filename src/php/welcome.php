<?php
session_start(); // Place session_start() at the very beginning of the file

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signin.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container welcome-container">
        <h2>Welcome</h2>
        <?php
        // Display welcome message
        $username = $_SESSION['username'];
        echo "<p>Welcome, $username!</p>";
        ?>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
