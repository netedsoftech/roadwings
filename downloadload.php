<?php
session_start();
include("config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=load.csv');
$output = fopen("php://output", "w");
fputcsv($output, array("From", "To", "Start Date","STATUS", "Delivery Date", "Company Payments Terms", "CARRIER PAYMENT TERMS", "Company Name" ,"CUSTOMER RATE", "CARRIER RATE","ADDED DATE","ADDED BY"));


$sessionid = $_SESSION['id'];
$role = $_SESSION['agentrole'];
$query = "select loadinfo.locationfrom,loadinfo.locationto,loadinfo.startdate,loadinfo.status,loadinfo.deliverydate,company.paymentterm,truckerdata.carrierpaymentterm,company.companyname,loadinfo.customerrate,loadinfo.carrierrate,loadinfo.addeddate,login.agentname from loadinfo left join company on loadinfo.companyid=company.id left join login on loadinfo.addedby=login.id left join truckerdata on loadinfo.truckerid = truckerdata.id";

$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_assoc($result)) {
    // Convert numeric status to string representation
    switch ($row['status']) {
        case 0:
            $row['status'] = "Pending";
            break;
        case 1:
            $row['status'] = "Paid";
            break;
        
        default:
            $row['status'] = "Unknown";
    }

    fputcsv($output, $row);
}

fclose($output);
?>