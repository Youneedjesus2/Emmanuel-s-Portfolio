<?php
include '../auth.php';
include '../header.php';

// Fetch appointments with patient and doctor details
$sql = "
    SELECT a.*,
           p.first_name AS patient_first_name, p.last_name AS patient_last_name,
           d.first_name AS doctor_first_name, d.last_name AS doctor_last_name
    FROM Appointments a
    JOIN Patients p ON a.patient_id = p.patient_id
    JOIN Doctors d ON a.doctor_id = d.doctor_id
    ORDER BY a.appointment_date DESC
";
$result = $conn->query($sql);
?>

<h2>Appointments</h2>

<p><a href="add_appointment_form.php">Schedule New Appointment</a></p>

<table border="1">
    <tr>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Date and Time</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php while ($appointment = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($appointment['patient_last_name'] . ', ' . $appointment['patient_first_name']); ?></td>
            <td><?php echo htmlspecialchars($appointment['doctor_last_name'] . ', ' . $appointment['doctor_first_name']); ?></td>
            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
            <td><?php echo htmlspecialchars($appointment['status']); ?></td>
            <td>
                <a href="edit_appointment_form.php?id=<?php echo $appointment['appointment_id']; ?>">Edit</a> |
                <a href="delete_appointment.php?id=<?php echo $appointment['appointment_id']; ?>">Cancel</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
