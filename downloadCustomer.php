<?php
session_start();
include("config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");
fputcsv($output, array("Company Name", "Contact Person", "Email", "State", "City", "Credit Limit", "Date", "Status"));

$query = "SELECT companyname, contactperson, emailaddress, state, city, creditlimit, createdat, companystatus FROM company ORDER BY id ASC";
$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_assoc($result)) {
    // Convert numeric status to string representation
    switch ($row['companystatus']) {
        case 1:
            $row['companystatus'] = "Working";
            break;
        case 2:
            $row['companystatus'] = "Approved";
            break;
        case 3:
            $row['companystatus'] = "Pending";
            break;
        case 4:
            $row['companystatus'] = "Rejected";
            break;
        default:
            $row['companystatus'] = "Unknown";
    }

    fputcsv($output, $row);
}

fclose($output);
?>