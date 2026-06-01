<?php
// Database configuration
$host = "db5019962616.hosting-data.io";
$user = "dbu1846972";
$pass = "Admin_maniniyot@cebu";
$db   = "dbs15408512";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed.");
}

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Method not allowed.";
    exit;
}

// Validate input
if (!isset($_POST['code']) || empty(trim($_POST['code']))) {
    http_response_code(400);
    echo "Access code is required.";
    exit;
}

$rawCode = trim($_POST['code']);

// Optional: enforce minimum length
if (strlen($rawCode) < 8) {
    http_response_code(400);
    echo "Code must be at least 8 characters.";
    exit;
}

// 🔒 Hash the code securely
$hashedCode = password_hash($rawCode, PASSWORD_DEFAULT);

if ($hashedCode === false) {
    http_response_code(500);
    echo "Failed to hash code.";
    exit;
}

// ✅ Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO admin_codes (access_code) VALUES (?)");

if (!$stmt) {
    http_response_code(500);
    echo "Prepare failed.";
    exit;
}

$stmt->bind_param("s", $hashedCode);

// Execute query
if ($stmt->execute()) {
    echo "✅ Access code saved securely!";
} else {
    http_response_code(500);
    echo "Error saving code.";
}

// Cleanup
$stmt->close();
$conn->close();
?>