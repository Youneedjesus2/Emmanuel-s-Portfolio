<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $department_id = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO Equipment (name, description, department_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $description, $department_id);

    if ($stmt->execute()) {
        header("Location: view_equipment.php");
        exit();
    } else {
        echo "Error adding equipment: " . $stmt->error;
    }
}

$conn->close();
?>
