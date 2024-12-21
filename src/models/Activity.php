<?php
include_once __DIR__ . '/../../config/database.php';

class Activity
{
    public static function getAll()
    {
        global $conn;

        $query = "SELECT * FROM activities";
        $statement = oci_parse($conn, $query);
        if (!$statement) {
            $e = oci_error($conn);
            throw new Exception("Failed to prepare the query: " . htmlentities($e['message'], ENT_QUOTES));
        }

        oci_execute($statement);

        $activities = [];
        while ($row = oci_fetch_assoc($statement)) {
            $activities[] = $row;
        }
        oci_free_statement($statement);

        return $activities;
    }
    public static function find($id)
    {
        global $conn;

        $query = "SELECT * FROM activities WHERE activity_id = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":id", $id);
        oci_execute($statement);

        $activity = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        if (!$activity) {
            throw new Exception("Activity not found.");
        }

        return $activity;
    }

    public static function getRecommended($excludeId)
    {
        global $conn;

        $query = "SELECT * FROM activities WHERE activity_id != :excludeId FETCH FIRST 3 ROWS ONLY";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":excludeId", $excludeId);
        oci_execute($statement);

        $recommended = [];
        while ($row = oci_fetch_assoc($statement)) {
            $recommended[] = $row;
        }

        oci_free_statement($statement);
        return $recommended;
    }

    // Fetch featured activities (limit to 2)
    // public static function getFeaturedActivities($limit = 2)
    // {
    //     global $conn;

    //     $query = "
    //         SELECT a.* 
    //         FROM activities a
    //         JOIN featured_activities fa ON a.activity_id = fa.activity_id
    //         FETCH FIRST :limit ROWS ONLY"; // Use Oracle's FETCH FIRST syntax
        
    //     $statement = oci_parse($conn, $query);

    //     if (!$statement) {
    //         $e = oci_error($conn);
    //         throw new Exception("Failed to prepare the query: " . htmlentities($e['message'], ENT_QUOTES));
    //     }

    //     oci_bind_by_name($statement, ":limit", $limit);
    //     $result = oci_execute($statement);

    //     if (!$result) {
    //         $e = oci_error($statement);
    //         throw new Exception("Failed to execute the query: " . htmlentities($e['message'], ENT_QUOTES));
    //     }

    //     $featuredActivities = [];
    //     while ($row = oci_fetch_assoc($statement)) {
    //         $featuredActivities[] = $row;
    //     }

    //     oci_free_statement($statement);
    //     return $featuredActivities;
    // }
    // public static function getFeaturedActivities()
    // {
    //     global $conn;

    //     $query = "
    //         SELECT a.*
    //         FROM activities a
    //         JOIN featured_activities fa ON a.activity_id = fa.activity_id
    //     ";
    //     $statement = oci_parse($conn, $query);
    //     oci_execute($statement);

    //     $activities = [];
    //     while ($activity = oci_fetch_assoc($statement)) {
    //         $activities[] = $activity;  // Add activity to the array
    //     }

    //     oci_free_statement($statement);
    //     return $activities;
    // }
}
