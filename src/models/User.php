<?php
include_once __DIR__ . '/../../config/database.php';

class User
{
    public static function register($name, $email, $password)
    {
        global $conn;

        // Hash the password
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":name", $name);
        oci_bind_by_name($statement, ":email", $email);
        oci_bind_by_name($statement, ":password", $password);

        if (!oci_execute($statement, OCI_COMMIT_ON_SUCCESS)) {
            $e = oci_error($statement);
            oci_free_statement($statement);
            throw new Exception("Database error: " . htmlentities($e['message']));
        }

        oci_free_statement($statement);
    }

    public static function login($email, $password)
    {
        global $conn;

        $query = "SELECT * FROM users WHERE email = :email";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":email", $email);
        oci_execute($statement);

        $user = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        if (!$user) {
            return null; // User not found
        }

        // Compare plain text passwords directly
        if ($password === $user['PASSWORD']) {
            return $user; // Successful login
        }

        return null; // Password does not match
    }




    public static function find($id)
    {
        global $conn;

        $query = "SELECT * FROM users WHERE user_id = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":id", $id);
        oci_execute($statement);

        $user = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        return $user ?: null;
    }

    public static function updateProfile($id, $name, $email, $phone = null)
    {
        global $conn;

        $query = "UPDATE users SET name = :name, email = :email, phone = :phone WHERE user_id = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":name", $name);
        oci_bind_by_name($statement, ":email", $email);
        oci_bind_by_name($statement, ":phone", $phone);
        oci_bind_by_name($statement, ":id", $id);

        if (!oci_execute($statement, OCI_COMMIT_ON_SUCCESS)) {
            $e = oci_error($statement);
            oci_free_statement($statement);
            throw new Exception("Database error: " . htmlentities($e['message']));
        }

        oci_free_statement($statement);
    }

    public static function changePassword($id, $currentPassword, $newPassword)
    {
        global $conn;

        // Fetch current password
        $query = "SELECT password FROM users WHERE user_id = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":id", $id);
        oci_execute($statement);

        $user = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        if (!$user || !password_verify($currentPassword, $user['PASSWORD'])) {
            throw new Exception("Current password is incorrect.");
        }

        // Update password
        // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE users SET password = :password WHERE user_id = :id";
        $updateStatement = oci_parse($conn, $updateQuery);
        oci_bind_by_name($updateStatement, ":password", $newPassword);
        oci_bind_by_name($updateStatement, ":id", $id);

        if (!oci_execute($updateStatement, OCI_COMMIT_ON_SUCCESS)) {
            $e = oci_error($updateStatement);
            oci_free_statement($updateStatement);
            throw new Exception("Database error: " . htmlentities($e['message']));
        }

        oci_free_statement($updateStatement);
    }

    public static function getReviews($userId)
    {
        global $conn;

        $query = "SELECT r.*, rm.name AS room_name FROM reviews r
                  JOIN rooms rm ON r.room_id = rm.room_id
                  WHERE r.user_id = :userId";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":userId", $userId);
        oci_execute($statement);

        $reviews = [];
        while ($row = oci_fetch_assoc($statement)) {
            $reviews[] = $row;
        }

        oci_free_statement($statement);
        return $reviews;
    }

    public static function emailExists($email)
    {
        global $conn;

        $query = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":email", $email);
        oci_execute($statement);

        $result = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        return $result['COUNT'] > 0;
    }
}
