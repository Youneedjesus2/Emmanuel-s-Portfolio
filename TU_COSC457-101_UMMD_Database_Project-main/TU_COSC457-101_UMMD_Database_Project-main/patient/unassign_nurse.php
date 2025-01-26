<?php
include '../auth.php';

$patient_id = $_GET['patient_id'];
$nurse_id = $_GET['nurse_id'];

$sql = "DELETE FROM NursePatient WHERE nurse_id = ? AND patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $nurse_id, $patient_id);

if ($stmt->execute()) {
    header("Location: patient_care.php?id=$patient_id");
    exit();
} else {
    header("Location: patient_care.php?id=$patient_id&error=" . urlencode($stmt->error));
    exit();
}
$stmt->close();
$conn->close();
?>

<p><a href="patient_care.php?id=<?php echo $patient_id; ?>">Back to Patient Details</a></p>
