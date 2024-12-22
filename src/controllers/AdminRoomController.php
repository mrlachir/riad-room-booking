<?php

require_once __DIR__ . '/../models/AdminRoom.php';

class AdminRoomController {
    private $roomModel;
    private $uploadDir;

    public function __construct($conn) {
        $this->roomModel = new AdminRoom($conn);
        // Define the absolute path for image uploads
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking/public/images/rooms/';
        
        // Create directory if it doesn't exist
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index() {
        $rooms = $this->roomModel->getAllRooms();
        include __DIR__ . '/../views/dashboard/rooms/rooms.php';
    }

    public function create() {
        include __DIR__ . '/../views/dashboard/rooms/addRoom.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageUrl = $this->handleImageUpload();
            
            $roomData = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'availability' => $_POST['availability'],
                'room_type' => $_POST['room_type'],
                'image' => $imageUrl
            ];

            if ($this->roomModel->createRoom($roomData)) {
                header("Location: index.php?page=adminRooms&success=Room created successfully");
            } else {
                header("Location: index.php?page=adminRooms&error=Failed to create room");
            }
            exit();
        }
    }

    public function edit($id) {
        $room = $this->roomModel->getRoomById($id);
        if ($room) {
            include __DIR__ . '/../views/dashboard/rooms/editRoom.php';
        } else {
            header("Location: index.php?page=adminRooms&error=Room not found");
            exit();
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the current room data to check if we need to update the image
            $currentRoom = $this->roomModel->getRoomById($id);
            
            // Handle image upload
            $imageUrl = $this->handleImageUpload();
            if ($imageUrl === null && isset($currentRoom['IMAGE'])) {
                // Keep the existing image if no new image was uploaded
                $imageUrl = $currentRoom['IMAGE'];
            }

            // Validate and sanitize inputs
            $name = htmlspecialchars(trim($_POST['name']));
            $description = htmlspecialchars(trim($_POST['description']));
            $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $availability = filter_var($_POST['availability'], FILTER_SANITIZE_NUMBER_INT);
            $room_type = htmlspecialchars(trim($_POST['room_type']));

            if ($this->roomModel->updateRoom(
                $id,
                $name,
                $description,
                $price,
                $availability,
                $imageUrl,
                $room_type
            )) {
                // If update successful and new image uploaded, delete old image
                if ($imageUrl !== $currentRoom['IMAGE'] && $currentRoom['IMAGE']) {
                    $this->deleteOldImage($currentRoom['IMAGE']);
                }
                header("Location: index.php?page=adminRooms&success=Room updated successfully");
            } else {
                header("Location: index.php?page=adminRooms&error=Failed to update room");
            }
            exit();
        }
    }

    // private function handleImageUpload() {
    //     if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    //         return null;
    //     }

    //     // Validate file type
    //     $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    //     $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    //     $uploadedFileType = finfo_file($fileInfo, $_FILES['image']['tmp_name']);
    //     finfo_close($fileInfo);

    //     if (!in_array($uploadedFileType, $allowedTypes)) {
    //         throw new Exception('Invalid file type. Only JPG, PNG and GIF are allowed.');
    //     }

    //     // Generate unique filename
    //     $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    //     $fileName = uniqid() . '_' . time() . '.' . $extension;
    //     $uploadPath = $this->uploadDir . $fileName;

    //     // Move and verify upload
    //     if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
    //         throw new Exception('Failed to move uploaded file.');
    //     }

    //     // Return the relative path for database storage
    //     return '/public/images/rooms/' . $fileName;
    private function handleImageUpload() {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
    
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $uploadedFileType = finfo_file($fileInfo, $_FILES['image']['tmp_name']);
        finfo_close($fileInfo);
    
        if (!in_array($uploadedFileType, $allowedTypes)) {
            throw new Exception('Invalid file type. Only JPG, PNG and GIF are allowed.');
        }
    
        // Generate unique filename
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '_' . time() . '.' . $extension;
        
        // Define paths
        $relativePath = '/public/images/rooms/' . $fileName;
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking' . $relativePath;
    
        // Ensure directory exists
        $uploadDir = dirname($uploadPath);
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        // Move and verify upload
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            throw new Exception('Failed to move uploaded file.');
        }
    
        // Return the relative path for database storage
        return $relativePath;
    }
    private function deleteOldImage($imagePath) {
        if (!empty($imagePath)) {
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking' . $imagePath;
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    public function destroy($id) {
        // Get room data to delete associated image
        $room = $this->roomModel->getRoomById($id);
        
        if ($this->roomModel->deleteRoom($id)) {
            // Delete associated image file
            if ($room && isset($room['IMAGE'])) {
                $this->deleteOldImage($room['IMAGE']);
            }
            header("Location: index.php?page=adminRooms&success=Room deleted successfully");
        } else {
            header("Location: index.php?page=adminRooms&error=Failed to delete room");
        }
        exit();
    }
}