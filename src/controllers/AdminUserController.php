<?php

require_once __DIR__ . '/../models/AdminUser.php';

// src/controllers/AdminUserController.php
class AdminUserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new AdminUser($conn);
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        include __DIR__ . '/../views/dashboard/users/users.php';
    }

    public function edit($id) {
        $user = $this->userModel->getUserById($id);
        if ($user) {
            include __DIR__ . '/../views/dashboard/users/editUser.php';
        } else {
            header("Location: index.php?page=adminUsers&error=User not found");
            exit();
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = htmlspecialchars(trim($_POST['role']));
            
            if ($this->userModel->updateUserRole($id, $role)) {
                header("Location: index.php?page=adminUsers&success=User role updated successfully");
            } else {
                header("Location: index.php?page=adminUsers&error=Failed to update user role");
            }
            exit();
        }
    }

    public function destroy($id) {
        if ($this->userModel->deleteUser($id)) {
            header("Location: index.php?page=adminUsers&success=User deleted successfully");
        } else {
            header("Location: index.php?page=adminUsers&error=Failed to delete user");
        }
        exit();
    }
}