<?php
// Include all required controllers
require_once __DIR__ . '/../src/controllers/RoomController.php';
require_once __DIR__ . '/../src/controllers/ActivityController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/controllers/HomeController.php'; // Include the HomeController

// Start a session
session_start();

// Sanitize and determine the requested page and ID (if applicable)
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home'; // Default to 'home'
$id = isset($_GET['id']) ? (int) $_GET['id'] : null; // Ensure ID is an integer

// Main Routing Logic
try {
    switch ($page) {
        // Homepage
        case 'home': // Homepage
            $controller = new HomeController();  // Instantiate HomeController
            $controller->index();  // Call the index method
            break;

        // Room Pages
        case 'rooms': // Room listing page
            $controller = new RoomController();
            $controller->index();
            break;

        case 'room': // Room details page
            if ($id) {
                $controller = new RoomController();
                $controller->show($id);
            } else {
                throw new Exception("Room ID is required.");
            }
            break;

        case 'bookRoom': // Room booking action
            if (!isset($_SESSION['user'])) {
                throw new Exception("You must be logged in to book a room.");
            }
            $controller = new RoomController();
            $bookingSuccess = $controller->bookRoom(); // Assuming bookRoom method returns true on success
            if ($bookingSuccess) {
                // Redirect to the confirmation page with the booking ID
                header("Location: /index.php?page=confirmation&bookingId=" . $_SESSION['last_booking_id']);
                exit();
            } else {
                throw new Exception("Booking failed. Please try again.");
            }
            break;

        case 'confirmation': // Booking confirmation page
            if (isset($_GET['bookingId'])) {
                $bookingId = (int) $_GET['bookingId'];
                $controller = new RoomController();
                $controller->showConfirmation($bookingId); // Assuming showConfirmation fetches booking details by ID
            } else {
                throw new Exception("Booking ID is required for confirmation.");
            }
            break;

        case 'addReview': // Add a review for a room
            if (!isset($_SESSION['user'])) {
                throw new Exception("You must be logged in to add a review.");
            }
            $controller = new RoomController();
            $controller->addReview();
            break;

        // Activity Pages
        case 'activities': // Activity listing page
            $controller = new ActivityController();
            $controller->index();
            break;

        case 'activity': // Activity details page
            if ($id) {
                $controller = new ActivityController();
                $controller->show($id);
            } else {
                throw new Exception("Activity ID is required.");
            }
            break;

        // User Authentication and Profile Management
        case 'register': // User registration page
            $controller = new UserController();
            $controller->register();
            break;

        case 'login': // User login page
            $controller = new UserController();
            $controller->login();
            break;

        case 'logout': // User logout action
            $controller = new UserController();
            $controller->logout();
            break;

        case 'profile': // User profile page
            if (isset($_SESSION['user'])) {
                $controller = new UserController();
                $controller->profile();
            } else {
                throw new Exception("You must be logged in to view your profile.");
            }
            break;

        case 'updateProfile': // Update user profile
            if (isset($_SESSION['user'])) {
                $controller = new UserController();
                $controller->updateProfile();
            } else {
                throw new Exception("You must be logged in to update your profile.");
            }
            break;

        case 'changePassword': // Change user password
            if (isset($_SESSION['user'])) {
                $controller = new UserController();
                $controller->changePassword();
            } else {
                throw new Exception("You must be logged in to change your password.");
            }
            break;

        // Fallback for unknown pages
        default:
            throw new Exception("Page not found.");
    }
} catch (Exception $e) {
    // Display error message with a user-friendly layout
    echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Error</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        h1 { color: red; }
        p { color: #555; }
        a { color: blue; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1>
    <p>Please go back to the <a href='/index.php?page=home'>home page</a>.</p>
</body>
</html>
";
}
?>
