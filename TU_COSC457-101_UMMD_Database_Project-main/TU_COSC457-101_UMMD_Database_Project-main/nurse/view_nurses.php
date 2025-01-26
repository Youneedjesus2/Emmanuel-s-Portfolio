<?php
include '../auth.php';
include '../header.php';

// Fetch all nurses
$sql = "SELECT * FROM Nurses";
$result = $conn->query($sql);
?>

<h2>Nurses</h2>

<p><a href="add_nurse_form.php" class="button">Add New Nurse</a></p>

<table border="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Department</th>
        <th>Actions</th>
    </tr>
    <?php while ($nurse = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($nurse['first_name']); ?></td>
            <td><?php echo htmlspecialchars($nurse['last_name']); ?></td>
            <td>
                <?php
                // Fetch department
                $dept_id = $nurse['department_id'];
                $dept_result = $conn->query("SELECT name FROM Departments WHERE department_id = $dept_id");
                $department = $dept_result->fetch_assoc();
                echo htmlspecialchars($department['name']);
                ?>
            </td>
            <td>
                <a href="nurse_care.php?id=<?php echo $nurse['nurse_id']; ?>">Details</a> |
                <a href="edit_nurse_form.php?id=<?php echo $nurse['nurse_id']; ?>">Edit</a> |
                <a href="delete_nurse.php?id=<?php echo $nurse['nurse_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
