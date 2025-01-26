<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];

    // Check if assignment already exists
    $check = $conn->prepare("SELECT * FROM DoctorPatient WHERE doctor_id = ? AND patient_id = ?");
    $check->bind_param("ii", $doctor_id, $patient_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows == 0) {
        // Insert into DoctorPatient table
        $sql = "INSERT INTO DoctorPatient (doctor_id, patient_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $doctor_id, $patient_id);

        if ($stmt->execute()) {
            header("Location: patient_care.php?id=$patient_id");
            exit();
        } else {
            header("Location: assign_doctor.php?patient_id=$patient_id&error=" . urlencode($stmt->error));
            exit();
        }
        $stmt->close();
    } else {
        echo "This doctor is already assigned to the patient.";
    }
    $check->close();
    $conn->close();
} else {
    $patient_id = $_GET['patient_id'];

    // Fetch list of doctors
    $result = $conn->query("SELECT doctor_id, first_name, last_name FROM Doctors");
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Assign Doctor</title></head>
    <body>
        <h2>Assign Doctor to Patient</h2>
        <form action="assign_doctor.php" method="post">
            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
            <label>Select Doctor:</label>
            <select name="doctor_id">
                <?php while ($doctor = $result->fetch_assoc()): ?>
                    <option value="<?php echo $doctor['doctor_id']; ?>">
                        <?php echo $doctor['first_name'] . ' ' . $doctor['last_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <input type="submit" value="Assign Doctor">
        </form>
        <p><a href="patient_care.php?id=<?php echo $patient_id; ?>">Back to Patient Details</a></p>
    </body>
    </html>
    <?php
    $conn->close();
}
?>
