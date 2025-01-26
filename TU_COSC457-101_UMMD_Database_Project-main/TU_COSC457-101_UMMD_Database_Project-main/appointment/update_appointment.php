<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    // Update appointment in the database
    $stmt = $conn->prepare("UPDATE Appointments SET patient_id = ?, doctor_id = ?, appointment_date = ?, status = ? WHERE appointment_id = ?");
    $stmt->bind_param("iissi", $patient_id, $doctor_id, $appointment_date, $status, $appointment_id);

    if ($stmt->execute()) {
        header("Location: view_appointments.php");
        exit();
    } else {
        echo "Error updating appointment: " . $stmt->error;
    }
}

$conn->close();
?>
