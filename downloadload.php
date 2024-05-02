<?php
/*session_start();
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

fclose($output);*/

session_start();
include("config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=load.csv');
$output = fopen("php://output", "w");
fputcsv($output, array("From", "To", "Start Date", "Delivery Date", "Company Payments Terms", "CARRIER PAYMENT TERMS", "Company Name", "CUSTOMER RATE", "CARRIER RATE", "ADDED DATE", "ADDED BY", "Company Payment", "Carrier Payment"));

$query = "SELECT 
            loadinfo.locationfrom, 
            loadinfo.locationto, 
            DATE_FORMAT(loadinfo.startdate, '%d-%m-%Y') AS startdate, 
            DATE_FORMAT(loadinfo.deliverydate, '%d-%m-%Y') AS deliverydate, 
            company.paymentterm, 
            truckerdata.carrierpaymentterm, 
            company.companyname, 
            loadinfo.customerrate, 
            loadinfo.carrierrate, 
            DATE_FORMAT(loadinfo.addeddate, '%d-%m-%Y %H:%i') AS addeddate, 
            login.agentname,
            CASE 
                WHEN COALESCE(SUM(companypaymentdetail.companypaidamount), 0) >= loadinfo.customerrate THEN 'Paid' 
                ELSE 'Partial' 
            END AS companypayment,
            CASE 
                WHEN COALESCE(SUM(carrierpaymentdetail.shipperpaidamount), 0) >= loadinfo.carrierrate THEN 'Paid' 
                ELSE 'Partial' 
            END AS carrierpayment
          FROM 
            loadinfo 
          LEFT JOIN 
            company ON loadinfo.companyid = company.id 
          LEFT JOIN 
            login ON loadinfo.addedby = login.id 
          LEFT JOIN 
            truckerdata ON loadinfo.truckerid = truckerdata.id
          LEFT JOIN
            companypaymentdetail ON loadinfo.id = companypaymentdetail.loadid
          LEFT JOIN
            carrierpaymentdetail ON loadinfo.id = carrierpaymentdetail.loadid
          GROUP BY 
            loadinfo.id";

$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, array(
        $row['locationfrom'],
        $row['locationto'],
        $row['startdate'],
        $row['deliverydate'],
        $row['paymentterm'],
        $row['carrierpaymentterm'],
        $row['companyname'],
        $row['customerrate'],
        $row['carrierrate'],
        $row['addeddate'],
        $row['agentname'],
        $row['companypayment'],
        $row['carrierpayment']
    ));
}

fclose($output);
?>