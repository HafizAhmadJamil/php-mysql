<?php
require __DIR__ . '/vendor/autoload.php'; // Load Composer's autoloader
use Dotenv\Dotenv;

// Specify the path to your .env file
$dotenvFilePath = '.env';

$dotenv = Dotenv::createImmutable(dirname($dotenvFilePath));
$dotenv->load();

// Database credentials
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    throw new mysqli_sql_exception(mysqli_connect_error());
}

// Start session
session_start();

if (isset($_POST['signin-submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Store username in session
            $_SESSION['username'] = $username;
            // Redirect to welcome.php
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

// Close connection
mysqli_close($conn);
?>
