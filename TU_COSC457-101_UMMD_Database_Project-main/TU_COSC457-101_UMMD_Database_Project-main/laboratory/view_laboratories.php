<?php
include '../auth.php';
include '../header.php';

$sql = "
    SELECT l.*, d.name AS department_name
    FROM Laboratories l
    LEFT JOIN Departments d ON l.department_id = d.department_id
";
$result = $conn->query($sql);
?>

<h2>Laboratories</h2>

<p><a href="add_laboratory_form.php">Add New Laboratory</a></p>

<table border="1">
    <tr>
        <th>Laboratory Name</th>
        <th>Department</th>
    </tr>
    <?php while ($lab = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($lab['name']); ?></td>
            <td><?php echo htmlspecialchars($lab['department_name']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
