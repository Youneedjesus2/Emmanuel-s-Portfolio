<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $nurse_id = $_POST['nurse_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department_id = $_POST['department_id'];

    // Use prepared statement
    $sql = "UPDATE Nurses SET first_name = ?, last_name = ?, department_id = ? WHERE nurse_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $first_name, $last_name, $department_id, $nurse_id);

    if ($stmt->execute()) {
        header("Location: view_nurses.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
