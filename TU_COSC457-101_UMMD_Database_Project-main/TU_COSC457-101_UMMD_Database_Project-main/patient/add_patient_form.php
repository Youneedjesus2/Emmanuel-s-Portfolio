<?php include '../header.php'; ?>

<h2>Add Patient</h2>
<form action="add_patient.php" method="post">
    <!-- Patient Information -->
    <h3>Patient Information</h3>
    <label>First Name:</label>
    <input type="text" name="first_name" required><br>

    <label>Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label>Birth Date:</label>
    <input type="date" name="birth_date" required><br>

    <label>Gender:</label>
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>

    <label>Phone:</label>
    <input type="text" name="phone"><br>

    <label>Address:</label>
    <textarea name="address"></textarea><br>

    <!-- Insurance Information -->
    <h3>Insurance Information</h3>
    <label>Select Existing Insurance:</label>
    <select name="existing_insurance_id">
        <option value="">-- None --</option>
        <?php
        // Fetch existing insurance records to populate the dropdown
        include '../auth.php';
        $result = $conn->query("SELECT insurance_id, provider_name FROM Insurance");
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row['insurance_id'] . "\">" . $row['provider_name'] . "</option>";
        }
        $conn->close();
        ?>
    </select><br>

    <p>Or add new insurance:</p>
    <label>Provider Name:</label>
    <input type="text" name="provider_name"><br>

    <label>Policy Number:</label>
    <input type="text" name="policy_number"><br>

    <label>Coverage Details:</label>
    <textarea name="coverage_details"></textarea><br>

    <input type="submit" value="Add Patient">
</form>

<?php include '../footer.php'; ?>
