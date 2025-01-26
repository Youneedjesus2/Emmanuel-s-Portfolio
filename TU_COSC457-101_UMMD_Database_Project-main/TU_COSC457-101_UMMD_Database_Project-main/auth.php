<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MedicalDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (username, password_hash, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            echo "Login successful!";
            // Set session or cookie here
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that username!";
    }
}

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $sql = "UPDATE Users SET password_hash='$new_password' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Password reset successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
