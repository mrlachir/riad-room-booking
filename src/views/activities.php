<?php include 'layout/header.php'; ?>

<h1>Activities Listing</h1>
<div class="activities">
    <?php if (!empty($activities)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Activity ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?php echo htmlentities($activity['ACTIVITY_ID'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlentities($activity['NAME'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlentities($activity['DESCRIPTION'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlentities($activity['PRICE'], ENT_QUOTES); ?></td>
                        <td>
                            <?php if (!empty($activity['IMAGE'])): ?>
                                <img src="<?php echo htmlentities($activity['IMAGE'], ENT_QUOTES); ?>" alt="Activity Image" width="100">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No activities available.</p>
    <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>
