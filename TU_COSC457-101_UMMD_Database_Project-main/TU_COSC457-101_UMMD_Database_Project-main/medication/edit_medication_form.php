<?php
include '../auth.php';
include '../header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $medication_id = $_GET['id'];

    $sql = "SELECT * FROM Medications WHERE medication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medication_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medication = $result->fetch_assoc();

    if (!$medication) {
        header("Location: view_medications.php?error=" . urlencode("Medication not found."));
        exit();
    }
} else {
    header("Location: view_medications.php?error=" . urlencode("Invalid medication ID."));
    exit();
}
?>

<h2>Edit Medication</h2>

<form action="update_medication.php" method="post">
    <input type="hidden" name="medication_id" value="<?php echo $medication['medication_id']; ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($medication['name']); ?>" required><br>

    <label>Description:</label>
    <textarea name="description"><?php echo htmlspecialchars($medication['description']); ?></textarea><br>

    <input type="submit" value="Update Medication">
</form>

<?php
$stmt->close();
$conn->close();
include '../footer.php';
?>
