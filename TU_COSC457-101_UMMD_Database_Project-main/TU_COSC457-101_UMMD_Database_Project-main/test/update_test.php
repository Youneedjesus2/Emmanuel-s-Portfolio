<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $test_id = $_POST['test_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $sql = "UPDATE Tests SET name = ?, description = ?, cost = ? WHERE test_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $name, $description, $cost, $test_id);

    if ($stmt->execute()) {
        header("Location: view_tests.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
