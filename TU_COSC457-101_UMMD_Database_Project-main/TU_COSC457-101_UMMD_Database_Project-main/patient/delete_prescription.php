<?php
include '../auth.php';

if (isset($_GET['prescription_id']) && is_numeric($_GET['prescription_id']) && isset($_GET['patient_id']) && is_numeric($_GET['patient_id'])) {
    $prescription_id = $_GET['prescription_id'];
    $patient_id = $_GET['patient_id'];

    $sql = "DELETE FROM Prescriptions WHERE prescription_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prescription_id);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
