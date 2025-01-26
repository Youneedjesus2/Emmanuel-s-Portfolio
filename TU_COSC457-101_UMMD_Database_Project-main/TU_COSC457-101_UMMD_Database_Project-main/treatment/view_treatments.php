<?php
include '../auth.php';
include '../header.php';

$sql = "SELECT * FROM Treatments";
$result = $conn->query($sql);
?>

<h2>Treatments</h2>

<p><a href="add_treatment_form.php">Add New Treatment</a></p>

<table border="1">
    <tr>
        <th>Treatment Name</th>
        <th>Description</th>
        <th>Cost</th>
    </tr>
    <?php while ($treatment = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($treatment['name']); ?></td>
            <td><?php echo htmlspecialchars($treatment['description']); ?></td>
            <td><?php echo htmlspecialchars($treatment['cost']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
