<?php

require_once __DIR__ . '/../../config/database.php';

class Dashboard {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getStatistics() {
        $stats = [
            'numRooms' => $this->getTotalRooms(),
            'numBookings' => $this->getTotalBookings(),
            'numUsers' => $this->getTotalUsers()
        ];
        return $stats;
    }

    private function getTotalRooms() {
        $query = "SELECT COUNT(*) AS numRooms FROM rooms";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $result = oci_fetch_assoc($stmt);
        return $result['NUMROOMS'];
    }

    private function getTotalBookings() {
        $query = "SELECT COUNT(*) AS numBookings FROM bookings";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $result = oci_fetch_assoc($stmt);
        return $result['NUMBOOKINGS'];
    }

    private function getTotalUsers() {
        $query = "SELECT COUNT(*) AS numUsers FROM users";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $result = oci_fetch_assoc($stmt);
        return $result['NUMUSERS'];
    }

    public function getRecentReviews() {
        $query = "SELECT review_text, rating FROM reviews ORDER BY review_date DESC FETCH FIRST 10 ROWS ONLY";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $reviews = [];
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $reviews[] = $row;
        }
        return $reviews;
    }
    
    public function getRecentBookings() {
        $query = "SELECT b.ROOM_ID, u.NAME as USER_NAME, b.TOTAL_PRICE, 
                  TO_CHAR(b.CHECK_IN, 'YYYY-MM-DD') AS CHECK_IN, 
                  TO_CHAR(b.CHECK_OUT, 'YYYY-MM-DD') AS CHECK_OUT 
                  FROM BOOKINGS b
                  JOIN USERS u ON b.USER_ID = u.USER_ID
                  ORDER BY b.CHECK_IN DESC FETCH FIRST 10 ROWS ONLY";
        $stmt = oci_parse($this->conn, $query);
        oci_execute($stmt);
        $bookings = [];
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $bookings[] = $row;
        }
        return $bookings;
    }
    
    
}
