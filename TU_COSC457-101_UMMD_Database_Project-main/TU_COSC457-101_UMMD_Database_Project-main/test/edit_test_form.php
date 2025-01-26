<?php
include '../auth.php';
include '../header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $test_id = $_GET['id'];

    $sql = "SELECT * FROM Tests WHERE test_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $test_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $test = $result->fetch_assoc();

    if (!$test) {
        header("Location: manage_tests.php?error=" . urlencode("Test not found."));
        exit();
    }
} else {
    header("Location: manage_tests.php?error=" . urlencode("Invalid test ID."));
    exit();
}
?>

<h2>Edit Test</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<form action="update_test.php" method="post">
    <input type="hidden" name="test_id" value="<?php echo $test['test_id']; ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($test['name']); ?>" required><br>

    <label>Description:</label>
    <textarea name="description"><?php echo htmlspecialchars($test['description']); ?></textarea><br>

    <label>Cost:</label>
    <input type="number" name="cost" step="0.01" value="<?php echo htmlspecialchars($test['cost']); ?>" required><br>

    <input type="submit" value="Update Test">
</form>

<?php
$stmt->close();
$conn->close();
include '../footer.php';
?>
