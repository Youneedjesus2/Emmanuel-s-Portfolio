<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO Laboratories (name, department_id) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $department_id);

    if ($stmt->execute()) {
        header("Location: view_laboratories.php");
        exit();
    } else {
        echo "Error adding laboratory: " . $stmt->error;
    }
}

$conn->close();
?>
