<?php
include '../auth.php';
include '../header.php';

$sql = "SELECT * FROM Tests";
$result = $conn->query($sql);
?>

<h2>Tests</h2>

<p><a href="add_test_form.php">Add New Test</a></p>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Cost</th>
        <th>Actions</th>
    </tr>
    <?php while ($test = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $test['name']; ?></td>
            <td><?php echo $test['description']; ?></td>
            <td><?php echo $test['cost']; ?></td>
            <td>
                <a href="edit_test_form.php?id=<?php echo $test['test_id']; ?>">Edit</a> |
                <a href="delete_test.php?id=<?php echo $test['test_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
include '../footer.php';
?>
