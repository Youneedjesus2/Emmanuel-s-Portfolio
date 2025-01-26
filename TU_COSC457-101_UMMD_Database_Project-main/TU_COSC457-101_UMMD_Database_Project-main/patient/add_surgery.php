<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $surgery_date = $_POST['surgery_date'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO Surgeries (patient_id, doctor_id, surgery_date, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $surgery_date, $description);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error adding surgery: " . $stmt->error;
    }
}

$conn->close();
?>
