<?php

require_once __DIR__ . '/../models/AdminHome.php';

class AdminHomeController
{
    private $homeModel;

    public function __construct($conn)
    {
        $this->homeModel = new AdminHome($conn);
    }
    // In src/controllers/AdminHomeController.php, add/modify this method:

    public function index()
    {
        // Fetch all required data
        $headers = $this->homeModel->getAllHeaders();
        $featuredRooms = $this->homeModel->getAllFeaturedRooms();
        $featuredActivities = $this->homeModel->getAllFeaturedActivities();

        // Use absolute path to the view file
        $viewPath = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking/src/views/dashboard/home/adminHome.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            die("Error: View file not found at: " . $viewPath);
        }
    }

    // src/controllers/AdminHomeController.php (Add these methods to the existing class)
    public function showAddHeader()
    {
        include __DIR__ . '/../views/dashboard/home/addHeader.php';
    }

    public function showAddFeaturedRoom()
    {
        $availableRooms = $this->homeModel->getAllRooms();
        include __DIR__ . '/../views/dashboard/home/addFeaturedRoom.php';
    }

    public function showAddFeaturedActivity()
    {
        $availableActivities = $this->homeModel->getAllActivities();
        include __DIR__ . '/../views/dashboard/home/addFeaturedActivities.php';
    }

    public function storeHeader()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking/public/images/headers/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageUrl = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '_' . time() . '.' . $extension;
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imageUrl = '/public/images/headers/' . $fileName;
                }
            }

            if ($imageUrl && $this->homeModel->createHeader($imageUrl, $_POST['overlay_text'])) {
                header("Location: index.php?page=adminHome&success=Header added successfully");
            } else {
                header("Location: index.php?page=adminHome&error=Failed to add header");
            }
            exit();
        }
    }

    public function storeFeaturedRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_id'])) {
            if ($this->homeModel->createFeaturedRoom($_POST['room_id'])) {
                header("Location: index.php?page=adminHome&success=Room added to featured successfully");
            } else {
                header("Location: index.php?page=adminHome&error=Failed to add room to featured");
            }
            exit();
        }
    }

    public function storeFeaturedActivity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activity_id'])) {
            if ($this->homeModel->createFeaturedActivity($_POST['activity_id'])) {
                header("Location: index.php?page=adminHome&success=Activity added to featured successfully");
            } else {
                header("Location: index.php?page=adminHome&error=Failed to add activity to featured");
            }
            exit();
        }
    }

    public function deleteHeader($id)
    {
        $result = $this->homeModel->deleteHeader($id);

        if ($result['success']) {
            // Delete the image file if it exists
            if ($result['image_path']) {
                $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking' . $result['image_path'];
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
            header("Location: index.php?page=adminHome&success=Header deleted successfully");
        } else {
            header("Location: index.php?page=adminHome&error=Failed to delete header");
        }
        exit();
    }

    public function deleteFeaturedRoom($id)
    {
        if ($this->homeModel->deleteFeaturedRoom($id)) {
            header("Location: index.php?page=adminHome&success=Featured room removed successfully");
        } else {
            header("Location: index.php?page=adminHome&error=Failed to remove featured room");
        }
        exit();
    }

    public function deleteFeaturedActivity($id)
    {
        if ($this->homeModel->deleteFeaturedActivity($id)) {
            header("Location: index.php?page=adminHome&success=Featured activity removed successfully");
        } else {
            header("Location: index.php?page=adminHome&error=Failed to remove featured activity");
        }
        exit();
    }
}
