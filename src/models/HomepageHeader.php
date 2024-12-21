<?php
require_once __DIR__. '/../../config/database.php'; // Include the Oracle connection script

class HomepageHeader
{
    public static function getHeader()
    {
        global $conn;

        $query = "SELECT * FROM homepage_header";
        $stid = oci_parse($conn, $query);
        oci_execute($stid);

        $header = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        oci_free_statement($stid);
        return $header;
    }
}