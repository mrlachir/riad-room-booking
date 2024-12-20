// Register View (views/register.php)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($errorMessage)): ?>
        <p class="error"> <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?> </p>
    <?php endif; ?>

    <form action="index.php?page=register" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="index.php?page=login">Login here</a>.</p>
</body>
</html>