<?php
include '../auth.php';
include '../header.php';

// Fetch all doctors
$sql = "SELECT * FROM Doctors";
$result = $conn->query($sql);
?>

<h2>Doctors</h2>

<p><a href="add_doctor_form.php" class="button">Add New Doctor</a></p>

<table border="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialization</th>
        <th>Actions</th>
    </tr>
    <?php while ($doctor = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($doctor['first_name']); ?></td>
            <td><?php echo htmlspecialchars($doctor['last_name']); ?></td>
            <td>
                <?php
                // Fetch specialization
                $spec_id = $doctor['specialization_id'];
                $spec_result = $conn->query("SELECT name FROM Specializations WHERE specialization_id = $spec_id");
                $spec = $spec_result->fetch_assoc();
                echo htmlspecialchars($spec['name']);
                ?>
            </td>
            <td>
                <a href="doctor_care.php?id=<?php echo $doctor['doctor_id']; ?>">Details</a> |
                <a href="edit_doctor_form.php?id=<?php echo $doctor['doctor_id']; ?>">Edit</a> |
                <a href="delete_doctor.php?id=<?php echo $doctor['doctor_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
