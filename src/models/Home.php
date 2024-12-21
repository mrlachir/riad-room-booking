<?php

require_once __DIR__ . '/../../config/database.php';

class Home
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    // Get homepage header data
    public function getHomepageHeader()
    {
        $sql = "SELECT * FROM homepage_header WHERE ROWNUM = 1";  // Fetch only one header
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);

        $header = oci_fetch_assoc($stid);
        oci_free_statement($stid);

        return $header;
    }

    // Get featured reviews : didn't work
    //     public function getFeaturedReviews()
    // {
    //     $sql = "
    //         SELECT 
    //             u.name AS user_name,
    //             r.review_text,
    //             r.rating,
    //             r.review_date
    //         FROM 
    //             featured_reviews fr
    //         JOIN 
    //             reviews r ON fr.review_id = r.review_id
    //         JOIN 
    //             users u ON r.user_id = u.user_id
    //     ";

    //     // Parse the SQL statement
    //     $stid = oci_parse($this->conn, $sql);
    //     if (!$stid) {
    //         $e = oci_error($this->conn);
    //         die('SQL Parse Error: ' . htmlentities($e['message'], ENT_QUOTES));
    //     }

    //     // Execute the SQL statement
    //     if (!oci_execute($stid)) {
    //         $e = oci_error($stid);
    //         die('SQL Execution Error: ' . htmlentities($e['message'], ENT_QUOTES));
    //     }

    //     // Fetch data
    //     $reviews = [];
    //     while ($row = oci_fetch_assoc($stid)) {
    //         $reviews[] = $row;
    //     }

    //     // Free resources
    //     oci_free_statement($stid);

    //     // Debugging: Output fetched data
    //     echo '<pre>';
    //     print_r($reviews);
    //     echo '</pre>';

    //     return $reviews;
    // }
    



    // Get featured activities
    public function getFeaturedActivities()
    {
        $sql = "SELECT a.activity_id, a.name, a.description, a.price, a.image 
                FROM featured_activities fa
                JOIN activities a ON fa.activity_id = a.activity_id";
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);

        $activities = [];
        while ($row = oci_fetch_assoc($stid)) {
            $activities[] = $row;
        }

        oci_free_statement($stid);

        return $activities;
    }

    // Get featured rooms
    public function getFeaturedRooms()
    {
        $sql = "SELECT r.room_id, r.name, r.description, r.price, r.image, r.room_type
                FROM featured_rooms fr
                JOIN rooms r ON fr.room_id = r.room_id";
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);

        $rooms = [];
        while ($row = oci_fetch_assoc($stid)) {
            $rooms[] = $row;
        }

        oci_free_statement($stid);

        return $rooms;
    }
}
