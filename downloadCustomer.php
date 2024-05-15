<?php
session_start();
include("config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");
fputcsv($output, array("Company Name", "Contact Person", "Email", "State", "City", "Credit Limit", "Date", "Status", "Agent Name"));

$sessionid = $_SESSION['id'];
$role = $_SESSION['agentrole'];

if($role == "Admin" || $role == "MANAGER"){
    $query = "SELECT c.companyname, c.contactperson, c.emailaddress, c.state, c.city, c.creditlimit, c.createdat, c.companystatus, l.agentname 
              FROM company c 
              LEFT JOIN login l ON c.createdby = l.id 
              ORDER BY c.id ASC";
} else {
    $query = "SELECT c.companyname, c.contactperson, c.emailaddress, c.state, c.city, c.creditlimit, c.createdat, c.companystatus, l.agentname 
              FROM company c 
              LEFT JOIN login l ON c.createdby = l.id 
              WHERE c.createdby = '$sessionid' 
              ORDER BY c.id ASC";
}

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