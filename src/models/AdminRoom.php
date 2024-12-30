<?php

class AdminRoom
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllRooms()
    {
        $query = "SELECT * FROM rooms ORDER BY availability";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $rooms = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $rooms[] = $row;
        }
        oci_free_statement($stmt);
        return $rooms;
    }

    public function getRoomById($id)
    {
        $query = "SELECT * FROM rooms WHERE room_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
        $room = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);
        return $room;
    }

    public function createRoom($data)
    {
        $query = "INSERT INTO rooms (name, description, price, availability, image, room_type) 
                  VALUES (:name, :description, :price, :availability, :image, :room_type)";
        $stmt = oci_parse($this->conn, $query);

        // Convert availability to number if it's not already
        $availability = isset($data['availability']) ? (int)$data['availability'] : 1;

        oci_bind_by_name($stmt, ":name", $data['name']);
        oci_bind_by_name($stmt, ":description", $data['description']);
        oci_bind_by_name($stmt, ":price", $data['price']);
        oci_bind_by_name($stmt, ":availability", $availability);
        oci_bind_by_name($stmt, ":image", $data['image']);
        oci_bind_by_name($stmt, ":room_type", $data['room_type']);

        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }

    // Method modified to accept individual parameters
    public function updateRoom($id, $name, $description, $price, $availability, $image, $room_type)
    {
        $query = "UPDATE rooms 
                  SET name = :name, 
                      description = :description, 
                      price = :price, 
                      availability = :availability, 
                      image = :image, 
                      room_type = :room_type 
                  WHERE room_id = :id";

        $stmt = oci_parse($this->conn, $query);

        // Convert availability to number
        $availability = (int)$availability;

        // Bind all parameters
        oci_bind_by_name($stmt, ":id", $id);
        oci_bind_by_name($stmt, ":name", $name);
        oci_bind_by_name($stmt, ":description", $description);
        oci_bind_by_name($stmt, ":price", $price);
        oci_bind_by_name($stmt, ":availability", $availability);
        oci_bind_by_name($stmt, ":image", $image);
        oci_bind_by_name($stmt, ":room_type", $room_type);

        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }

    public function deleteRoom($id)
    {
        $query = "DELETE FROM rooms WHERE room_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }
}
