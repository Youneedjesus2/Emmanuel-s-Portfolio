<?php
include '../auth.php';
include '../header.php';

// Fetch departments for dropdown
$departments = $conn->query("SELECT * FROM Departments");
?>

<h2>Add New Nurse</h2>

<form action="add_nurse.php" method="post">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" required><br><br>

    <label for="department_id">Department:</label>
    <select name="department_id" id="department_id" required>
        <option value="">--Select Department--</option>
        <?php while ($department = $departments->fetch_assoc()): ?>
            <option value="<?php echo $department['department_id']; ?>">
                <?php echo htmlspecialchars($department['name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Add Nurse">
</form>

<?php
$conn->close();
include '../footer.php';
?>
