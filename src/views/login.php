<h2>Login</h2>

<?php if (isset($error) && !empty($error)): ?>
    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form action="index.php?page=login" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
</form>

<div class="links">
    <p>Don't have an account? <a href="index.php?page=register">Register here</a></p>
    <p><a href="index.php?page=forgot-password">Forgot Password?</a></p>
</div>

<?php
// Manually testing the password verification
$hash = '$2y$10$NRthEhC7R0UoXZL0B4Rr0uaLMKUToBRsWVx5aqD/19el2.axXopem';
$password = '12345678';

if (password_verify($password, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Password is invalid!';
}
$newHash = password_hash('12345678', PASSWORD_BCRYPT);
echo $newHash;

?>
