<?php
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Review.php';

class RoomController {
    
    // Display the list of rooms
    public function index() {
        $rooms = Room::getAll();
        include __DIR__ . '/../views/rooms.php';
    }

    // Show a single room with details, reviews, and recommendations
    public function show($id) {
        try {
            // Fetch room details
            $room = Room::find($id);

            // Fetch reviews for the room
            $reviews = Review::getByRoomId($id);

            // Fetch recommended rooms
            $recommendedRooms = Room::getRecommended($id);

            // Load the room details view
            include __DIR__ . '/../views/room.php';
        } catch (Exception $e) {
            echo "<h1>Error: " . $e->getMessage() . "</h1>";
        }
    }

    // Handle room booking
    public function bookRoom() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userId = $_SESSION['user']['USER_ID'];
                $roomId = $_POST['room_id'];
                $checkIn = $_POST['check_in'];
                $checkOut = $_POST['check_out'];
                $totalPrice = $_POST['total_price'];

                Booking::createBooking($userId, $roomId, $checkIn, $checkOut, $totalPrice);

                // Redirect to confirmation page
                header("Location: index.php?page=bookingConfirmation");
                exit;
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        }
    }

    // Add a review for a room
    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userId = $_SESSION['user']['USER_ID'];
                $roomId = $_POST['room_id'];
                $rating = $_POST['rating'];
                $reviewText = $_POST['review_text'];

                Review::addReview($userId, $roomId, $rating, $reviewText);

                // Redirect back to the room page
                header("Location: index.php?page=room&id=$roomId");
                exit;
            } catch (Exception $e) {
                echo "<h1>Error: " . $e->getMessage() . "</h1>";
            }
        }
    }
}
?>
