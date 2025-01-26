<?php
include '../auth.php';
include '../header.php';
?>

<h2>Add New Test</h2>

<form action="add_test.php" method="post">
    <label>Name:</label>
    <input type="text" name="name"><br>

    <label>Description:</label>
    <textarea name="description"></textarea><br>

    <label>Cost:</label>
    <input type="number" name="cost" step="0.01"><br>

    <input type="submit" value="Add Test">
</form>

<?php
include '../footer.php';
?>
