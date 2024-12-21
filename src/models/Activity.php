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
}
