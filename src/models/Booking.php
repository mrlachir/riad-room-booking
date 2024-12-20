<?php
include_once __DIR__ . '/../../config/database.php';

class Booking {
    // Create a new booking
    public static function isRoomAvailable($roomId, $checkIn, $checkOut) {
        global $conn;

        $query = "SELECT COUNT(*) as booking_count 
                  FROM bookings 
                  WHERE room_id = :roomId 
                  AND NOT (
                      check_out < TO_DATE(:checkIn, 'YYYY-MM-DD') 
                      OR check_in > TO_DATE(:checkOut, 'YYYY-MM-DD')
                  )";
                  
        $statement = oci_parse($conn, $query);
        
        // Bind parameters
        oci_bind_by_name($statement, ":roomId", $roomId);
        oci_bind_by_name($statement, ":checkIn", $checkIn);
        oci_bind_by_name($statement, ":checkOut", $checkOut);
        
        // Execute query
        $result = oci_execute($statement);
        
        if (!$result) {
            $e = oci_error($statement);
            oci_free_statement($statement);
            throw new Exception("Error checking room availability: " . $e['message']);
        }
        
        // Fetch result
        $row = oci_fetch_assoc($statement);
        oci_free_statement($statement);
        
        // Return true if no overlapping bookings found
        return ($row['BOOKING_COUNT'] == 0);
    }

    // Create a new booking
    public static function createBooking($userId, $roomId, $checkIn, $checkOut, $totalPrice) {
        // First check if the room is available
        if (!self::isRoomAvailable($roomId, $checkIn, $checkOut)) {
            throw new Exception("Room is not available for the selected dates.");
        }

        global $conn;

        $query = "INSERT INTO bookings (user_id, room_id, check_in, check_out, total_price) 
                  VALUES (:userId, :roomId, TO_DATE(:checkIn, 'YYYY-MM-DD'), TO_DATE(:checkOut, 'YYYY-MM-DD'), :totalPrice)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":userId", $userId);
        oci_bind_by_name($statement, ":roomId", $roomId);
        oci_bind_by_name($statement, ":checkIn", $checkIn);
        oci_bind_by_name($statement, ":checkOut", $checkOut);
        oci_bind_by_name($statement, ":totalPrice", $totalPrice);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            oci_free_statement($statement);
            throw new Exception("Error creating booking: " . $e['message']);
        }

        oci_free_statement($statement);
    }

    // Get all bookings for a specific user
    public static function getByUser($userId) {
        global $conn;

        $query = "SELECT b.*, r.name AS room_name FROM bookings b
                  JOIN rooms r ON b.room_id = r.room_id
                  WHERE b.user_id = :userId ORDER BY b.check_in DESC";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":userId", $userId);
        oci_execute($statement);

        $bookings = [];
        while ($row = oci_fetch_assoc($statement)) {
            $bookings[] = $row;
        }

        oci_free_statement($statement);
        return $bookings;
    }

    // Get a booking by ID
    public static function find($bookingId) {
        global $conn;

        $query = "SELECT b.*, r.name AS room_name, u.name AS user_name FROM bookings b
                  JOIN rooms r ON b.room_id = r.room_id
                  JOIN users u ON b.user_id = u.user_id
                  WHERE b.booking_id = :bookingId";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":bookingId", $bookingId);
        oci_execute($statement);

        $booking = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        if (!$booking) {
            throw new Exception("Booking not found.");
        }

        return $booking;
    }

    // Cancel a booking
    public static function cancelBooking($bookingId) {
        global $conn;

        $query = "DELETE FROM bookings WHERE booking_id = :bookingId";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":bookingId", $bookingId);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            oci_free_statement($statement);
            throw new Exception("Error cancelling booking: " . $e['message']);
        }

        oci_free_statement($statement);
    }
}
?>
