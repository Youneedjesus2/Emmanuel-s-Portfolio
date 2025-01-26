<?php
include '../auth.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $doctor_id = intval($_POST['doctor_id']);
    $patient_id = intval($_POST['patient_id']);
    $test_id = intval($_POST['test_id']);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO PatientTests (patient_id, test_id, doctor_id) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $patient_id, $test_id, $doctor_id);

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

    // Fetch all available tests
    $tests_result = $conn->query("SELECT * FROM Tests");
    ?>

    <h2>Order Test for <?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?></h2>

    <form action="order_test.php" method="post">
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

        <label for="test_id">Select Test:</label>
        <select name="test_id" id="test_id" required>
            <option value="">--Select a Test--</option>
            <?php while ($test = $tests_result->fetch_assoc()): ?>
                <option value="<?php echo $test['test_id']; ?>">
                    <?php echo htmlspecialchars($test['name'] . ' ($' . $test['cost'] . ')'); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>
        <input type="submit" value="Order Test">
    </form>

    <?php
    $conn->close();
    include '../footer.php';
}
?>
