<?php
include '../auth.php';
include '../header.php';

$patient_id = $_GET['patient_id'];

// Fetch diagnoses for the patient
$diagnoses_result = $conn->query("
    SELECT diagnosis_id, description, date FROM Diagnosis WHERE patient_id = $patient_id
");

// Fetch treatments
$treatments_result = $conn->query("SELECT treatment_id, name FROM Treatments");
?>

<h2>Add Medical Record</h2>

<form action="add_medical_record.php" method="post">
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

    <label for="diagnosis_id">Diagnosis:</label>
    <select name="diagnosis_id">
        <option value="">--Select Diagnosis--</option>
        <?php while ($diagnosis = $diagnoses_result->fetch_assoc()): ?>
            <option value="<?php echo $diagnosis['diagnosis_id']; ?>">
                <?php echo htmlspecialchars($diagnosis['description'] . ' (' . $diagnosis['date'] . ')'); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="treatment_id">Treatment:</label>
    <select name="treatment_id">
        <option value="">--Select Treatment--</option>
        <?php while ($treatment = $treatments_result->fetch_assoc()): ?>
            <option value="<?php echo $treatment['treatment_id']; ?>">
                <?php echo htmlspecialchars($treatment['name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Add Medical Record">
</form>

<?php
include '../footer.php';
?>
