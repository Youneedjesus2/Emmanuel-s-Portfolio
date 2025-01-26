<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $specialization_id = $_POST['specialization_id'];

    // Use prepared statement
    $sql = "INSERT INTO Doctors (first_name, last_name, specialization_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $first_name, $last_name, $specialization_id);

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
