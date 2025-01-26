<?php
include '../auth.php';
include '../header.php';

// Fetch doctors
$doctors_result = $conn->query("
    SELECT u.user_id, u.username, d.doctor_id, 'doctor' AS role
    FROM Users u
    JOIN Doctors d ON u.user_id = d.user_id
");

// Fetch nurses
$nurses_result = $conn->query("
    SELECT u.user_id, u.username, n.nurse_id, 'nurse' AS role
    FROM Users u
    JOIN Nurses n ON u.user_id = n.user_id
");

$staff = [];

// Combine doctors and nurses into one array
while ($doctor = $doctors_result->fetch_assoc()) {
    $staff[] = $doctor;
}
while ($nurse = $nurses_result->fetch_assoc()) {
    $staff[] = $nurse;
}

?>

<h2>Add Staff Schedule</h2>

<form action="add_schedule.php" method="post">
    <label for="staff_id">Staff:</label>
    <select name="staff_id" required>
        <?php foreach ($staff as $member): ?>
            <option value="<?php echo $member['user_id']; ?>">
                <?php echo htmlspecialchars($member['username'] . ' (' . $member['role'] . ')'); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="role">Role:</label>
    <select name="role" required>
        <option value="doctor">Doctor</option>
        <option value="nurse">Nurse</option>
    </select><br><br>

    <label for="work_date">Work Date:</label>
    <input type="date" name="work_date" required><br><br>

    <label for="shift">Shift:</label>
    <select name="shift" required>
        <option value="Morning">Morning</option>
        <option value="Afternoon">Afternoon</option>
        <option value="Night">Night</option>
    </select><br><br>

    <input type="submit" value="Add Schedule">
</form>

<?php
include '../footer.php';
?>
