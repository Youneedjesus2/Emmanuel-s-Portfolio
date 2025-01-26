<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medication_id = $_POST['medication_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE Medications SET name = ?, description = ? WHERE medication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $description, $medication_id);

    if ($stmt->execute()) {
        header("Location: view_medications.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
