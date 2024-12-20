<?php
include_once __DIR__ . '/../../config/database.php';

class Room {
    public static function getAll() {
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
    public static function find($id) {
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


    public static function getRecommended($excludeId) {
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

    public static function getReviews($roomId) {
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

    public static function addReview($roomId, $userId, $rating, $reviewText) {
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
}
?>
