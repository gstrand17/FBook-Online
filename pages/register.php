<?php
session_start();

$db = new mysqli("localhost", "root", "", "fbook_online");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$action = $_POST['action'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($action == "login") {
    // LOGIN CASE
    $stmt = $db->prepare("SELECT user_id, name FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user['name'];

        header("Location: dashboards.php");
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }
    $stmt->close();

} else {
    // REGISTER CASE
    $name = $_POST['name'];
    $email = $_POST['email'];
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
}

$db->close();
?>
