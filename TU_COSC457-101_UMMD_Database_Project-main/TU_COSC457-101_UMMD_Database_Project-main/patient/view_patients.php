<?php
include '../auth.php';
include '../header.php';

// Get all insurance providers for the filter
$insuranceQuery = "SELECT DISTINCT provider_name FROM Insurance";
$insuranceResult = $conn->query($insuranceQuery);

// Get selected insurance provider from the form
$selectedInsurance = $_GET['insurance_provider'] ?? '';

$sql = "SELECT
            Patients.first_name,
            Patients.last_name,
            Patients.birth_date,
            Patients.gender,
            Patients.phone,
            Patients.address,
            Insurance.provider_name,
            Patients.patient_id
        FROM Patients
        LEFT JOIN Insurance ON Patients.insurance_id = Insurance.insurance_id";

if (!empty($selectedInsurance)) {
    $sql .= " WHERE Insurance.provider_name = ?";
}

$stmt = $conn->prepare($sql);
if (!empty($selectedInsurance)) {
    $stmt->bind_param('s', $selectedInsurance);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Patients</h2>

<!-- Filter Form -->
<form method="GET" action="">
    <label for="insurance_provider">Filter by Insurance Provider:</label>
    <select name="insurance_provider" id="insurance_provider">
        <option value="">All Providers</option>
        <?php while ($row = $insuranceResult->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($row['provider_name']); ?>"
                <?php echo $row['provider_name'] === $selectedInsurance ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($row['provider_name']); ?>
            </option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Filter</button>
</form>

<p><a href="add_patient_form.php" class="button">Add New Patient</a></p>

<table border="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birth Date</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Insurance Provider</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
            <td><?php echo htmlspecialchars($row['birth_date']); ?></td>
            <td><?php echo htmlspecialchars($row['gender']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['address']); ?></td>
            <td><?php echo htmlspecialchars($row['provider_name'] ?? 'N/A'); ?></td>
            <td>
                <a href="patient_care.php?id=<?php echo $row['patient_id']; ?>">Care</a> |
                <a href="edit_patient_form.php?id=<?php echo $row['patient_id']; ?>">Edit</a> |
                <a href="delete_patient.php?id=<?php echo $row['patient_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
