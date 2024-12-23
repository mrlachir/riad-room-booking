<?php

class AdminHome {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // In src/models/AdminHome.php, add these methods:

public function getAllHeaders() {
    $query = "SELECT * FROM homepage_header ORDER BY header_id DESC";
    $stmt = oci_parse($this->conn, $query);
    oci_execute($stmt);
    
    $headers = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $headers[] = $row;
    }
    oci_free_statement($stmt);
    return $headers;
}

public function getAllFeaturedRooms() {
    $query = "SELECT fr.featured_room_id, r.* 
              FROM featured_rooms fr 
              JOIN rooms r ON fr.room_id = r.room_id 
              ORDER BY fr.featured_room_id DESC";
    $stmt = oci_parse($this->conn, $query);
    oci_execute($stmt);
    
    $featuredRooms = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $featuredRooms[] = $row;
    }
    oci_free_statement($stmt);
    return $featuredRooms;
}

public function getAllFeaturedActivities() {
    $query = "SELECT fa.featured_activity_id, a.* 
              FROM featured_activities fa 
              JOIN activities a ON fa.activity_id = a.activity_id 
              ORDER BY fa.featured_activity_id DESC";
    $stmt = oci_parse($this->conn, $query);
    oci_execute($stmt);
    
    $featuredActivities = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $featuredActivities[] = $row;
    }
    oci_free_statement($stmt);
    return $featuredActivities;
}

    // src/models/AdminHome.php (Add these methods to the existing class)
public function createHeader($image, $overlayText) {
    $query = "INSERT INTO homepage_header (image, overlay_text) VALUES (:image, :overlay_text)";
    $stmt = oci_parse($this->conn, $query);
    oci_bind_by_name($stmt, ":image", $image);
    oci_bind_by_name($stmt, ":overlay_text", $overlayText);
    $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    oci_free_statement($stmt);
    return $result;
}

public function createFeaturedRoom($roomId) {
    // Check if room is already featured
    $checkQuery = "SELECT COUNT(*) as count FROM featured_rooms WHERE room_id = :room_id";
    $checkStmt = oci_parse($this->conn, $checkQuery);
    oci_bind_by_name($checkStmt, ":room_id", $roomId);
    oci_execute($checkStmt);
    $row = oci_fetch_assoc($checkStmt);
    
    if ($row['COUNT'] > 0) {
        return false; // Room is already featured
    }
    
    $query = "INSERT INTO featured_rooms (room_id) VALUES (:room_id)";
    $stmt = oci_parse($this->conn, $query);
    oci_bind_by_name($stmt, ":room_id", $roomId);
    $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    oci_free_statement($stmt);
    return $result;
}

public function createFeaturedActivity($activityId) {
    // Check if activity is already featured
    $checkQuery = "SELECT COUNT(*) as count FROM featured_activities WHERE activity_id = :activity_id";
    $checkStmt = oci_parse($this->conn, $checkQuery);
    oci_bind_by_name($checkStmt, ":activity_id", $activityId);
    oci_execute($checkStmt);
    $row = oci_fetch_assoc($checkStmt);
    
    if ($row['COUNT'] > 0) {
        return false; // Activity is already featured
    }
    
    $query = "INSERT INTO featured_activities (activity_id) VALUES (:activity_id)";
    $stmt = oci_parse($this->conn, $query);
    oci_bind_by_name($stmt, ":activity_id", $activityId);
    $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    oci_free_statement($stmt);
    return $result;
}

public function getAllRooms() {
    $query = "SELECT * FROM rooms WHERE room_id NOT IN (SELECT room_id FROM featured_rooms)";
    $stmt = oci_parse($this->conn, $query);
    oci_execute($stmt);
    $rooms = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $rooms[] = $row;
    }
    oci_free_statement($stmt);
    return $rooms;
}

public function getAllActivities() {
    $query = "SELECT * FROM activities WHERE activity_id NOT IN (SELECT activity_id FROM featured_activities)";
    $stmt = oci_parse($this->conn, $query);
    oci_execute($stmt);
    $activities = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $activities[] = $row;
    }
    oci_free_statement($stmt);
    return $activities;
}

    public function deleteHeader($id) {
        // First, get the header image path to delete the file
        $query = "SELECT image FROM homepage_header WHERE header_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
        $header = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);

        // Delete the record
        $query = "DELETE FROM homepage_header WHERE header_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);

        return ['success' => $result, 'image_path' => $header ? $header['IMAGE'] : null];
    }

    public function deleteFeaturedRoom($id) {
        $query = "DELETE FROM featured_rooms WHERE featured_room_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }

    public function deleteFeaturedActivity($id) {
        $query = "DELETE FROM featured_activities WHERE featured_activity_id = :id";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ":id", $id);
        $result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        return $result;
    }
}

// src/controllers/AdminHomeController.php
