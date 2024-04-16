<?php
function parse_env($path) {
    $data = [];
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // ignore comments
        list($key, $value) = explode('=', $line, 2);
        $data[$key] = $value;
    }
    return $data;
}

$env = parse_env('.env');

$conn = mysqli_connect($env["DB_HOST"], $env["DB_USER"], $env["DB_PASSWORD"], $env["DB_NAME"]);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup-submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: signin.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
