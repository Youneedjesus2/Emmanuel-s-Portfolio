<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Patient Information
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insurance Information
    $existing_insurance_id = $_POST['existing_insurance_id'];
    $provider_name = $_POST['provider_name'];
    $policy_number = $_POST['policy_number'];
    $coverage_details = $_POST['coverage_details'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Determine insurance_id to use
        if (!empty($existing_insurance_id)) {
            // Use selected existing insurance
            $insurance_id = $existing_insurance_id;
        } elseif (!empty($provider_name) && !empty($policy_number)) {
            // Add new insurance and get insurance_id
            $sql = "INSERT INTO Insurance (provider_name, policy_number, coverage_details) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $provider_name, $policy_number, $coverage_details);
            if ($stmt->execute()) {
                $insurance_id = $conn->insert_id;
            } else {
                throw new Exception("Error adding insurance: " . $stmt->error);
            }
            $stmt->close();
        } else {
            // No insurance information provided
            $insurance_id = NULL;
        }

        // Insert patient data
        $sql = "INSERT INTO Patients (first_name, last_name, birth_date, gender, phone, address, insurance_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $first_name, $last_name, $birth_date, $gender, $phone, $address, $insurance_id);

        if ($stmt->execute()) {
            $new_patient_id = $conn->insert_id;
            $conn->commit();
            // Redirect to patient details page
            header("Location: patient_care.php?id=$new_patient_id");
            exit();
        } else {
            throw new Exception("Error adding patient: " . $stmt->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        // Redirect back to add patient form with an error message
        header("Location: add_patient_form.php?error=" . urlencode($e->getMessage()));
        exit();
    }

    $conn->close();
}
?>
