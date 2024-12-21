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
                
                <!-- <div class="filter-group">
                    <label for="capacity">Capacity</label>
                    <select id="capacity" name="capacity">
                        <option value="">Any</option>
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="4">4 People</option>
                        <option value="6">6+ People</option>
                    </select>
                </div> -->
                
                <!-- <div class="filter-group">
                    <label for="available_date">Check-in Date</label>
                    <input type="date" id="available_date" name="available_date" 
                           value="<?php echo htmlspecialchars($_GET['available_date'] ?? ''); ?>">
                </div> -->
                
                <button type="submit" class="filter-button">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Rooms Grid -->
    <div class="rooms-grid">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <div class="room-card">
                    <div class="room-image">
                        <?php if (!empty($room['IMAGE'])): ?>
                            <img src="<?php echo htmlspecialchars($room['IMAGE']); ?>" alt="Room Image">
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
                            <!-- <span class="capacity"> -->
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
    }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .filter-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .search-field input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .filter-fields {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 5px;
        color: #666;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .filter-button {
        background: #4a90e2;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .filter-button:hover {
        background: #357abd;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    .room-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }

    .room-card:hover {
        transform: translateY(-5px);
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
        margin: 0 0 10px 0;
        color: #333;
    }

    .room-description {
        color: #666;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .room-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .price {
        color: #4a90e2;
        font-weight: bold;
    }

    .capacity {
        color: #666;
    }

    .book-now-btn {
        display: block;
        text-align: center;
        background: #4a90e2;
        color: white;
        padding: 10px;
        border-radius: 4px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .book-now-btn:hover {
        background: #357abd;
    }

    .book-now-btn.unavailable {
        background: #e74c3c;
        cursor: not-allowed;
    }

    .no-rooms {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: #666;
    }

    @media (max-width: 768px) {
        .filter-fields {
            flex-direction: column;
        }

        .filter-group {
            min-width: 100%;
        }
    }
</style>

<?php include 'layout/footer.php'; ?>