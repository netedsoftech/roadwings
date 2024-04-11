<?php
session_start();
include("config.php");

// Fetch data from MySQL
$sql = "SELECT companyname, contactperson, emailaddress, state, city, creditlimit, createdat FROM company ORDER BY id ASC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export.csv"');

    // Create a file handle for writing
    $file = fopen('php://output', 'w');

    // Write the headers
    $headers = array("Company Name", "Contact Person", "Email ", "State", "City", "Credit Limit", "Date"); // Update with your column names
    fputcsv($file, $headers);

    // Write the data
    while ($row = $result->fetch_assoc()) {
        fputcsv($file, $row);
    }

    // Close the file handle
    fclose($file);

    // Prevent further execution
    exit();
} else {
    echo "No data found";
}
?>