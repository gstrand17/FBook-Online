<?php
session_start();
$db = new mysqli("localhost", "root", "", "fbook_online");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$graduation_year = $_POST['graduation_year'];
$stmt = $db->prepare("INSERT INTO users (name, username, email, password, graduation_year) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $name, $username, $email, $password, $graduation_year);

if ($stmt->execute()) {
    $_SESSION['user_id'] = $db->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;
    header("Location: dashboards.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$db->close();
?>
