<?php
include '../auth.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $patient_test_id = $_POST['patient_test_id'];
    $status = $_POST['status'];
    $result = $_POST['result'];

    // Prepare the SQL statement
    $sql = "UPDATE PatientTests SET status = ?, result = ? WHERE patient_test_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $result, $patient_test_id);

    if ($stmt->execute()) {
        // Retrieve doctor ID to redirect back to doctor care page
        $doctor_result = $conn->query("SELECT doctor_id FROM PatientTests WHERE patient_test_id = $patient_test_id");
        $doctor = $doctor_result->fetch_assoc();
        $doctor_id = $doctor['doctor_id'];

        header("Location: patient_care.php?id=$doctor_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Display the form
    $patient_test_id = $_GET['patient_test_id'];

    // Fetch test order details
    $test_order_result = $conn->query("
        SELECT pt.*, t.name AS test_name
        FROM PatientTests pt
        JOIN Tests t ON pt.test_id = t.test_id
        WHERE pt.patient_test_id = $patient_test_id
    ");
    $test_order = $test_order_result->fetch_assoc();

    if (!$test_order) {
        die("Test order not found.");
    }

    ?>
    <h2>Update Test Status for <?php echo htmlspecialchars($test_order['test_name']); ?></h2>

    <form action="update_test_status.php" method="post">
        <input type="hidden" name="patient_test_id" value="<?php echo $patient_test_id; ?>">

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="Ordered" <?php if ($test_order['status'] == 'Ordered') echo 'selected'; ?>>Ordered</option>
            <option value="In Progress" <?php if ($test_order['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
            <option value="Completed" <?php if ($test_order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            <option value="Cancelled" <?php if ($test_order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        <br><br>

        <label for="result">Result:</label><br>
        <textarea name="result" id="result" rows="5" cols="50"><?php echo htmlspecialchars($test_order['result']); ?></textarea>
        <br><br>

        <input type="submit" value="Update Test">
    </form>

    <?php
    $conn->close();
    include '../footer.php';
}
?>
