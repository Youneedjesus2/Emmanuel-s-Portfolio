<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $nurse_id = $_POST['nurse_id'];

    // Check if assignment already exists
    $check = $conn->prepare("SELECT * FROM NursePatient WHERE nurse_id = ? AND patient_id = ?");
    $check->bind_param("ii", $nurse_id, $patient_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows == 0) {
        // Insert into NursePatient table
        $sql = "INSERT INTO NursePatient (nurse_id, patient_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $nurse_id, $patient_id);

        if ($stmt->execute()) {
            header("Location: patient_care.php?id=$patient_id");
            exit();
        } else {
            header("Location: assign_doctor.php?patient_id=$patient_id&error=" . urlencode($stmt->error));
            exit();
        }
        $stmt->close();
    } else {
        echo "This nurse is already assigned to the patient.";
    }
    $check->close();
    $conn->close();
} else {
    $patient_id = $_GET['patient_id'];

    // Fetch list of nurses
    $result = $conn->query("SELECT nurse_id, first_name, last_name FROM Nurses");
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Assign Nurse</title></head>
    <body>
        <h2>Assign Nurse to Patient</h2>
        <form action="assign_nurse.php" method="post">
            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
            <label>Select Nurse:</label>
            <select name="nurse_id">
                <?php while ($nurse = $result->fetch_assoc()): ?>
                    <option value="<?php echo $nurse['nurse_id']; ?>">
                        <?php echo $nurse['first_name'] . ' ' . $nurse['last_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <input type="submit" value="Assign Nurse">
        </form>
        <p><a href="patient_care.php?id=<?php echo $patient_id; ?>">Back to Patient Details</a></p>
    </body>
    </html>
    <?php
    $conn->close();
}
?>
