<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $stmt = $conn->prepare("INSERT INTO Treatments (name, description, cost) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $cost);

    if ($stmt->execute()) {
        header("Location: view_treatments.php");
        exit();
    } else {
        echo "Error adding treatment: " . $stmt->error;
    }
}

$conn->close();
?>
