<?php
// Include all required controllers
require_once __DIR__ . '/../src/controllers/RoomController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/controllers/ActivityController.php';
require_once __DIR__ . '/../src/controllers/HomeController.php';
require_once __DIR__ . '/../src/controllers/DashboardController.php';
require_once __DIR__ . '/../src/controllers/AdminRoomController.php';
require_once __DIR__ . '/../src/controllers/AdminActivityController.php';
require_once __DIR__ . '/../src/controllers/AdminUserController.php';
require_once __DIR__ . '/../src/controllers/AdminHomeController.php';

$adminRoomController = new AdminRoomController($conn);
$adminActivityController = new AdminActivityController($conn);

// Start a session
session_start();

// Helper function to handle redirection
function redirect($page, $params = [])
{
    // $url = '/index.php?page=' . $page;
    // // if (!empty($params)) {
    // //     $url .= '&' . http_build_query($params);
    // // }
    header("Location: http://localhost/riad-room-booking/public/index.php?page=$page");
    exit();
}

// Sanitize and determine the requested page and ID (if applicable)
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Authentication functions
function isLogin()
{
    return isset($_SESSION['user']);
}

function isAdmin()
{
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin';
}

// Function to check if the user is logged in
function checkUserLogin()
{
    if (!isLogin()) {
        redirect('login', ['error' => 'Please login to access this page']);
    }
}

// Function to check if the user is an admin
function checkAdminAccess()
{
    if (!isAdmin()) {
        // redirect('home', ['error' => 'Unauthorized access. Admin privileges required.']);
    }
}

// Main Routing Logic
try {
    switch ($page) {
        // Public pages (no authentication required)
        case 'about':
            include __DIR__ . '/../src/views/about.php';
            break;

        case 'contact':
            include __DIR__ . '/../src/views/contact.php';
            break;

        case 'home':
            $controller = new HomeController();
            $controller->index();
            break;

        case 'login':
            $controller = new UserController();
            $controller->login();
            break;

        case 'register':
            $controller = new UserController();
            $controller->register();
            break;

        // Admin pages (require admin authentication)
        case 'adminHome':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->index();
            break;

        case 'dashboardOverview':
            checkAdminAccess();
            $dashboardController = new DashboardController();
            $dashboardController->overview();
            break;

        case 'deleteAdminHeader':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->deleteHeader($_GET['id']);
            break;

        case 'deleteAdminFeaturedRoom':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->deleteFeaturedRoom($_GET['id']);
            break;

        case 'deleteAdminFeaturedActivity':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->deleteFeaturedActivity($_GET['id']);
            break;

        case 'addAdminHeader':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->showAddHeader();
            break;

        case 'storeAdminHeader':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->storeHeader();
            break;

        case 'addAdminFeaturedRoom':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->showAddFeaturedRoom();
            break;

        case 'storeAdminFeaturedRoom':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->storeFeaturedRoom();
            break;

        case 'addAdminFeaturedActivity':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->showAddFeaturedActivity();
            break;

        case 'storeAdminFeaturedActivity':
            checkAdminAccess();
            $controller = new AdminHomeController($conn);
            $controller->storeFeaturedActivity();
            break;

        case 'adminRooms':
            checkAdminAccess();
            $adminRoomController->index();
            break;

        case 'createAdminRoom':
            checkAdminAccess();
            $adminRoomController->create();
            break;

        case 'storeAdminRoom':
            checkAdminAccess();
            $adminRoomController->store();
            break;

        case 'editAdminRoom':
            checkAdminAccess();
            $adminRoomController->edit($_GET['id']);
            break;

        case 'updateAdminRoom':
            checkAdminAccess();
            $adminRoomController->update($_GET['id']);
            break;

        case 'deleteAdminRoom':
            checkAdminAccess();
            $adminRoomController->destroy($_GET['id']);
            break;

        case 'adminactivities':
            checkAdminAccess();
            $adminActivityController->index();
            break;

        case 'admincreateActivity':
            checkAdminAccess();
            $adminActivityController->create();
            break;

        case 'adminstoreActivity':
            checkAdminAccess();
            $adminActivityController->store();
            break;

        case 'admineditActivity':
            checkAdminAccess();
            $adminActivityController->edit($_GET['id']);
            break;

        case 'adminupdateActivity':
            checkAdminAccess();
            $adminActivityController->update($_GET['id']);
            break;

        case 'admindeleteActivity':
            checkAdminAccess();
            $adminActivityController->destroy($_GET['id']);
            break;

        case 'adminUsers':
            checkAdminAccess();
            $controller = new AdminUserController($conn);
            $controller->index();
            break;

        case 'editAdminUser':
            checkAdminAccess();
            if (!$id) {
                redirect('adminUsers', ['error' => 'Invalid user ID']);
            }
            $controller = new AdminUserController($conn);
            $controller->edit($id);
            break;

        case 'updateAdminUser':
            checkAdminAccess();
            if (!$id) {
                redirect('adminUsers', ['error' => 'Invalid user ID']);
            }
            $controller = new AdminUserController($conn);
            $controller->update($id);
            break;

        case 'deleteAdminUser':
            checkAdminAccess();
            if (!$id) {
                redirect('adminUsers', ['error' => 'Invalid user ID']);
            }
            $controller = new AdminUserController($conn);
            $controller->destroy($id);
            break;

        // User authenticated pages (require login)
        case 'profile':
            checkUserLogin();
            $controller = new UserController();
            $controller->profile();
            break;

        case 'updateProfile':
            checkUserLogin();
            $controller = new UserController();
            $controller->updateProfile();
            break;

        case 'changePassword':
            checkUserLogin();
            $controller = new UserController();
            $controller->changePassword();
            break;

        case 'bookRoom':
            checkUserLogin();
            $controller = new RoomController();
            $bookingSuccess = $controller->bookRoom();
            if ($bookingSuccess) {
                redirect('confirmation', ['bookingId' => $_SESSION['last_booking_id']]);
            } else {
                throw new Exception("Booking failed. Please try again.");
            }
            break;

        case 'addReview':
            checkUserLogin();
            $controller = new RoomController();
            $controller->addReview();
            break;

        // Semi-public pages (viewable by all, some features require login)
        case 'rooms':
            $controller = new RoomController();
            $controller->index();
            break;

        case 'room':
            if ($id) {
                $controller = new RoomController();
                $controller->show($id);
            } else {
                throw new Exception("Room ID is required.");
            }
            break;

        case 'activities':
            $controller = new ActivityController();
            $controller->index();
            break;

        case 'activity':
            if ($id) {
                $controller = new ActivityController();
                $controller->show($id);
            } else {
                throw new Exception("Activity ID is required.");
            }
            break;

        case 'confirmation':
            if (isset($_GET['bookingId'])) {
                $bookingId = (int) $_GET['bookingId'];
                $controller = new RoomController();
                $controller->showConfirmation($bookingId);
            } else {
                throw new Exception("Booking ID is required for confirmation.");
            }
            break;

        case 'logout':
            $controller = new UserController();
            $controller->logout();
            break;

        default:
            throw new Exception("Page not found.");
    }
} catch (Exception $e) {
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
