<?php
include '../auth.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $doctor_id = intval($_POST['doctor_id']);
    $patient_id = intval($_POST['patient_id']);
    $medication_id = intval($_POST['medication_id']);
    $dosage = $_POST['dosage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO Prescriptions (patient_id, doctor_id, medication_id, dosage, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $patient_id, $doctor_id, $medication_id, $dosage, $start_date, $end_date);

    if ($stmt->execute()) {
        header("Location: patient_care.php?id=$patient_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    // Display the form
    $patient_id = intval($_GET['patient_id']);

    // Fetch patient details
    $patient_result = $conn->query("SELECT * FROM Patients WHERE patient_id = $patient_id");
    $patient = $patient_result->fetch_assoc();

    if (!$patient) {
        die("Patient not found.");
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
    ?>

    <h2>Add Prescription for <?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?></h2>

    <form action="order_prescription.php" method="post">
        <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

        <label for="doctor_id">Select Doctor:</label>
        <select name="doctor_id" id="doctor_id" required>
            <option value="">--Select a Doctor--</option>
            <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
                <option value="<?php echo $doctor['doctor_id']; ?>">
                    <?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label for="medication_id">Select Medication:</label>
        <select name="medication_id" id="medication_id" required>
            <option value="">--Select a Medication--</option>
            <?php while ($medication = $medications_result->fetch_assoc()): ?>
                <option value="<?php echo $medication['medication_id']; ?>">
                    <?php echo htmlspecialchars($medication['name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label for="dosage">Dosage:</label>
        <input type="text" name="dosage" id="dosage" required><br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required><br><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required><br><br>

        <input type="submit" value="Add Prescription">
    </form>

    <?php
    $conn->close();
    include '../footer.php';
}
?>
