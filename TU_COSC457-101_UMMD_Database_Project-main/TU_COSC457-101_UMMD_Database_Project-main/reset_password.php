<?php
include 'header.php';
?>

    <h2>Reset Password</h2>
    <form action="auth.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br>
        
        <input type="submit" name="reset_password" value="Reset Password">
    </form>

<?php
include 'footer.php';
?>
