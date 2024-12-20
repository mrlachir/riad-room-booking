<?php
include_once '../src/controllers/RoomController.php';

try {
    $rooms = listRooms(); // Fetch rooms from the database

    // Display room data
    foreach ($rooms as $room) {
        echo "<div>";
        echo "<h2>" . htmlentities($room['NAME'], ENT_QUOTES) . "</h2>";
        echo "<p>" . htmlentities($room['DESCRIPTION'], ENT_QUOTES) . "</p>";
        echo "<p>Price: " . htmlentities($room['PRICE'], ENT_QUOTES) . "</p>";
        echo "</div>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage(); // Display any errors
}
?>
