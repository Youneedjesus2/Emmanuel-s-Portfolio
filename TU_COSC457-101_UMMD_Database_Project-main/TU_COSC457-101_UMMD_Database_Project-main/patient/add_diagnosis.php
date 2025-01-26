<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO Diagnosis (patient_id, doctor_id, description, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $description, $date);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error adding diagnosis: " . $stmt->error;
    }
}

$conn->close();
?>
