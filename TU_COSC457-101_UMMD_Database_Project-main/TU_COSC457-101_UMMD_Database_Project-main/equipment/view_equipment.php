<?php
include '../auth.php';
include '../header.php';

$sql = "
    SELECT e.*, d.name AS department_name
    FROM Equipment e
    LEFT JOIN Departments d ON e.department_id = d.department_id
";
$result = $conn->query($sql);
?>

<h2>Equipment</h2>

<p><a href="add_equipment_form.php">Add New Equipment</a></p>

<table border="1">
    <tr>
        <th>Equipment Name</th>
        <th>Description</th>
        <th>Department</th>
    </tr>
    <?php while ($equipment = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($equipment['name']); ?></td>
            <td><?php echo htmlspecialchars($equipment['description']); ?></td>
            <td><?php echo htmlspecialchars($equipment['department_name']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
