<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prescription_id = intval($_POST['prescription_id']);
    $patient_id = intval($_POST['patient_id']);
    $doctor_id = intval($_POST['doctor_id']);
    $medication_id = intval($_POST['medication_id']);
    $dosage = $_POST['dosage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "UPDATE Prescriptions SET doctor_id = ?, medication_id = ?, dosage = ?, start_date = ?, end_date = ? WHERE prescription_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssi", $doctor_id, $medication_id, $dosage, $start_date, $end_date, $prescription_id);

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
