<?php
include_once __DIR__ . '/../models/User.php';

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

                User::register($name, $email, password_hash($password, PASSWORD_BCRYPT));

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

    // public function login() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         try {
    //             $email = trim($_POST['email'] ?? '');
    //             $password = $_POST['password'] ?? '';

    //             // Validate inputs
    //             if (empty($email) || empty($password)) {
    //                 throw new Exception("Email and password are required.");
    //             }

    //             $user = User::login($email, $password);
    //             if (!$user) {
    //                 throw new Exception("Invalid email or password.");
    //             }

    //             // Start session and store user data
    //             session_start();
    //             $_SESSION['user'] = $user;

    //             // Redirect to dashboard
    //             header("Location: index.php?page=rooms");
    //             exit;
    //         } catch (Exception $e) {
    //             $errorMessage = $e->getMessage();
    //             include __DIR__ . '/../views/login.php';
    //         }
    //     } else {
    //         include __DIR__ . '/../views/login.php';
    //     }
    // }
    public function login()
    {
        // Default error variable
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $email = trim($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';

                // Validate inputs
                if (empty($email) || empty($password)) {
                    throw new Exception("Email and password are required.");
                }

                // Attempt login
                $user = User::login($email, $password);
                if (!$user) {
                    throw new Exception("Invalid email or password.");
                }

                // Start session and store user data
                session_start();
                $_SESSION['user'] = $user;

                // Redirect to dashboard
                header("Location: index.php?page=rooms");
                exit;
            } catch (Exception $e) {
                // Set error message for the view
                $error = $e->getMessage();
            }
        }

        // Include the login view
        include __DIR__ . '/../views/login.php';
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
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        try {
            $userId = $_SESSION['user']['USER_ID'];
            $user = User::find($userId);
            $reviews = User::getReviews($userId);

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
        session_start();
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

                if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                    throw new Exception("All fields are required.");
                }

                if ($newPassword !== $confirmPassword) {
                    throw new Exception("New password and confirmation do not match.");
                }

                if (strlen($newPassword) < 8) {
                    throw new Exception("New password must be at least 8 characters long.");
                }

                User::changePassword($userId, $currentPassword, password_hash($newPassword, PASSWORD_BCRYPT));

                header("Location: index.php?page=profile");
                exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                include __DIR__ . '/../views/change_password.php';
            }
        } else {
            include __DIR__ . '/../views/change_password.php';
        }
    }
}
