<?php
include '../auth.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $medication_id = $_GET['id'];

    $sql = "DELETE FROM Medications WHERE medication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medication_id);

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
