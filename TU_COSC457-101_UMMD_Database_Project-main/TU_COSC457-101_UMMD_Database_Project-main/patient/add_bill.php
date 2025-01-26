<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO Bills (patient_id, amount, status, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $patient_id, $amount, $status, $date);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error adding bill: " . $stmt->error;
    }
}

$conn->close();
?>
