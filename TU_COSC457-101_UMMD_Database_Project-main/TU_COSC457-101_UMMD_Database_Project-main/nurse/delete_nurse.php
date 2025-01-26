<?php
include '../auth.php';

$nurse_id = $_GET['id'];

// Check for associated patients
$checkPatients = $conn->prepare("SELECT COUNT(*) FROM NursePatient WHERE nurse_id = ?");
$checkPatients->bind_param("i", $nurse_id);
$checkPatients->execute();
$checkPatients->bind_result($patientCount);
$checkPatients->fetch();
$checkPatients->close();


// Use prepared statement
$sql = "DELETE FROM Nurses WHERE nurse_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nurse_id);

if ($stmt->execute()) {
    header("Location: view_nurses.php");
    exit();
} else {
    echo "Error deleting nurse: " . $stmt->error;
}

$stmt->close();

$conn->close();
?>
