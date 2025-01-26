<?php
include '../auth.php';
include '../header.php';

$doctor_id = $_GET['id'];

// Fetch doctor details
$doctor_result = $conn->query("SELECT * FROM Doctors WHERE doctor_id = $doctor_id");
$doctor = $doctor_result->fetch_assoc();

if (!$doctor) {
    die("Doctor not found.");
}

// Fetch specializations for dropdown
$specializations = $conn->query("SELECT * FROM Specializations");
?>

<h2>Edit Doctor</h2>

<form action="update_doctor.php" method="post">
    <input type="hidden" name="doctor_id" value="<?php echo $doctor['doctor_id']; ?>">

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($doctor['first_name']); ?>" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($doctor['last_name']); ?>" required><br><br>

    <label for="specialization_id">Specialization:</label>
    <select name="specialization_id" id="specialization_id" required>
        <option value="">--Select Specialization--</option>
        <?php while ($specialization = $specializations->fetch_assoc()): ?>
            <option value="<?php echo $specialization['specialization_id']; ?>" <?php if ($specialization['specialization_id'] == $doctor['specialization_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($specialization['name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Update Doctor">
</form>

<?php
$conn->close();
include '../footer.php';
?>
