<?php
include_once __DIR__ . '/../models/User.php';

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get form data
                $name = $_POST['name'] ?? null;
                $email = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;

                // Validate inputs
                if (empty($name) || empty($email) || empty($password)) {
                    throw new Exception("All fields are required.");
                }

                // Register user
                User::register($name, $email, $password);

                // Redirect to login
                header("Location: index.php?page=login");
                exit;
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get form data
                $email = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;

                // Validate inputs
                if (empty($email) || empty($password)) {
                    throw new Exception("Email and password are required.");
                }

                // Attempt login
                $user = User::login($email, $password);
                if ($user) {
                    // Start session and store user data
                    session_start();
                    $_SESSION['user'] = $user;

                    // Redirect to dashboard or home
                    header("Location: index.php?page=rooms");
                    exit;
                } else {
                    throw new Exception("Invalid email or password.");
                }
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        } else {
            include __DIR__ . '/../views/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();

        // Redirect to login
        header("Location: index.php?page=login");
        exit;
    }
    public function profile() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $userId = $_SESSION['user']['USER_ID'];

        try {
            // Fetch user details
            $user = User::find($userId);

            // Fetch booking history
            // $bookings = Booking::getByUser($userId);

            // Fetch reviews
            $reviews = User::getReviews($userId);

            // Pass data to the profile view
            include __DIR__ . '/../views/profile.php';
        } catch (Exception $e) {
            echo "<h1>Error: " . $e->getMessage() . "</h1>";
        }
    }

    public function updateProfile() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userId = $_SESSION['user']['USER_ID'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];

                // Update user profile
                User::updateProfile($userId, $name, $email, $phone);

                // Redirect to profile
                header("Location: index.php?page=profile");
                exit;
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        }
    }

    public function changePassword() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userId = $_SESSION['user']['USER_ID'];
                $currentPassword = $_POST['current_password'];
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'];

                if ($newPassword !== $confirmPassword) {
                    throw new Exception("New password and confirmation do not match.");
                }

                // Change user password
                User::changePassword($userId, $currentPassword, $newPassword);

                // Redirect to profile
                header("Location: index.php?page=profile");
                exit;
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        }
    }
}
?>
