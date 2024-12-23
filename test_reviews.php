<?php

require_once __DIR__ . '/config/database.php'; // Adjust the path as necessary

// Test SQL Query
$sql = "
    SELECT 
        u.name AS user_name,
        r.review_text,
        r.rating,
        r.review_date
    FROM 
        featured_reviews fr
    JOIN 
        reviews r ON fr.review_id = r.review_id
    JOIN 
        users u ON r.user_id = u.user_id
";
 
try {
    // Check Database Connection
    if (!$conn) {
        die('Database connection failed!');
    }

    // Parse the query
    $stid = oci_parse($conn, $sql);
    if (!$stid) {
        $e = oci_error($conn);
        die('SQL Parse Error: ' . htmlentities($e['message'], ENT_QUOTES));
    }

    // Execute the query
    if (!oci_execute($stid)) {
        $e = oci_error($stid);
        die('SQL Execution Error: ' . htmlentities($e['message'], ENT_QUOTES));
    }

    // Fetch results
    $results = [];
    while ($row = oci_fetch_assoc($stid)) {
        $results[] = $row;
    }

    oci_free_statement($stid);

    // Debugging: Output fetched data
    if (empty($results)) {
        echo 'Query executed but no results found.';
    } else {
        echo '<pre>';
        print_r($results);
        echo '</pre>';
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
