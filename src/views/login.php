<?php 
include 'layout/navbar.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
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
    align-items: center;
    justify-content: center;
}

.container {
    width: 100%;
    padding: 20px;
}

/* Login box styles */
.login-box {
    background: white;
    max-width: 400px;
    margin: 0 auto;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
}

/* Form styles */
.form-group {
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
}

button:hover {
    background: #357abd;
}

/* Links styles */
.links {
    margin-top: 1.5rem;
    text-align: center;
}

.links p {
    margin: 0.5rem 0;
    color: #666;
    font-size: 0.9rem;
}

.links a {
    color: #4a90e2;
    text-decoration: none;
    transition: color 0.3s ease;
}

.links a:hover {
    color: #357abd;
}

/* Error message styles */
.error-message {
    background: #ffe6e6;
    color: #d63031;
    padding: 0.8rem;
    border-radius: 5px;
    margin-bottom: 1.5rem;
    text-align: center;
}

/* Responsive design */
@media (max-width: 480px) {
    .login-box {
        padding: 1.5rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    input, button {
        padding: 0.7rem;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>

            <?php if (isset($error) && !empty($error)): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>

            <form action="index.php?page=login" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Login</button>
            </form>

            <div class="links">
                <p>Don't have an account? <a href="index.php?page=register">Register here</a></p>
                <p><a href="index.php?page=forgot-password">Forgot Password?</a></p>
            </div>
        </div>
    </div>
</body>
</html>
