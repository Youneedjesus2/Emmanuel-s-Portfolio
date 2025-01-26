<?php
include '../auth.php';
include '../header.php';

$patient_id = $_GET['patient_id'];
?>

<h2>Add Emergency Contact</h2>

<form action="add_emergency_contact.php" method="post">
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="relationship">Relationship:</label>
    <input type="text" name="relationship" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" required><br><br>

    <input type="submit" value="Add Emergency Contact">
</form>

<?php
include '../footer.php';
?>
