<?php
require_once __DIR__ . '/../src/controllers/RoomController.php';

$page = $_GET['page'] ?? 'home';
$id = $_GET['id'] ?? null;

switch ($page) {
    case 'rooms':
        $controller = new RoomController();
        $controller->index();
        break;
    case 'room':
        if ($id) {
            $controller = new RoomController();
            // $controller->show($id);
        } else {
            echo "Room ID is required.";
        }
        break;
    default:
        include '../src/views/home.php';
        break;
}
?>
