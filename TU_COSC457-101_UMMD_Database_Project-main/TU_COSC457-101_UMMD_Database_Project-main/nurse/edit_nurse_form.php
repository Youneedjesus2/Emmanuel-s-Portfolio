<?php
include '../auth.php';
include '../header.php';

$nurse_id = $_GET['id'];

// Fetch nurse details
$nurse_result = $conn->query("SELECT * FROM Nurses WHERE nurse_id = $nurse_id");
$nurse = $nurse_result->fetch_assoc();

if (!$nurse) {
    die("Nurse not found.");
}

// Fetch departments for dropdown
$departments = $conn->query("SELECT * FROM Departments");
?>

<h2>Edit Nurse</h2>

<form action="update_nurse.php" method="post">
    <input type="hidden" name="nurse_id" value="<?php echo $nurse['nurse_id']; ?>">

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($nurse['first_name']); ?>" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($nurse['last_name']); ?>" required><br><br>

    <label for="department_id">Department:</label>
    <select name="department_id" id="department_id" required>
        <option value="">--Select Department--</option>
        <?php while ($department = $departments->fetch_assoc()): ?>
            <option value="<?php echo $department['department_id']; ?>" <?php if ($department['department_id'] == $nurse['department_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($department['name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Update Nurse">
</form>

<?php
$conn->close();
include '../footer.php';
?>
