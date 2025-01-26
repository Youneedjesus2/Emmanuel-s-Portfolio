<?php
include '../auth.php';
include '../header.php';
?>

<h2>Add New Treatment</h2>

<form action="add_treatment.php" method="post">
    <label for="name">Treatment Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description"></textarea><br><br>

    <label for="cost">Cost:</label>
    <input type="number" step="0.01" name="cost" required><br><br>

    <input type="submit" value="Add Treatment">
</form>

<?php
include '../footer.php';
?>
