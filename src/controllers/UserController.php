<?php
include_once __DIR__ . '/../models/User.php';
include_once __DIR__ . '/../models/Booking.php'; // Include Booking model

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get form data
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';
                $confirmPassword = $_POST['confirm_password'] ?? '';

                // Validate inputs
                if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                    throw new Exception("All fields are required.");
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid email format.");
                }

                if ($password !== $confirmPassword) {
                    throw new Exception("Passwords do not match.");
                }

                if (strlen($password) < 8) {
                    throw new Exception("Password must be at least 8 characters long.");
                }

                // Register user
                if (User::emailExists($email)) {
                    throw new Exception("Email is already registered.");
                }

                User::register($name, $email, $password);

                // Redirect to login
                header("Location: index.php?page=login");
                exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                include __DIR__ . '/../views/register.php';
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
    }

    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $email = strtolower(trim($_POST['email']));  // Normalize email
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                throw new Exception("Email and password are required.");
            }

            $user = User::login($email, $password);
            if (!$user) {
                throw new Exception("Invalid email or password.");
            }

            // Assuming session_start() is already called in index.php
            $_SESSION['user'] = $user;  // Store user data in session
            header("Location: index.php?page=rooms");  // Redirect to a secure page
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();  // This will be passed to the login view
        }
    }

    include __DIR__ . '/../views/login.php';  // Include the login view, pass error if set
}

    public function logout()
    {
        session_start();
        session_destroy();

        // Redirect to login
        header("Location: index.php?page=login");
        exit;
    }

    public function profile()
    {
        // Check if user is logged in
        // session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        try {
            $userId = $_SESSION['user']['USER_ID'];
            $user = User::find($userId);
            $reviews = User::getReviews($userId);

            // Fetch booking history
            $bookings = Booking::getByUser($userId); // Assuming getByUser method exists in Booking model

            // Pass user, reviews, and bookings to the profile view
            include __DIR__ . '/../views/profile.php';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            include __DIR__ . '/../views/error.php';
        }
    }

    public function updateProfile()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userId = $_SESSION['user']['USER_ID'];
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $phone = trim($_POST['phone'] ?? '');

                if (empty($name) || empty($email)) {
                    throw new Exception("Name and email are required.");
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid email format.");
                }

                User::updateProfile($userId, $name, $email, $phone);

                // Update session data
                $_SESSION['user'] = User::find($userId);

                header("Location: index.php?page=profile");
                exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                include __DIR__ . '/../views/profile.php';
            }
        }
    }

    public function changePassword()
{
    // session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $userId = $_SESSION['user']['USER_ID'];
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // Validate form fields
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                throw new Exception("All fields are required.");
            }

            if ($newPassword !== $confirmPassword) {
                throw new Exception("New password and confirmation do not match.");
            }

            if (strlen($newPassword) < 8) {
                throw new Exception("New password must be at least 8 characters long.");
            }

            // Assuming User::changePassword performs password change logic
            User::changePassword($userId, $currentPassword, $newPassword);

            header("Location: index.php?page=profile");
            exit;
        } catch (Exception $e) {
            // Capture the error message and pass it to the view
            $errorMessage = $e->getMessage();
            include __DIR__ . '/../views/profile_pass.php';
            
            return;
        }
    } else {
        // Initial load of the change password page
        include __DIR__ . '/../views/profile_pass.php';
    }
}

}
