<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $diagnosis_id = $_POST['diagnosis_id'] ?: null;
    $treatment_id = $_POST['treatment_id'] ?: null;

    $stmt = $conn->prepare("INSERT INTO MedicalRecords (patient_id, diagnosis_id, treatment_id) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $patient_id, $diagnosis_id, $treatment_id);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error adding medical record: " . $stmt->error;
    }
}

$conn->close();
?>
