<?php
include '../auth.php';
include '../header.php';

// Fetch patients for selection
$patients_result = $conn->query("SELECT patient_id, first_name, last_name FROM Patients ORDER BY last_name");

// Fetch doctors for selection
$doctors_result = $conn->query("SELECT doctor_id, first_name, last_name FROM Doctors ORDER BY last_name");
?>

<h2>Schedule New Appointment</h2>

<form action="add_appointment.php" method="post">
    <label for="patient_id">Patient:</label>
    <select name="patient_id" required>
        <option value="">--Select Patient--</option>
        <?php while ($patient = $patients_result->fetch_assoc()): ?>
            <option value="<?php echo $patient['patient_id']; ?>">
                <?php echo htmlspecialchars($patient['last_name'] . ', ' . $patient['first_name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="doctor_id">Doctor:</label>
    <select name="doctor_id" required>
        <option value="">--Select Doctor--</option>
        <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
            <option value="<?php echo $doctor['doctor_id']; ?>">
                <?php echo htmlspecialchars($doctor['last_name'] . ', ' . $doctor['first_name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="appointment_date">Appointment Date and Time:</label>
    <input type="datetime-local" name="appointment_date" required><br><br>

    <input type="submit" value="Schedule Appointment">
</form>

<?php
include '../footer.php';
?>
