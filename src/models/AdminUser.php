<?php
// src/models/AdminUser.php
class AdminUser
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users ORDER BY name";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $users = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $users[] = $row;
        }
        oci_free_statement($stmt);
        return $users;
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE user_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
        $user = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);
        return $user;
    }

    public function updateUserRole($id, $role)
    {
        $query = "UPDATE users SET role = :role, updated_at = SYSTIMESTAMP WHERE user_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        oci_bind_by_name($stmt, ":role", $role);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE user_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }
}
