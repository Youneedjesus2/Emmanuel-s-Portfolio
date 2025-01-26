<?php
include '../auth.php';
include '../header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Patients WHERE patient_id = $id");
$patient = $result->fetch_assoc();

// Fetch existing insurance records
$insurance_result = $conn->query("SELECT insurance_id, provider_name FROM Insurance");
?>

<h2>Edit Patient</h2>
<form action="update_patient.php" method="post">
    <input type="hidden" name="patient_id" value="<?php echo $patient['patient_id']; ?>">

            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo $patient['first_name']; ?>" required><br>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $patient['last_name']; ?>" required><br>

            <label>Birth Date:</label>
            <input type="date" name="birth_date" value="<?php echo $patient['birth_date']; ?>" required><br>

            <label>Gender:</label>
            <select name="gender">
                <option value="Male" <?php if ($patient['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($patient['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($patient['gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select><br>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $patient['phone']; ?>"><br>

            <label>Address:</label>
            <textarea name="address"><?php echo $patient['address']; ?></textarea><br>

            <!-- Insurance Information -->
            <h3>Insurance Information</h3>
            <label>Select Existing Insurance:</label>
            <select name="existing_insurance_id">
                <option value="">-- None --</option>
                <?php while ($row = $insurance_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['insurance_id']; ?>" <?php if ($patient['insurance_id'] == $row['insurance_id']) echo 'selected'; ?>>
                        <?php echo $row['provider_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select><br>

            <p>Or add new insurance:</p>
            <label>Provider Name:</label>
            <input type="text" name="provider_name"><br>

            <label>Policy Number:</label>
            <input type="text" name="policy_number"><br>

            <label>Coverage Details:</label>
            <textarea name="coverage_details"></textarea><br>

            <input type="submit" value="Update Patient">
</form>

<?php
$conn->close();
include '../footer.php';
?>
