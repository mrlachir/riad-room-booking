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
/* Global styles */
/* Global styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(135deg, #f8f3ed, #f5e8d0);
    color: #444;
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
    max-width: 450px;
    margin: 0 auto;
}

/* Common box styles for login and register */
.login-box, form {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border: 1px solid #e2d9c7;
    animation: fadeIn 0.6s ease-in-out;
}

/* Header styles */
h1 {
    color: #8c6239;
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 2rem;
    font-weight: bold;
    letter-spacing: 2px;
}

h1::after {
    content: '';
    display: block;
    width: 80px;
    height: 3px;
    background: #8c6239;
    margin: 1rem auto 0;
    border-radius: 2px;
}

/* Form styles */
.form-group, form > div {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #6d5846;
    font-size: 1rem;
    font-weight: 500;
}

input {
    width: 100%;
    padding: 0.9rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    margin-bottom: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    background: #f9f4ec;
}

input:focus {
    outline: none;
    border-color: #8c6239;
    box-shadow: 0 0 8px rgba(140, 98, 57, 0.4);
}

button {
    width: 100%;
    padding: 0.9rem;
    background: #8c6239;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-top: 1rem;
}

button:hover {
    background: #6d5846;
    transform: translateY(-2px);
}

/* Links styles */
.links, p {
    margin-top: 1.5rem;
    text-align: center;
    color: #6d5846;
    font-size: 0.9rem;
}

a {
    color: #8c6239;
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: 600;
}

a:hover {
    color: #6d5846;
}

/* Error message styles */
.error-message, .error {
    background: #ffe6e6;
    color: #d63031;
    padding: 0.8rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    text-align: center;
    font-size: 0.95rem;
    font-weight: 500;
}

/* Custom form decorations */
input[type="text"], input[type="email"], input[type="password"] {
    background: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" fill="%238C6239" viewBox="0 0 24 24"><path d="M20 21H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2zm0-2V5H4v14h16z"></path></svg>') no-repeat 10px center;
    background-size: 18px;
    padding-left: 40px;
}

/* Responsive design */
@media (max-width: 480px) {
    form, .login-box {
        padding: 1.5rem;
    }

    h1 {
        font-size: 1.6rem;
    }

    input, button {
        padding: 0.8rem;
    }
}

/* Animation for form appearance */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
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
<?php include __DIR__ . '/layout/footer.php'; ?>