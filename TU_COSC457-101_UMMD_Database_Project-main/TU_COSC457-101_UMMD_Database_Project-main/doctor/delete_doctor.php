<?php
include '../auth.php';

$doctor_id = $_GET['id'];

// Use prepared statement
$sql = "DELETE FROM Doctors WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);

if ($stmt->execute()) {
    header("Location: view_doctors.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
