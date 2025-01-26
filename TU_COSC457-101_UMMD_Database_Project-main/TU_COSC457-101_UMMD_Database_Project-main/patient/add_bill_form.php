<?php
include '../auth.php';
include '../header.php';

$patient_id = $_GET['patient_id'];
?>

<h2>Add Bill</h2>

<form action="add_bill.php" method="post">
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

    <label for="amount">Amount:</label>
    <input type="number" step="0.01" name="amount" required><br><br>

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="Unpaid">Unpaid</option>
        <option value="Paid">Paid</option>
    </select><br><br>

    <label for="date">Date:</label>
    <input type="date" name="date" required><br><br>

    <input type="submit" value="Add Bill">
</form>

<?php
include '../footer.php';
?>
