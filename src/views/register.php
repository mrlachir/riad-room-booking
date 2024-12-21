<?php 
include 'layout/navbar.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
    <style>
        /* Global styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background: #f5f5f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* Form container styles */
.container, form {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}

/* Common box styles for login and register */
.login-box, form {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

/* Header styles */
h1, h2 {
    color: #333;
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
}

/* Form styles */
.form-group, form > div {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #555;
    font-size: 0.9rem;
}

input {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    margin-bottom: 1rem;
    transition: border-color 0.3s ease;
}

input:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.2);
}

button {
    width: 100%;
    padding: 0.8rem;
    background: #4a90e2;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 1rem;
}

button:hover {
    background: #357abd;
}

/* Links styles */
.links, p {
    margin-top: 1.5rem;
    text-align: center;
    color: #666;
    font-size: 0.9rem;
}

a {
    color: #4a90e2;
    text-decoration: none;
    transition: color 0.3s ease;
}

a:hover {
    color: #357abd;
}

/* Error message styles */
.error-message, .error {
    background: #ffe6e6;
    color: #d63031;
    padding: 0.8rem;
    border-radius: 5px;
    margin-bottom: 1.5rem;
    text-align: center;
}

/* Responsive design */
@media (max-width: 480px) {
    form, .login-box {
        padding: 1.5rem;
    }

    h1, h2 {
        font-size: 1.5rem;
    }

    input, button {
        padding: 0.7rem;
    }
}
    </style>
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