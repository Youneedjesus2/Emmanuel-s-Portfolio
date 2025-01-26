<?php
include '../auth.php';
include '../header.php';
?>

<h2>Add New Medication</h2>

<form action="add_medication.php" method="post">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Description:</label>
    <textarea name="description"></textarea><br>

    <input type="submit" value="Add Medication">
</form>

<?php
include '../footer.php';
?>
