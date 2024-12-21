<?php
include_once __DIR__ . '/../../config/database.php';

class Review
{
    // Fetch reviews by room ID
    public static function getByRoomId($roomId)
{
    global $conn;

    $query = "SELECT r.*, u.name AS USER_NAME FROM reviews r
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

    // Add a review
    public static function addReview($userId, $roomId, $rating, $reviewText)
    {
        global $conn;

        $query = "INSERT INTO reviews (user_id, room_id, rating, review_text, review_date) 
                  VALUES (:userId, :roomId, :rating, :reviewText, SYSTIMESTAMP)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":userId", $userId);
        oci_bind_by_name($statement, ":roomId", $roomId);
        oci_bind_by_name($statement, ":rating", $rating);
        oci_bind_by_name($statement, ":reviewText", $reviewText);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            oci_free_statement($statement);
            throw new Exception("Error adding review: " . $e['message']);
        }

        oci_free_statement($statement);
    }
}
