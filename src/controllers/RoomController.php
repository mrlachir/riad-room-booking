<?php
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Review.php';

class RoomController
{

    // Display the list of rooms with filters
    public function index()
    {
        // Define filters based on GET parameters
        $filters = [
            'search' => $_GET['search'] ?? '',
            'min_price' => $_GET['min_price'] ?? '',
            'max_price' => $_GET['max_price'] ?? '',
            'capacity' => $_GET['capacity'] ?? '',
            'available_date' => $_GET['available_date'] ?? ''
        ];

        // Fetch filtered rooms
        $rooms = Room::getFiltered($filters);

        // If available_date is provided, check room availability
        if (!empty($filters['available_date'])) {
            foreach ($rooms as &$room) {
                $room['is_available'] = Booking::isRoomAvailable(
                    $room['ROOM_ID'],
                    $filters['available_date'],
                    date('Y-m-d', strtotime($filters['available_date'] . ' +1 day'))
                );
            }
        } else {
            // Set all rooms as available if no date is specified
            foreach ($rooms as &$room) {
                $room['is_available'] = true;
            }
        }

        // Include the rooms view
        include __DIR__ . '/../views/rooms.php';
    }

    // Show a single room with details, reviews, and recommendations
    // public function show($id)
    // {
    //     try {
    //         // Fetch room details
    //         $room = Room::find($id);

    //         // Fetch reviews for the room
    //         $reviews = Review::getByRoomId($id);

    //         // Fetch recommended rooms
    //         $recommendedRooms = Room::getRecommended($id);

    //         // Load the room details view
    //         include __DIR__ . '/../views/room.php';
    //     } catch (Exception $e) {
    //         echo "<h1>Error: " . $e->getMessage() . "</h1>";
    //     }
    // }
    public function show($id)
{
    try {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Fetch room details
        $room = Room::find($id);

        // Fetch reviews for the room
        $reviews = Review::getByRoomId($id);

        // Fetch recommended rooms
        $recommendedRooms = Room::getRecommended($id);

        // Check if user has booked this room
        $hasBooked = false;
        if (isset($_SESSION['user'])) {
            $hasBooked = Booking::hasUserBookedRoom($_SESSION['user']['USER_ID'], $id);
        }

        // Load the room details view
        include __DIR__ . '/../views/room.php';
    } catch (Exception $e) {
        echo "<h1>Error: " . $e->getMessage() . "</h1>";
    }
}


    // Handle room booking
    public function bookRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Start session if not already started
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // Fetch necessary data for booking
                $userId = $_SESSION['user']['USER_ID'];
                $roomId = $_POST['room_id'];
                $checkIn = $_POST['check_in'];
                $checkOut = $_POST['check_out'];

                // Fetch room details to get the price per night
                $room = Room::find($roomId);
                if (!$room) {
                    throw new Exception("Room not found.");
                }

                $pricePerNight = $room['PRICE'];

                // Calculate total price
                $checkInDate = new DateTime($checkIn);
                $checkOutDate = new DateTime($checkOut);
                $interval = $checkInDate->diff($checkOutDate);

                if ($interval->days <= 0) {
                    throw new Exception("Invalid date range. Check-out must be after check-in.");
                }

                $totalPrice = $interval->days * $pricePerNight;

                // Create a new booking
                $bookingId = Booking::createBooking($userId, $roomId, $checkIn, $checkOut, $totalPrice);
                if (!$bookingId) {
                    throw new Exception("Failed to create booking. Booking ID not generated.");
                }

                // Store the booking ID in session
                $_SESSION['last_booking_id'] = $bookingId;

                // Redirect to confirmation page
                header("Location: index.php?page=confirmation&bookingId=" . urlencode($bookingId));
                exit;
            } catch (Exception $e) {
                // Error handling
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        }
    }



    // Add a review for a room
    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Fetch necessary data for adding a review
                $userId = $_SESSION['user']['USER_ID'];
                $roomId = $_POST['room_id'];
                $rating = $_POST['rating'];
                $reviewText = $_POST['review_text'];

                // Add the review to the database
                Review::addReview($userId, $roomId, $rating, $reviewText);

                // Redirect back to the room details page
                header("Location: index.php?page=room&id=$roomId");
                exit;
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        }
    }

    // Helper function to check room availability (not used in the updated index method)
    private function isRoomAvailable($roomId)
    {
        global $conn;

        // Query to check room availability
        $query = "SELECT availability FROM rooms WHERE room_id = :roomId";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ":roomId", $roomId);
        oci_execute($statement);

        // Fetch the availability status
        $room = oci_fetch_assoc($statement);
        oci_free_statement($statement);

        // Return true if the room is available (availability = 1)
        return $room['availability'] == 1;
    }
    public function showConfirmation($bookingId)
    {
        // Assuming Booking model has a method to fetch booking details
        try {
            $booking = Booking::find($bookingId); // Fetch the booking details
            include __DIR__ . '/../views/confirmation.php'; // Render the confirmation page
        } catch (Exception $e) {
            // Handle error if booking is not found
            echo "Error fetching booking details: " . $e->getMessage();
        }
    }
}
