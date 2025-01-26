<?php
include '../auth.php';

$id = $_GET['id'];

$sql = "DELETE FROM Patients WHERE patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Redirect back to patient list
    header("Location: view_patients.php");
    exit();
} else {
    // Handle error
    header("Location: view_patients.php?error=" . urlencode($stmt->error));
    exit();
}

$stmt->close();
$conn->close();
?>
