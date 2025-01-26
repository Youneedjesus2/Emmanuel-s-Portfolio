<?php
include '../auth.php';
include '../header.php';

$sql = "
    SELECT ss.*, u.username
    FROM StaffSchedules ss
    JOIN Users u ON ss.staff_id = u.user_id
    ORDER BY ss.work_date DESC
";
$result = $conn->query($sql);
?>

<h2>Staff Schedules</h2>

<p><a href="add_schedule_form.php">Add Staff Schedule</a></p>

<table border="1">
    <tr>
        <th>Staff</th>
        <th>Role</th>
        <th>Work Date</th>
        <th>Shift</th>
    </tr>
    <?php while ($schedule = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($schedule['username']); ?></td>
            <td><?php echo htmlspecialchars($schedule['role']); ?></td>
            <td><?php echo htmlspecialchars($schedule['work_date']); ?></td>
            <td><?php echo htmlspecialchars($schedule['shift']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
