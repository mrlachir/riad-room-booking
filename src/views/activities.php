<?php 
include 'layout/navbar.php'; 
?>

<h1>Activities Listing</h1>

<div class="activities">
    <?php if (!empty($activities)): ?>
        <div class="activities-list">
            <?php foreach ($activities as $activity): ?>
                <div class="activity-block">
                    <h3><?php echo htmlentities($activity['NAME'], ENT_QUOTES); ?></h3>
                    <p><?php echo htmlentities($activity['DESCRIPTION'], ENT_QUOTES); ?></p>
                    <p><strong>Price:</strong> <?php echo htmlentities($activity['PRICE'], ENT_QUOTES); ?></p>
                    <div>
                        <?php if (!empty($activity['IMAGE'])): ?>
                            <img src="<?php echo htmlentities($activity['IMAGE'], ENT_QUOTES); ?>" alt="Activity Image" width="100">
                        <?php else: ?>
                            <p>No Image</p>
                        <?php endif; ?>
                    </div>
                    <a href="index.php?page=activity&id=<?php echo htmlentities($activity['ACTIVITY_ID'], ENT_QUOTES); ?>" class="learn-more-btn">Learn More</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No activities available.</p>
    <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>

<style>
    .activities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .activity-block {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 20px;
        width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .learn-more-btn {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
    }

    .learn-more-btn:hover {
        background-color: #0056b3;
    }
</style>
<?php
include __DIR__ . '/layout/footer.php'; 
?>