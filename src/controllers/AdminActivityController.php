<?php

require_once __DIR__ . '/../models/AdminActivity.php';

class AdminActivityController {
    private $activityModel;
    private $uploadDir;

    public function __construct($conn) {
        $this->activityModel = new AdminActivity($conn);
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking/public/images/activities/';
        
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index() {
        $activities = $this->activityModel->getAllActivities();
        include __DIR__ . '/../views/dashboard/activities/activities.php';
    }

    public function create() {
        include __DIR__ . '/../views/dashboard/activities/addActivity.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageUrl = $this->handleImageUpload();
            
            $activityData = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $imageUrl
            ];

            if ($this->activityModel->createActivity($activityData)) {
                header("Location: index.php?page=adminactivities&success=Activity created successfully");
            } else {
                header("Location: index.php?page=adminactivities&error=Failed to create activity");
            }
            exit();
        }
    }

    public function edit($id) {
        $activity = $this->activityModel->getActivityById($id);
        if ($activity) {
            include __DIR__ . '/../views/dashboard/activities/editActivity.php';
        } else {
            header("Location: index.php?page=adminactivities&error=Activity not found");
            exit();
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentActivity = $this->activityModel->getActivityById($id);
            
            $imageUrl = $this->handleImageUpload();
            if ($imageUrl === null && isset($currentActivity['IMAGE'])) {
                $imageUrl = $currentActivity['IMAGE'];
            }

            $name = htmlspecialchars(trim($_POST['name']));
            $description = htmlspecialchars(trim($_POST['description']));
            $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if ($this->activityModel->updateActivity($id, $name, $description, $price, $imageUrl)) {
                if ($imageUrl !== $currentActivity['IMAGE'] && $currentActivity['IMAGE']) {
                    $this->deleteOldImage($currentActivity['IMAGE']);
                }
                header("Location: index.php?page=adminactivities&success=Activity updated successfully");
            } else {
                header("Location: index.php?page=adminactivities&error=Failed to update activity");
            }
            exit();
        }
    }

    private function handleImageUpload() {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
    
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $uploadedFileType = finfo_file($fileInfo, $_FILES['image']['tmp_name']);
        finfo_close($fileInfo);
    
        if (!in_array($uploadedFileType, $allowedTypes)) {
            throw new Exception('Invalid file type. Only JPG, PNG and GIF are allowed.');
        }
    
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '_' . time() . '.' . $extension;
        $relativePath = '/public/images/activities/' . $fileName;
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/riad-room-booking' . $relativePath;
    
        $uploadDir = dirname($uploadPath);
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            throw new Exception('Failed to move uploaded file.');
        }
    
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
        $activity = $this->activityModel->getActivityById($id);
        
        if ($this->activityModel->deleteActivity($id)) {
            if ($activity && isset($activity['IMAGE'])) {
                $this->deleteOldImage($activity['IMAGE']);
            }
            header("Location: index.php?page=adminactivities&success=Activity deleted successfully");
        } else {
            header("Location: index.php?page=adminactivities&error=Failed to delete activity");
        }
        exit();
    }
}