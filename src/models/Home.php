<?php
include_once __DIR__ . '/../../config/database.php';

class Home
{
    // Fetch featured activities for the home page
    public static function getFeaturedActivities()
    {
        global $conn;

        $query = 'SELECT a.name, a.image, a.activity_id FROM activities a JOIN featured_activities fa ON a.activity_id = fa.activity_id';
        $stid = oci_parse($conn, $query);

        if (!$stid) {
            $e = oci_error($conn);
            throw new Exception("Failed to parse query: " . htmlentities($e['message'], ENT_QUOTES));
        }

        oci_execute($stid);

        $activities = [];
        while ($row = oci_fetch_assoc($stid)) {
            $activities[] = $row;
        }

        oci_free_statement($stid);
        return $activities;
    }

    // Fetch featured rooms for the home page
    public static function getFeaturedRooms()
    {
        global $conn;

        $query = 'SELECT r.name, r.image, r.room_id FROM rooms r JOIN featured_rooms fr ON r.room_id = fr.room_id';
        $stid = oci_parse($conn, $query);

        if (!$stid) {
            $e = oci_error($conn);
            throw new Exception("Failed to parse query: " . htmlentities($e['message'], ENT_QUOTES));
        }

        oci_execute($stid);

        $rooms = [];
        while ($row = oci_fetch_assoc($stid)) {
            $rooms[] = $row;
        }

        oci_free_statement($stid);
        return $rooms;
    }

    // Fetch featured reviews for the home page
    public static function getFeaturedReviews()
    {
        global $conn;

        $query = 'SELECT r.review_text, r.rating, u.username FROM reviews r JOIN users u ON r.user_id = u.user_id WHERE r.is_featured = 1';
        $stid = oci_parse($conn, $query);

        if (!$stid) {
            $e = oci_error($conn);
            throw new Exception("Failed to parse query: " . htmlentities($e['message'], ENT_QUOTES));
        }

        oci_execute($stid);

        $reviews = [];
        while ($row = oci_fetch_assoc($stid)) {
            $reviews[] = $row;
        }

        oci_free_statement($stid);
        return $reviews;
    }

    // Get header data for the homepage (image, overlay text)
    public static function getHeaderData()
    {
        global $conn;

        $query = 'SELECT header_image, overlay_text FROM homepage_data WHERE id = 1';
        $stid = oci_parse($conn, $query);

        if (!$stid) {
            $e = oci_error($conn);
            throw new Exception("Failed to parse query: " . htmlentities($e['message'], ENT_QUOTES));
        }

        oci_execute($stid);

        $headerData = oci_fetch_assoc($stid);

        oci_free_statement($stid);
        return $headerData;
    }
}
