<?php 
include 'layout/header.php'; 
?>

<h1>Rooms Listing</h1>
<div class="rooms">
    <?php if (!empty($rooms)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Room Type</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo htmlentities($room['ROOM_ID'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlentities($room['NAME'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlentities($room['DESCRIPTION'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlentities($room['PRICE'], ENT_QUOTES); ?></td>
                        <td><?php echo $room['AVAILABILITY'] ? 'Available' : 'Not Available'; ?></td>
                        <td><?php echo htmlentities($room['ROOM_TYPE'], ENT_QUOTES); ?></td>
                        <td>
                            <?php if (!empty($room['IMAGE'])): ?>
                                <img src="<?php echo htmlentities($room['IMAGE'], ENT_QUOTES); ?>" alt="Room Image" width="100">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No rooms available.</p>
    <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>
