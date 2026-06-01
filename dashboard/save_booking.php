<?php
include 'db.php';

header('Content-Type: application/json');
ini_set('display_errors', 0); // Turned off so errors don't break JSON
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    // Capture the ID from the hidden input
    $id = !empty($_POST['id']) ? intval($_POST['id']) : null;

    $fullname        = $_POST['fullname'] ?? '';
    $email_address   = $_POST['email_address'] ?? '';
    $contact_number  = $_POST['contact_number'] ?? '';
    $location        = $_POST['location'] ?? '';
    $service_type    = $_POST['service_type'] ?? '';
    $status          = $_POST['status'] ?? 'pending';
    $shoot_date      = !empty($_POST['shoot_date']) ? $_POST['shoot_date'] : null;
    $agreed_price    = is_numeric($_POST['agreed_price']) ? $_POST['agreed_price'] : 0;
    $booking_notes   = $_POST['booking_notes'] ?? '';

    if (!$fullname || !$contact_number || !$location || !$service_type || !$shoot_date) {
        throw new Exception("Missing required fields.");
    }

    // Build the array of parameters (reused for both Insert and Update)
    $params = [
        ':fullname' => $fullname,
        ':email_address' => $email_address,
        ':contact_number' => $contact_number,
        ':location' => $location,
        ':service_type' => $service_type,
        ':status' => $status,
        ':shoot_date' => $shoot_date,
        ':agreed_price' => $agreed_price,
        ':booking_notes' => $booking_notes
    ];

    if ($id) {
        // --- SMART UPDATE ---
        $sql = "UPDATE bookings SET 
                fullname = :fullname, 
                email_address = :email_address, 
                contact_number = :contact_number, 
                location = :location, 
                service_type = :service_type, 
                status = :status, 
                shoot_date = :shoot_date, 
                agreed_price = :agreed_price, 
                booking_notes = :booking_notes 
                WHERE id = :id";
        
        $params[':id'] = $id; // Add the ID to parameters
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $message = "Booking updated successfully";
    } else {
        // --- NORMAL INSERT ---
        $sql = "INSERT INTO bookings 
                (fullname, email_address, contact_number, location, service_type, status, shoot_date, agreed_price, booking_notes)
                VALUES
                (:fullname, :email_address, :contact_number, :location, :service_type, :status, :shoot_date, :agreed_price, :booking_notes)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $message = "New booking created";
    }

    echo json_encode(['success' => true, 'message' => $message]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}