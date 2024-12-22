<?php
// Include all required controllers
require_once __DIR__ . '/../src/controllers/RoomController.php';
require_once __DIR__ . '/../src/controllers/ActivityController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/controllers/HomeController.php'; // Include the HomeController
require_once __DIR__ . '/../src/controllers/DashboardController.php'; // Include the DashboardController

// Start a session
session_start();

// Helper function to handle redirection
function redirect($page, $params = [])
{
    $url = '/index.php?page=' . $page;
    if (!empty($params)) {
        $url .= '&' . http_build_query($params);
    }
    header("Location: $url");
    exit();
}

// Sanitize and determine the requested page and ID (if applicable)
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home'; // Default to 'home'
$id = isset($_GET['id']) ? (int) $_GET['id'] : null; // Ensure ID is an integer

// Function to check if the user is logged in
function checkUserLogin()
{
    if (!isset($_SESSION['user'])) {
        throw new Exception("You must be logged in to access this page.");
    }
}

function isAdmin()
{
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin';
}

// Main Routing Logic
try {
    switch ($page) {
        case 'about': // About Us page
            include __DIR__ . '/../src/views/about.php';
            break;
        
        case 'contact': // Contact Us page
            include __DIR__ . '/../src/views/contact.php';
            break;

        case 'home': // Homepage
            $controller = new HomeController();  
            $controller->index();  
            break;

            case 'dashboardOverview': // Dashboard overview page
                if (isAdmin()) {
                    $dashboardController = new DashboardController();
                    $dashboardController->overview();
                } else {
                    throw new Exception("Unauthorized access. Only admins can view this page.");
                }
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
            checkUserLogin();
            $controller = new RoomController();
            $bookingSuccess = $controller->bookRoom(); // Assuming bookRoom method returns true on success
            if ($bookingSuccess) {
                redirect('confirmation', ['bookingId' => $_SESSION['last_booking_id']]);
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
            checkUserLogin();
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
            checkUserLogin();
            $controller = new UserController();
            $controller->profile();
            break;

        case 'updateProfile': // Update user profile
            checkUserLogin();
            $controller = new UserController();
            $controller->updateProfile();
            break;

        case 'changePassword': // Change user password
            checkUserLogin();
            $controller = new UserController();
            $controller->changePassword();
            break;

        // Fallback for unknown pages
        default:
            throw new Exception("Page not found.");
    }
} catch (Exception $e) {
    // Centralized error handling
    displayError($e->getMessage());
}

// Helper function to display error messages
function displayError($message)
{
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
    <h1>Error: " . htmlspecialchars($message) . "</h1>
    <p>Please go back to the <a href='/index.php?page=home'>home page</a>.</p>
</body>
</html>
";
}
