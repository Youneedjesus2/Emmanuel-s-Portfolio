<?php
include 'header.php';
?>
    <h2>Login</h2>
    <form action="auth.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        
        <input type="submit" name="login" value="Login">
    </form>

<?php
include 'footer.php';
?>