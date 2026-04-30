<?php
session_start();

include '../dashboard/db.php';
 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo "Server error.";
    exit;
}

// Only POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Method not allowed.";
    exit;
}

if (!isset($_POST['code']) || empty($_POST['code'])) {
    http_response_code(400);
    echo "Code required.";
    exit;
}

$inputCode = $_POST['code'];

// Get latest code (or you can change logic later)
$sql = "SELECT access_code FROM admin_codes ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "No codes found.";
    exit;
}

$row = $result->fetch_assoc();
$hashedCode = $row['access_code'];

// 🔑 Verify hashed code
if (password_verify($inputCode, $hashedCode)) {
    $_SESSION['admin_logged_in'] = true;
    echo "success";
} else {
    http_response_code(401);
    echo "invalid";
}

$conn->close();
?>