<?php
session_start();
include("config.php");
// Fetch data from MySQL
$sql = "SELECT companyname, contactperson, emailaddress, state, city, creditlimit FROM company ORDER BY id ASC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    
    // Create a file handle for writing
    $file = fopen('export.csv', 'w');

    // Write the headers
    $headers = array("companyname", "contactperson", "emailaddress","state","city","creditlimit"); // Update with your column names
    fputcsv($file, $headers);

    // Write the data
    while ($row = $result->fetch_assoc()) {
        fputcsv($file, $row);
    }

    // Close the file handle
    fclose($file);

    // Provide download link
    
} else {
    echo "No data found";
}

// Close the connection
//$mysqli->close();
?>