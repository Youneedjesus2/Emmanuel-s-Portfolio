<?php
include '../auth.php';
include '../header.php';

$sql = "SELECT * FROM Medications";
$result = $conn->query($sql);
?>

<h2>Medications</h2>

<p><a href="add_medication_form.php">Add New Medication</a></p>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while ($medication = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($medication['name']); ?></td>
            <td><?php echo htmlspecialchars($medication['description']); ?></td>
            <td>
                <a href="edit_medication_form.php?id=<?php echo $medication['medication_id']; ?>">Edit</a> |
                <a href="delete_medication.php?id=<?php echo $medication['medication_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
