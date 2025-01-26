<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = 'Scheduled';

    // Insert appointment into the database
    $stmt = $conn->prepare("INSERT INTO Appointments (patient_id, doctor_id, appointment_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $status);

    if ($stmt->execute()) {
        header("Location: view_appointments.php");
        exit();
    } else {
        echo "Error scheduling appointment: " . $stmt->error;
    }
}

$conn->close();
?>
