<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new mysqli("localhost", "root", "", "fbook_online");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$user_id = $_SESSION['user_id'];
$tradition_id = $_POST['tradition_id'];
$caption = $_POST['textForm'] ?? ""; // This is the answer or caption
$stmt = $db->prepare("INSERT INTO completion (user_id, tradition_id, caption) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE caption = ?");
$stmt->bind_param("iiss", $user_id, $tradition_id, $caption, $caption);

if ($stmt->execute()) {
    $completion_id = $db->insert_id;
    if ($completion_id == 0) {
        $res = $db->query("SELECT comp_id FROM completion WHERE user_id = $user_id AND tradition_id = $tradition_id");
        $row = $res->fetch_assoc();
        $completion_id = $row['comp_id'];
    }
    if (isset($_FILES['photoForm']) && $_FILES['photoForm']['error'] == 0) {
        $upload_dir = "../assets/uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES['photoForm']['name']);
        $target_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['photoForm']['tmp_name'], $target_path)) {
            $photo_stmt = $db->prepare("INSERT INTO photos (user_id, completion_id, file_path) VALUES (?, ?, ?)");
            $db_path = "assets/uploads/" . $file_name;
            $photo_stmt->bind_param("iis", $user_id, $completion_id, $db_path);
            $photo_stmt->execute();
            $photo_stmt->close();
        }
    }
    header("Location: catalog.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$db->close();
?>
