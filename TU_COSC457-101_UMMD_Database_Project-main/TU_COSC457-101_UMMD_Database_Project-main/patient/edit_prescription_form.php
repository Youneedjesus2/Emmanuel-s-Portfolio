<?php
include '../auth.php';
include '../header.php';

if (isset($_GET['prescription_id']) && is_numeric($_GET['prescription_id']) && isset($_GET['patient_id']) && is_numeric($_GET['patient_id'])) {
    $prescription_id = $_GET['prescription_id'];
    $patient_id = $_GET['patient_id'];

    // Fetch the prescription details
    $stmt = $conn->prepare("
        SELECT p.*, m.name AS medication_name
        FROM Prescriptions p
        JOIN Medications m ON p.medication_id = m.medication_id
        WHERE p.prescription_id = ? AND p.patient_id = ?
    ");
    $stmt->bind_param("ii", $prescription_id, $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $prescription = $result->fetch_assoc();

    if (!$prescription) {
        header("Location: patient_care.php?id=$patient_id&error=" . urlencode("Prescription not found."));
        exit();
    }

    // Fetch assigned doctors
    $doctors_result = $conn->query("
        SELECT d.doctor_id, d.first_name, d.last_name
        FROM Doctors d
        JOIN DoctorPatient dp ON d.doctor_id = dp.doctor_id
        WHERE dp.patient_id = $patient_id
    ");

    // Fetch all available medications
    $medications_result = $conn->query("SELECT * FROM Medications");

} else {
    header("Location: patient_care.php?id=$patient_id&error=" . urlencode("Invalid prescription ID."));
    exit();
}
?>

<h2>Edit Prescription</h2>

<form action="update_prescription.php" method="post">
    <input type="hidden" name="prescription_id" value="<?php echo $prescription['prescription_id']; ?>">
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

    <label for="doctor_id">Select Doctor:</label>
    <select name="doctor_id" id="doctor_id" required>
        <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
            <option value="<?php echo $doctor['doctor_id']; ?>" <?php if ($doctor['doctor_id'] == $prescription['doctor_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?>
            </option>
        <?php endwhile; ?>
    </select>
    <br><br>

    <label for="medication_id">Select Medication:</label>
    <select name="medication_id" id="medication_id" required>
        <?php while ($medication = $medications_result->fetch_assoc()): ?>
            <option value="<?php echo $medication['medication_id']; ?>" <?php if ($medication['medication_id'] == $prescription['medication_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($medication['name']); ?>
            </option>
        <?php endwhile; ?>
    </select>
    <br><br>

    <label for="dosage">Dosage:</label>
    <input type="text" name="dosage" id="dosage" value="<?php echo htmlspecialchars($prescription['dosage']); ?>" required><br><br>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($prescription['start_date']); ?>" required><br><br>

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" value="<?php echo htmlspecialchars($prescription['end_date']); ?>" required><br><br>

    <input type="submit" value="Update Prescription">
</form>

<?php
$stmt->close();
$conn->close();
include '../footer.php';
?>
