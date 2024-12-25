<?php
// Database configuration
$host = "localhost"; // Oracle database host
$port = "1521";      // Oracle database port
$sid = "zakariae7";       // Oracle SID
$username = "system";  // Oracle username
$password = "Lachir77"; // Oracle password

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
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
