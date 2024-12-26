<?php 
include 'layout/navbar.php'; 
?>

<div class="rooms-container">
    <!-- Filter Section -->
    <div class="filter-section">
        <form action="index.php" method="GET" class="filter-form">
            <input type="hidden" name="page" value="rooms">
            
            <div class="search-field">
                <input type="text" name="search" placeholder="Search rooms..." 
                       value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            </div>
            
            <div class="filter-fields">
                <div class="filter-group">
                    <label for="min_price">Min Price</label>
                    <input type="number" id="min_price" name="min_price" 
                           value="<?php echo htmlspecialchars($_GET['min_price'] ?? ''); ?>">
                </div>
                
                <div class="filter-group">
                    <label for="max_price">Max Price</label>
                    <input type="number" id="max_price" name="max_price" 
                           value="<?php echo htmlspecialchars($_GET['max_price'] ?? ''); ?>">
                </div>
                
                <button type="submit" class="filter-button">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Rooms Grid -->
    <div class="rooms-grid">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room):?>
                <div class="room-card">
                    <div class="room-image">
                        <?php if (!empty($room['IMAGE'])): ?>
                            <img src="<?php echo '/riad-room-booking/'.htmlspecialchars($room['IMAGE']); ?>" alt="Room Image">
                        <?php else: ?>
                            <div class="no-image">No Image Available</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="room-details">
                        <h3><?php echo htmlspecialchars($room['NAME']); ?></h3>
                        <p class="room-description"><?php echo htmlspecialchars($room['DESCRIPTION']); ?></p>
                        <div class="room-info">
                        <?php echo htmlspecialchars($room['NAME'] ?? 'Unnamed Room'); ?>
                            <span class="price">$<?php echo htmlspecialchars($room['PRICE'] ?? '0'); ?>/night</span>
                            <span class="capacity"> 
                                <!-- <?php echo htmlspecialchars($room['CAPACITY']); ?>  -->
                            <!-- Guests</span> -->
                        </div>
                        
                        <a href="index.php?page=room&id=<?php echo $room['ROOM_ID']; ?>" 
                           class="book-now-btn <?php echo $room['is_available'] ? '' : 'unavailable'; ?>">
                            <?php echo $room['is_available'] ? 'Book Now' : 'Unavailable'; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-rooms">No rooms found matching your criteria.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .rooms-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Arial', sans-serif;
    }

    .filter-section {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: flex-end;
    }

    .search-field input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    .filter-fields {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .filter-group {
        flex: 1;
        min-width: 220px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #444;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .filter-button {
        background: #007BFF;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .filter-button:hover {
        background: #0056b3;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .room-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .room-image {
        height: 200px;
        overflow: hidden;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-details {
        padding: 20px;
    }

    .room-details h3 {
        margin: 0 0 10px;
        font-size: 20px;
        color: #333;
    }

    .room-description {
        color: #555;
        margin-bottom: 15px;
        font-size: 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .room-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .price {
        color: #007BFF;
        font-weight: bold;
    }

    .capacity {
        color: #555;
    }

    .book-now-btn {
        display: block;
        text-align: center;
        background: #007BFF;
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
    }

    .book-now-btn:hover {
        background: #0056b3;
    }

    .book-now-btn.unavailable {
        background: #E74C3C;
        cursor: not-allowed;
    }

    .no-rooms {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: #555;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .filter-fields {
            flex-direction: column;
        }

        .filter-group {
            min-width: 100%;
        }

        .room-card {
            margin: 0 auto;
        }
    }
</style>


<?php include 'layout/footer.php'; ?>