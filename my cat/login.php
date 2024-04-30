<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_reservation_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $em = $_POST['email'];
    $pass = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $em, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Set session variable with the username
        $_SESSION['username'] = $em; // Use $em instead of $username
        header("Location: home.html");
        exit();
    } else {
        // Display error message
        $error = "Invalid username or password";
    }
}

$conn->close();
?>
