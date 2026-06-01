<?php
header('Content-Type: application/json');
include '../login/check_auth.php';
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        $booking = $stmt->fetch();

        if ($booking) {
            echo json_encode(['success' => true, 'data' => $booking]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Booking not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
}
?>