<?php
// Database configuration
$host = "localhost"; // Oracle database host
$port = "1521";      // Oracle database port
$sid = "orcl";       // Oracle SID (orcl is the default SID)
$username = "system";  // Oracle username
$password = "lachir"; // Oracle password

// Connection string (DSN)
$dsn = "(DESCRIPTION=
    (ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))
    (CONNECT_DATA=(SID=$sid))
)";

try {
    // Create connection using oci_connect
    $conn = oci_connect($username, $password, $dsn, 'AL32UTF8');

    if (!$conn) {
        // Handle connection error
        $e = oci_error();
        throw new Exception("Connection failed: " . htmlentities($e['message'], ENT_QUOTES));
    }

    echo "Connected to Oracle Database successfully!<br>";

    // Query to fetch data from rooms table
    $query = "SELECT * FROM rooms";
    $statement = oci_parse($conn, $query);
    if (!$statement) {
        // Handle parse error
        $e = oci_error($conn);
        throw new Exception("Failed to prepare the query: " . htmlentities($e['message'], ENT_QUOTES));
    }

    // Execute the query
    $result = oci_execute($statement);
    if (!$result) {
        // Handle execution error
        $e = oci_error($statement);
        throw new Exception("Failed to execute the query: " . htmlentities($e['message'], ENT_QUOTES));
    }

    // Fetch and display the results
    echo "<h1>Rooms Table Data</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Room ID</th><th>Name</th><th>Description</th><th>Price</th><th>Availability</th><th>Room Type</th></tr>";
    while ($row = oci_fetch_assoc($statement)) {
        echo "<tr>";
        echo "<td>" . htmlentities($row['ROOM_ID'], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlentities($row['NAME'], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlentities($row['DESCRIPTION'], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlentities($row['PRICE'], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlentities($row['AVAILABILITY'], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlentities($row['ROOM_TYPE'], ENT_QUOTES) . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Free the statement resource
    oci_free_statement($statement);

} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} finally {
    // Close the connection at the very end
    if (isset($conn) && $conn) {
        oci_close($conn);
        echo "<br>Connection closed successfully.";
    }
}
?>
