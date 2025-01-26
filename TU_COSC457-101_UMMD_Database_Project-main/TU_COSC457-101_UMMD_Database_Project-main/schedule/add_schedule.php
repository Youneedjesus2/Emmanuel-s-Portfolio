<?php
include '../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staff_id = $_POST['staff_id'];
    $role = $_POST['role'];
    $work_date = $_POST['work_date'];
    $shift = $_POST['shift'];

    $stmt = $conn->prepare("INSERT INTO StaffSchedules (staff_id, role, work_date, shift) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $staff_id, $role, $work_date, $shift);

    if ($stmt->execute()) {
        header("Location: view_schedules.php");
        exit();
    } else {
        echo "Error adding schedule: " . $stmt->error;
    }
}

$conn->close();
?>
