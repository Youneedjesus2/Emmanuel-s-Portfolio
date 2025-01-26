<?php
include '../auth.php';
include '../header.php';

// Fetch departments for dropdown
$departments = $conn->query("SELECT * FROM Departments");
?>

<h2>Add New Ward</h2>

<form action="add_ward.php" method="post">
    <label for="name">Ward Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="department_id">Department:</label>
    <select name="department_id" required>
        <option value="">--Select Department--</option>
        <?php while ($department = $departments->fetch_assoc()): ?>
            <option value="<?php echo $department['department_id']; ?>">
                <?php echo htmlspecialchars($department['name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Add Ward">
</form>

<?php
include '../footer.php';
?>
