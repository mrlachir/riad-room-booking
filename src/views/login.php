<?php
include __DIR__ . '/layout/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            /* Update this to match your theme's typography */
            background-color: #f9f4ef;
            /* Neutral background color for a cozy feel */
            color: #333;
            /* Text color for readability */
            margin: 0;
            padding: 0;
        }

        /* Centered Form Container */
        form {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        /* Labels and Inputs */
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #d4a373;
            /* Match theme accent color */
            outline: none;
        }

        /* Buttons */
        button {
            width: 100%;
            padding: 12px;
            background-color: #d4a373;
            /* Match theme accent color */
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b9845c;
            /* Darken on hover */
        }

        /* Error Messages */
        .error-message {
            background-color: #f8d7da;
            color: #842029;
            padding: 10px;
            border: 1px solid #f5c2c7;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Links */
        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #d4a373;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #b9845c;
            /* Darken on hover */
        }
    </style>
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
    </div>
</body>

</html>
<?php
include __DIR__ . '/layout/footer.php';
?>