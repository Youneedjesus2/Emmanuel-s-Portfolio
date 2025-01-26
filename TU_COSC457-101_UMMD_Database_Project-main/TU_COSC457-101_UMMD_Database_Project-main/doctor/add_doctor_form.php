<?php
include '../auth.php';
include '../header.php';

// Fetch specializations for dropdown
$specializations = $conn->query("SELECT * FROM Specializations");
?>

<h2>Add New Doctor</h2>

<form action="add_doctor.php" method="post">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" required><br><br>

    <label for="specialization_id">Specialization:</label>
    <select name="specialization_id" id="specialization_id" required>
        <option value="">--Select Specialization--</option>
        <?php while ($specialization = $specializations->fetch_assoc()): ?>
            <option value="<?php echo $specialization['specialization_id']; ?>">
                <?php echo htmlspecialchars($specialization['name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Add Doctor">
</form>

<?php
$conn->close();
include '../footer.php';
?>
