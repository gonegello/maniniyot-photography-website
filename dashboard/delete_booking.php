<?php
header('Content-Type: application/json');

try {
    include '../login/check_auth.php';
    include 'db.php'; // This provides the $pdo variable

    // Get the ID from the POST request
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Use $pdo (from your db.php) instead of $conn
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        
        // PDO execute takes an array of parameters
        if ($stmt->execute([$id])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
    }

} catch (Exception $e) {
    // If there's a database error, catch it and send it as JSON
    echo json_encode([
        'success' => false, 
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>