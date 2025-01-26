<?php
include '../auth.php';
include '../header.php';
?>

<h2>Add New Department</h2>

<form action="add_department.php" method="post">
    <label for="name">Department Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description"></textarea><br><br>

    <input type="submit" value="Add Department">
</form>

<?php
include '../footer.php';
?>
