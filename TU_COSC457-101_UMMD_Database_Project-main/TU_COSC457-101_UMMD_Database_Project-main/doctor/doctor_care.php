<?php
include '../auth.php';
include '../header.php';

$doctor_id = intval($_GET['id']);

// Fetch doctor details using prepared statement
$stmt = $conn->prepare("SELECT * FROM Doctors WHERE doctor_id = ?");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$doctor_result = $stmt->get_result();
$doctor = $doctor_result->fetch_assoc();
$stmt->close();

if (!$doctor) {
    echo "<p>Doctor not found.</p>";
    exit();
}

// Fetch assigned patients using prepared statement
$stmt = $conn->prepare("
    SELECT p.patient_id, p.first_name, p.last_name
    FROM Patients p
    JOIN DoctorPatient dp ON p.patient_id = dp.patient_id
    WHERE dp.doctor_id = ?
");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$patients_result = $stmt->get_result();
$stmt->close();
?>

<h2>Doctor Details</h2>
<p><strong>Name:</strong> <?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?></p>
<p><strong>Specialization:</strong>
    <?php
    // Fetch specialization using prepared statement
    $spec_id = $doctor['specialization_id'];
    $stmt = $conn->prepare("SELECT name FROM Specializations WHERE specialization_id = ?");
    $stmt->bind_param("i", $spec_id);
    $stmt->execute();
    $spec_result = $stmt->get_result();
    $spec = $spec_result->fetch_assoc();
    $stmt->close();
    echo htmlspecialchars($spec['name']);
    ?>
</p>

<h3>Assigned Patients</h3>
<ul>
    <?php while ($patient = $patients_result->fetch_assoc()): ?>
        <li>
            <a href="../patient/patient_care.php?id=<?php echo $patient['patient_id']; ?>">
                <?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?>
            </a>
        </li>
    <?php endwhile; ?>
</ul>

<!-- Appointments Section -->
<h3>Appointments</h3>
<table border="1">
    <tr>
        <th>Patient</th>
        <th>Date and Time</th>
        <th>Status</th>
    </tr>
    <?php
    $appointments_result = $conn->prepare("
        SELECT a.*, p.first_name AS patient_first_name, p.last_name AS patient_last_name
        FROM Appointments a
        JOIN Patients p ON a.patient_id = p.patient_id
        WHERE a.doctor_id = ?
        ORDER BY a.appointment_date DESC
    ");
    $appointments_result->bind_param("i", $doctor_id);
    $appointments_result->execute();
    $appointments = $appointments_result->get_result();

    while ($appointment = $appointments->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($appointment['patient_last_name'] . ', ' . $appointment['patient_first_name']); ?></td>
        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
        <td><?php echo htmlspecialchars($appointment['status']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
