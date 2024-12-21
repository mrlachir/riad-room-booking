<?php
include_once __DIR__ . '/../../config/database.php';

class Room
{
    // Add this method to your Room.php model file
    public static function getFiltered($filters)
    {
        global $conn;

        $query = "SELECT * FROM rooms WHERE 1=1";
        $bindings = [];

        // Add search filter
        if (!empty($filters['search'])) {
            $query .= " AND (LOWER(name) LIKE LOWER(:search) OR LOWER(description) LIKE LOWER(:search))";
            $bindings[':search'] = '%' . $filters['search'] . '%';
        }

        // Add price range filter
        if (!empty($filters['min_price'])) {
            $query .= " AND price >= :min_price";
            $bindings[':min_price'] = $filters['min_price'];
        }
        if (!empty($filters['max_price'])) {
            $query .= " AND price <= :max_price";
            $bindings[':max_price'] = $filters['max_price'];
        }

        // Add capacity filter
        if (!empty($filters['capacity'])) {
            $query .= " AND capacity >= :capacity";
            $bindings[':capacity'] = $filters['capacity'];
        }

        $statement = oci_parse($conn, $query);

        // Bind all parameters
        foreach ($bindings as $key => $value) {
            oci_bind_by_name($statement, $key, $value);
        }

        oci_execute($statement);

        $rooms = [];
        while ($row = oci_fetch_assoc($statement)) {
            $rooms[] = $row;
        }
        oci_free_statement($statement);

        return $rooms;
    }
    public static function getAll()
    {
        global $conn;

        $query = "SELECT * FROM rooms";
        $statement = oci_parse($conn, $query);
        if (!$statement) {
            $e = oci_error($conn);
            throw new Exception("Failed to prepare the query: " . htmlentities($e['message'], ENT_QUOTES));
        }

        oci_execute($statement);

        $rooms = [];
        while ($row = oci_fetch_assoc($statement)) {
            $rooms[] = $row;
        }
        oci_free_statement($statement);

        return $rooms;
    }
    public static function find($id)
    {
        global $conn;

        $query = "SELECT * FROM rooms WHERE room_id = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":id", $id);
        oci_execute($statement);

        $room = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        if (!$room) {
            throw new Exception("Room not found.");
        }

        // Mock additional fields if they don't exist in the database
        $room['features'] = $room['features'] ?? ['Free WiFi', 'Air Conditioning', 'Room Service'];
        $room['additional_images'] = $room['additional_images'] ?? [
            'https://example.com/image1.jpg',
            'https://example.com/image2.jpg',
            'https://example.com/image3.jpg'
        ];

        return $room;
    }


    public static function getRecommended($excludeId)
    {
        global $conn;

        $query = "SELECT * FROM rooms WHERE room_id != :excludeId FETCH FIRST 3 ROWS ONLY";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":excludeId", $excludeId);
        oci_execute($statement);

        $recommendedRooms = [];
        while ($row = oci_fetch_assoc($statement)) {
            $recommendedRooms[] = $row;
        }

        oci_free_statement($statement);
        return $recommendedRooms;
    }

    public static function getReviews($roomId)
    {
        global $conn;

        $query = "SELECT r.*, u.name AS user_name FROM reviews r
                  JOIN users u ON r.user_id = u.user_id
                  WHERE r.room_id = :roomId ORDER BY r.review_date DESC";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":roomId", $roomId);
        oci_execute($statement);

        $reviews = [];
        while ($row = oci_fetch_assoc($statement)) {
            $reviews[] = $row;
        }

        oci_free_statement($statement);
        return $reviews;
    }

    public static function addReview($roomId, $userId, $rating, $reviewText)
    {
        global $conn;

        $query = "INSERT INTO reviews (room_id, user_id, rating, review_text) 
                  VALUES (:roomId, :userId, :rating, :reviewText)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":roomId", $roomId);
        oci_bind_by_name($statement, ":userId", $userId);
        oci_bind_by_name($statement, ":rating", $rating);
        oci_bind_by_name($statement, ":reviewText", $reviewText);
        $result = oci_execute($statement);

        oci_free_statement($statement);

        if (!$result) {
            throw new Exception("Failed to add review.");
        }
    }



    // public static function getFeaturedRooms()
    // {
    //     global $conn;

    //     $query = "
    //         SELECT r.* 
    //         FROM rooms r 
    //         JOIN featured_rooms fr ON r.room_id = fr.room_id
    //     ";
    //     $stid = oci_parse($conn, $query);
        
    //     oci_execute($stid);

    //     $featuredRooms = array();
    //     while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    //         $featuredRooms[] = $row;
    //     }
    //     oci_free_statement($stid);
    //     return $featuredRooms;
    // }
}
