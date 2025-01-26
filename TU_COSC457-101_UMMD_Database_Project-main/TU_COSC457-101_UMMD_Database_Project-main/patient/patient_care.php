<?php
include '../auth.php';
include '../header.php';

$patient_id = $_GET['id'];

// Fetch patient details
$patient_result = $conn->query("SELECT * FROM Patients WHERE patient_id = $patient_id");
$patient = $patient_result->fetch_assoc();

if (!$patient) {
    die("Patient not found.");
}

// Fetch insurance details
if ($patient['insurance_id']) {
    $insurance_id = $patient['insurance_id'];
    $insurance_result = $conn->query("SELECT * FROM Insurance WHERE insurance_id = $insurance_id");
    $insurance = $insurance_result->fetch_assoc();
} else {
    $insurance = null;
}

// Fetch assigned doctors
$doctors_result = $conn->query("
    SELECT d.doctor_id, d.first_name, d.last_name
    FROM Doctors d
    JOIN DoctorPatient dp ON d.doctor_id = dp.doctor_id
    WHERE dp.patient_id = $patient_id
");

// Fetch assigned nurses
$nurses_result = $conn->query("
    SELECT n.nurse_id, n.first_name, n.last_name
    FROM Nurses n
    JOIN NursePatient np ON n.nurse_id = np.nurse_id
    WHERE np.patient_id = $patient_id
");

// We also need medications, treatments, diagnoses, appointments, notes, etc.
?>



<h2>Patient Care Information</h2>
<h3>Personal Information</h3>
<p><strong>Name:</strong> <?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?></p>
<p><strong>Birth Date:</strong> <?php echo htmlspecialchars($patient['birth_date']); ?></p>
<p><strong>Gender:</strong> <?php echo htmlspecialchars($patient['gender']); ?></p>
<p><strong>Phone:</strong> <?php echo htmlspecialchars($patient['phone']); ?></p>
<p><strong>Address:</strong> <?php echo htmlspecialchars($patient['address']); ?></p>

<!-- Insurance Information -->
<h3>Insurance Information</h3>
<?php if ($insurance): ?>
    <p><strong>Provider Name:</strong> <?php echo htmlspecialchars($insurance['provider_name']); ?></p>
    <p><strong>Policy Number:</strong> <?php echo htmlspecialchars($insurance['policy_number']); ?></p>
    <p><strong>Coverage Details:</strong> <?php echo htmlspecialchars($insurance['coverage_details']); ?></p>
<?php else: ?>
    <p>No insurance information available.</p>
<?php endif; ?>

<!-- Assigned Doctors and Nurses -->
 <h3>Assigned Doctors</h3>
    <ul>
        <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
            <li>
                <?php echo $doctor['first_name'] . ' ' . $doctor['last_name']; ?>
                <a href="unassign_doctor.php?patient_id=<?php echo $patient_id; ?>&doctor_id=<?php echo $doctor['doctor_id']; ?>">Unassign</a>
            </li>
        <?php endwhile; ?>
    </ul>
    <a href="assign_doctor.php?patient_id=<?php echo $patient_id; ?>">Assign Doctor</a>

    <h3>Assigned Nurses</h3>
    <ul>
        <?php while ($nurse = $nurses_result->fetch_assoc()): ?>
            <li>
                <?php echo $nurse['first_name'] . ' ' . $nurse['last_name']; ?>
                <a href="unassign_nurse.php?patient_id=<?php echo $patient_id; ?>&nurse_id=<?php echo $nurse['nurse_id']; ?>">Unassign</a>
            </li>
        <?php endwhile; ?>
    </ul>
    <a href="assign_nurse.php?patient_id=<?php echo $patient_id; ?>">Assign Nurse</a>

<!-- Test Orders Section -->
<h3>Test Orders</h3>
<table border="1">
    <tr>
        <th>Test Name</th>
        <th>Ordered By</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Result</th>
        <th>Actions</th>
    </tr>
    <?php
    // Fetch ordered tests for the patient
    $test_orders_result = $conn->query("
        SELECT pt.patient_test_id, t.name AS test_name, d.first_name AS doctor_first_name, d.last_name AS doctor_last_name,
               pt.order_date, pt.status, pt.result
        FROM PatientTests pt
        JOIN Tests t ON pt.test_id = t.test_id
        LEFT JOIN Doctors d ON pt.doctor_id = d.doctor_id
        WHERE pt.patient_id = $patient_id
        ORDER BY pt.order_date DESC
    ");

    while ($test_order = $test_orders_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($test_order['test_name']); ?></td>
        <td><?php echo htmlspecialchars($test_order['doctor_first_name'] . ' ' . $test_order['doctor_last_name']); ?></td>
        <td><?php echo htmlspecialchars($test_order['order_date']); ?></td>
        <td><?php echo htmlspecialchars($test_order['status']); ?></td>
        <td><?php echo htmlspecialchars($test_order['result']); ?></td>
        <td>
            <?php if ($test_order['status'] != 'Completed'): ?>
                <a href="update_test_status.php?patient_test_id=<?php echo $test_order['patient_test_id']; ?>">Update Status</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="order_test.php?patient_id=<?php echo $patient_id; ?>">Order Test</a>

<!-- Prescriptions Section -->
<h3>Prescriptions</h3>
<table border="1">
    <tr>
        <th>Medication Name</th>
        <th>Prescribed By</th>
        <th>Dosage</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
    </tr>
    <?php
    // Fetch prescriptions for the patient
    $prescriptions_result = $conn->query("
        SELECT p.prescription_id, m.name AS medication_name, d.first_name AS doctor_first_name, d.last_name AS doctor_last_name,
               p.dosage, p.start_date, p.end_date
        FROM Prescriptions p
        JOIN Medications m ON p.medication_id = m.medication_id
        LEFT JOIN Doctors d ON p.doctor_id = d.doctor_id
        WHERE p.patient_id = $patient_id
        ORDER BY p.start_date DESC
    ");

    while ($prescription = $prescriptions_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($prescription['medication_name']); ?></td>
        <td><?php echo htmlspecialchars($prescription['doctor_first_name'] . ' ' . $prescription['doctor_last_name']); ?></td>
        <td><?php echo htmlspecialchars($prescription['dosage']); ?></td>
        <td><?php echo htmlspecialchars($prescription['start_date']); ?></td>
        <td><?php echo htmlspecialchars($prescription['end_date']); ?></td>
        <td>
            <a href="edit_prescription_form.php?prescription_id=<?php echo $prescription['prescription_id']; ?>&patient_id=<?php echo $patient_id; ?>">Edit</a> |
            <a href="delete_prescription.php?prescription_id=<?php echo $prescription['prescription_id']; ?>&patient_id=<?php echo $patient_id; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="order_prescription.php?patient_id=<?php echo $patient_id; ?>">Add Prescription</a>

<!-- Diagnoses Section -->
<h3>Diagnoses</h3>
<table border="1">
    <tr>
        <th>Description</th>
        <th>Doctor</th>
        <th>Date</th>
    </tr>
    <?php
    $diagnosis_result = $conn->query("
        SELECT d.description, d.date, doc.first_name AS doctor_first_name, doc.last_name AS doctor_last_name
        FROM Diagnosis d
        JOIN Doctors doc ON d.doctor_id = doc.doctor_id
        WHERE d.patient_id = $patient_id
        ORDER BY d.date DESC
    ");

    while ($diagnosis = $diagnosis_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($diagnosis['description']); ?></td>
        <td><?php echo htmlspecialchars($diagnosis['doctor_first_name'] . ' ' . $diagnosis['doctor_last_name']); ?></td>
        <td><?php echo htmlspecialchars($diagnosis['date']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="add_diagnosis_form.php?patient_id=<?php echo $patient_id; ?>">Add Diagnosis</a>

<!-- Bills Section -->
<h3>Bills</h3>
<table border="1">
    <tr>
        <th>Amount</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    <?php
    $bills_result = $conn->query("
        SELECT * FROM Bills
        WHERE patient_id = $patient_id
        ORDER BY date DESC
    ");

    while ($bill = $bills_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($bill['amount']); ?></td>
        <td><?php echo htmlspecialchars($bill['status']); ?></td>
        <td><?php echo htmlspecialchars($bill['date']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="add_bill_form.php?patient_id=<?php echo $patient_id; ?>">Add Bill</a>

<!-- Emergency Contacts Section -->
<h3>Emergency Contacts</h3>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Relationship</th>
        <th>Phone</th>
    </tr>
    <?php
    $contacts_result = $conn->query("
        SELECT * FROM EmergencyContacts
        WHERE patient_id = $patient_id
    ");

    while ($contact = $contacts_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($contact['name']); ?></td>
        <td><?php echo htmlspecialchars($contact['relationship']); ?></td>
        <td><?php echo htmlspecialchars($contact['phone']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="add_emergency_contact_form.php?patient_id=<?php echo $patient_id; ?>">Add Emergency Contact</a>

<!-- Surgeries Section -->
<h3>Surgeries</h3>
<table border="1">
    <tr>
        <th>Description</th>
        <th>Doctor</th>
        <th>Surgery Date</th>
    </tr>
    <?php
    $surgeries_result = $conn->query("
        SELECT s.description, s.surgery_date, doc.first_name AS doctor_first_name, doc.last_name AS doctor_last_name
        FROM Surgeries s
        JOIN Doctors doc ON s.doctor_id = doc.doctor_id
        WHERE s.patient_id = $patient_id
        ORDER BY s.surgery_date DESC
    ");

    while ($surgery = $surgeries_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($surgery['description']); ?></td>
        <td><?php echo htmlspecialchars($surgery['doctor_first_name'] . ' ' . $surgery['doctor_last_name']); ?></td>
        <td><?php echo htmlspecialchars($surgery['surgery_date']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="add_surgery_form.php?patient_id=<?php echo $patient_id; ?>">Add Surgery</a>

<!-- Medical Records Section -->
<h3>Medical Records</h3>
<table border="1">
    <tr>
        <th>Diagnosis</th>
        <th>Treatment</th>
    </tr>
    <?php
    $records_result = $conn->query("
        SELECT mr.*, d.description AS diagnosis_description, t.name AS treatment_name
        FROM MedicalRecords mr
        LEFT JOIN Diagnosis d ON mr.diagnosis_id = d.diagnosis_id
        LEFT JOIN Treatments t ON mr.treatment_id = t.treatment_id
        WHERE mr.patient_id = $patient_id
    ");

    while ($record = $records_result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($record['diagnosis_description']); ?></td>
        <td><?php echo htmlspecialchars($record['treatment_name']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="add_medical_record_form.php?patient_id=<?php echo $patient_id; ?>">Add Medical Record</a>

<!-- Appointments Section -->
<h3>Appointments</h3>
<table border="1">
    <tr>
        <th>Doctor</th>
        <th>Date and Time</th>
        <th>Status</th>
    </tr>
    <?php
    $appointments_result = $conn->prepare("
        SELECT a.*, d.first_name AS doctor_first_name, d.last_name AS doctor_last_name
        FROM Appointments a
        JOIN Doctors d ON a.doctor_id = d.doctor_id
        WHERE a.patient_id = ?
        ORDER BY a.appointment_date DESC
    ");
    $appointments_result->bind_param("i", $patient_id);
    $appointments_result->execute();
    $appointments = $appointments_result->get_result();

    while ($appointment = $appointments->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo htmlspecialchars($appointment['doctor_last_name'] . ', ' . $appointment['doctor_first_name']); ?></td>
        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
        <td><?php echo htmlspecialchars($appointment['status']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>


<?php
$conn->close();
include '../footer.php';
?>
