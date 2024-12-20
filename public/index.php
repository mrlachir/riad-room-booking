<?php
// Include all required controllers
require_once __DIR__ . '/../src/controllers/RoomController.php';
require_once __DIR__ . '/../src/controllers/ActivityController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

// Start a session
session_start();

// Determine the requested page and ID (if applicable)
$page = $_GET['page'] ?? 'rooms'; // Default to 'rooms'
$id = $_GET['id'] ?? null; // Optional ID for detailed views

// Main Routing Logic
try {
    switch ($page) {
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
            $controller = new RoomController();
            $controller->bookRoom();
            break;

        case 'addReview': // Add a review for a room
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
            $controller = new UserController();
            $controller->profile();
            break;

        case 'updateProfile': // Update user profile
            $controller = new UserController();
            $controller->updateProfile();
            break;

        case 'changePassword': // Change user password
            $controller = new UserController();
            $controller->changePassword();
            break;

        // Fallback for unknown pages
        default:
            throw new Exception("Page not found.");
    }
} catch (Exception $e) {
    // Display error message
    echo "<h1>Error: " . $e->getMessage() . "</h1>";
}
?>
