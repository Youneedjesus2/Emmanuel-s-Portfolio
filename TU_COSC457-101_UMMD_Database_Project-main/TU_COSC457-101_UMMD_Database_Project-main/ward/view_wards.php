<?php
include '../auth.php';
include '../header.php';

$sql = "
    SELECT w.*, d.name AS department_name
    FROM Wards w
    LEFT JOIN Departments d ON w.department_id = d.department_id
";
$result = $conn->query($sql);
?>

<h2>Wards</h2>

<p><a href="add_ward_form.php">Add New Ward</a></p>

<table border="1">
    <tr>
        <th>Ward Name</th>
        <th>Department</th>
    </tr>
    <?php while ($ward = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($ward['name']); ?></td>
            <td><?php echo htmlspecialchars($ward['department_name']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
