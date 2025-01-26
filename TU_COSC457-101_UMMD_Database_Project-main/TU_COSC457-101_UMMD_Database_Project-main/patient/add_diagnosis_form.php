<?php
include '../auth.php';
include '../header.php';

$patient_id = $_GET['patient_id'];

// Fetch assigned doctors for the patient
$doctors_result = $conn->query("
    SELECT d.doctor_id, d.first_name, d.last_name
    FROM Doctors d
    JOIN DoctorPatient dp ON d.doctor_id = dp.doctor_id
    WHERE dp.patient_id = $patient_id
");
?>

<h2>Add Diagnosis</h2>

<form action="add_diagnosis.php" method="post">
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

    <label for="doctor_id">Doctor:</label>
    <select name="doctor_id" required>
        <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
            <option value="<?php echo $doctor['doctor_id']; ?>">
                <?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br><br>

    <label for="date">Date:</label>
    <input type="date" name="date" required><br><br>

    <input type="submit" value="Add Diagnosis">
</form>

<?php
include '../footer.php';
?>
