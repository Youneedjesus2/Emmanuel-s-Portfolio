<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $name = $_POST['name'];
    $relationship = $_POST['relationship'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO EmergencyContacts (patient_id, name, relationship, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $patient_id, $name, $relationship, $phone);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error adding emergency contact: " . $stmt->error;
    }
}

$conn->close();
?>
