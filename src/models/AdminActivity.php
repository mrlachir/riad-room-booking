<?php

class AdminActivity
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllActivities()
    {
        $query = "SELECT * FROM activities ORDER BY name";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $activities = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $activities[] = $row;
        }
        oci_free_statement($stmt);
        return $activities;
    }

    public function getActivityById($id)
    {
        $query = "SELECT * FROM activities WHERE activity_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
        $activity = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);
        return $activity;
    }

    public function createActivity($data)
    {
        $query = "INSERT INTO activities (name, description, price, image) 
                  VALUES (:name, :description, :price, :image)";
        $stmt = oci_parse($this->conn, $query);

        oci_bind_by_name($stmt, ":name", $data['name']);
        oci_bind_by_name($stmt, ":description", $data['description']);
        oci_bind_by_name($stmt, ":price", $data['price']);
        oci_bind_by_name($stmt, ":image", $data['image']);

        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }

    public function updateActivity($id, $name, $description, $price, $image)
    {
        $query = "UPDATE activities 
                  SET name = :name, 
                      description = :description, 
                      price = :price, 
                      image = :image 
                  WHERE activity_id = :id";

        $stmt = oci_parse($this->conn, $query);

        oci_bind_by_name($stmt, ":id", $id);
        oci_bind_by_name($stmt, ":name", $name);
        oci_bind_by_name($stmt, ":description", $description);
        oci_bind_by_name($stmt, ":price", $price);
        oci_bind_by_name($stmt, ":image", $image);

        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }

    public function deleteActivity($id)
    {
        $query = "DELETE FROM activities WHERE activity_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }
}
