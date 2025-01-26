<?php
include '../auth.php';
include '../header.php';

$sql = "SELECT * FROM Departments";
$result = $conn->query($sql);
?>

<h2>Departments</h2>

<p><a href="add_department_form.php">Add New Department</a></p>

<table border="1">
    <tr>
        <th>Department Name</th>
        <th>Description</th>
    </tr>
    <?php while ($department = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($department['name']); ?></td>
            <td><?php echo htmlspecialchars($department['description']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
