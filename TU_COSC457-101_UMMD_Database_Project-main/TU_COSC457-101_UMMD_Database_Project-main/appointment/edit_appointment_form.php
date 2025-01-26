<?php
include '../auth.php';
include '../header.php';

$appointment_id = $_GET['id'];

// Fetch appointment details
$stmt = $conn->prepare("
    SELECT a.*, p.first_name AS patient_first_name, p.last_name AS patient_last_name,
           d.first_name AS doctor_first_name, d.last_name AS doctor_last_name
    FROM Appointments a
    JOIN Patients p ON a.patient_id = p.patient_id
    JOIN Doctors d ON a.doctor_id = d.doctor_id
    WHERE a.appointment_id = ?
");
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();
$stmt->close();

if (!$appointment) {
    echo "Appointment not found.";
    exit();
}

// Fetch patients and doctors for selection
$patients_result = $conn->query("SELECT patient_id, first_name, last_name FROM Patients ORDER BY last_name");
$doctors_result = $conn->query("SELECT doctor_id, first_name, last_name FROM Doctors ORDER BY last_name");
?>

<h2>Edit Appointment</h2>

<form action="update_appointment.php" method="post">
    <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">

    <label for="patient_id">Patient:</label>
    <select name="patient_id" required>
        <?php while ($patient = $patients_result->fetch_assoc()): ?>
            <option value="<?php echo $patient['patient_id']; ?>" <?php if ($patient['patient_id'] == $appointment['patient_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($patient['last_name'] . ', ' . $patient['first_name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="doctor_id">Doctor:</label>
    <select name="doctor_id" required>
        <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
            <option value="<?php echo $doctor['doctor_id']; ?>" <?php if ($doctor['doctor_id'] == $appointment['doctor_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($doctor['last_name'] . ', ' . $doctor['first_name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="appointment_date">Appointment Date and Time:</label>
    <input type="datetime-local" name="appointment_date" value="<?php echo date('Y-m-d\TH:i', strtotime($appointment['appointment_date'])); ?>" required><br><br>

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="Scheduled" <?php if ($appointment['status'] == 'Scheduled') echo 'selected'; ?>>Scheduled</option>
        <option value="Completed" <?php if ($appointment['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
        <option value="Cancelled" <?php if ($appointment['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
    </select><br><br>

    <input type="submit" value="Update Appointment">
</form>

<?php
include '../footer.php';
?>
