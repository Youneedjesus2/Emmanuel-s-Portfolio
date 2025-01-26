<?php
include '../auth.php';

$appointment_id = $_GET['id'];

// Update appointment status to 'Cancelled'
$stmt = $conn->prepare("UPDATE Appointments SET status = 'Cancelled' WHERE appointment_id = ?");
$stmt->bind_param("i", $appointment_id);

if ($stmt->execute()) {
    header("Location: view_appointments.php");
    exit();
} else {
    echo "Error cancelling appointment: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
