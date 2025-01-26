<?php
include '../auth.php';
include '../header.php';

$nurse_id = intval($_GET['id']);

// Fetch nurse details
$stmt = $conn->prepare("SELECT * FROM Nurses WHERE nurse_id = ?");
$stmt->bind_param("i", $nurse_id);
$stmt->execute();
$nurse_result = $stmt->get_result();
$nurse = $nurse_result->fetch_assoc();
$stmt->close();

if (!$nurse) {
    echo "<p>Nurse not found.</p>";
    exit();
}

// Fetch assigned patients
$stmt = $conn->prepare("
    SELECT p.patient_id, p.first_name, p.last_name
    FROM Patients p
    JOIN NursePatient np ON p.patient_id = np.patient_id
    WHERE np.nurse_id = ?
");
$stmt->bind_param("i", $nurse_id);
$stmt->execute();
$patients_result = $stmt->get_result();
$stmt->close();
?>

<h2>Nurse Details</h2>
<p><strong>Name:</strong> <?php echo htmlspecialchars($nurse['first_name'] . ' ' . $nurse['last_name']); ?></p>
<p><strong>Department:</strong>
    <?php
    // Fetch department
    $dept_id = $nurse['department_id'];
    $stmt = $conn->prepare("SELECT name FROM Departments WHERE department_id = ?");
    $stmt->bind_param("i", $dept_id);
    $stmt->execute();
    $dept_result = $stmt->get_result();
    $department = $dept_result->fetch_assoc();
    $stmt->close();
    echo htmlspecialchars($department['name']);
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

<?php
$conn->close();
include '../footer.php';
?>
