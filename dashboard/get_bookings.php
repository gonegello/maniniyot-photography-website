<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM bookings ORDER BY shoot_date DESC");
$bookings = $stmt->fetchAll();

echo json_encode($bookings);
?>