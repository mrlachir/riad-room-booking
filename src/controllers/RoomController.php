<?php
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Review.php';

class RoomController {
    
    // Display the list of rooms
    // Display the list of rooms
// public function index() {
//     $rooms = Room::getAll(); // Fetch all rooms

//     if (empty($rooms)) {
//         echo "No rooms found.";
//         return;
//     }

//     // Debug to check the structure of the rooms array
//     var_dump($rooms); // This will show the structure of the $rooms array

//     foreach ($rooms as &$room) {
//         // Check if 'room_id' exists in the current room
//         if (isset($room['room_id'])) {
//             // Check the room availability (assuming a column named 'availability' exists in the DB)
//             $room['available'] = $this->isRoomAvailable($room['room_id']);
//         } else {
//             // If 'room_id' does not exist, log the error or handle it appropriately
//             echo "Room ID not found for a room entry!";
//         }
//     }

//     include __DIR__ . '/../views/rooms.php';
// }
public function index() {
    $filters = [
        'search' => $_GET['search'] ?? '',
        'min_price' => $_GET['min_price'] ?? '',
        'max_price' => $_GET['max_price'] ?? '',
        'capacity' => $_GET['capacity'] ?? '',
        'available_date' => $_GET['available_date'] ?? ''
    ];

    // Get filtered rooms
    $rooms = Room::getFiltered($filters);

    // If available_date is set, check room availability
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

    include __DIR__ . '/../views/rooms.php';
}


// Helper function to check room availability
private function isRoomAvailable($roomId) {
    // You can add a more sophisticated availability check here based on booking data or other factors.
    // For simplicity, let's assume availability is stored in a 'availability' column (1 = available, 0 = unavailable)
    global $conn;
    $query = "SELECT availability FROM rooms WHERE room_id = :roomId";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ":roomId", $roomId);
    oci_execute($statement);
    $room = oci_fetch_assoc($statement);
    oci_free_statement($statement);
    return $room['availability'] == 1;
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
