<?php
include '../auth.php';

$id = $_GET['id'];

$sql = "DELETE FROM Tests WHERE test_id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: view_tests.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
