<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $doctor_id = $_POST['doctor_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $specialization_id = $_POST['specialization_id'];

    // Use prepared statement
    $sql = "UPDATE Doctors SET first_name = ?, last_name = ?, specialization_id = ? WHERE doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $first_name, $last_name, $specialization_id, $doctor_id);

    if ($stmt->execute()) {
        header("Location: view_doctors.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
