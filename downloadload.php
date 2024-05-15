<?php
session_start();
include("config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=load.csv');
$output = fopen("php://output", "w");
fputcsv($output, array("From", "To", "Start Date", "Delivery Date", "Company Payments Terms", "CARRIER PAYMENT TERMS", "Company Name", "CUSTOMER RATE", "CARRIER RATE", "ADDED DATE", "ADDED BY", "Company Payment", "Carrier Payment", "Company Payment Date", "Carrier Payment Date", "Company Payment Left", "Carrier Payment Left", "Total Company Paid Amount", "Next Payment Date", "Total Carrier Paid Amount", "Carrier Next Payment Date", "Total Profit"));

$sqlLoadInfo = "SELECT loadinfo.*, 
    company.id AS cid, 
    company.companyname, 
    company.paymentterm, 
    login.agentname, 
    truckerdata.carrierpaymentterm,
    truckerdata.id AS tid
    FROM 
    loadinfo 
    LEFT JOIN 
    company ON loadinfo.companyid = company.id 
    LEFT JOIN 
    login ON loadinfo.addedby = login.id 
    LEFT JOIN 
    truckerdata ON loadinfo.truckerid = truckerdata.id";
$resultLoadInfo = $mysqli->query($sqlLoadInfo);
$loadInfoData = array();
while ($row = $resultLoadInfo->fetch_assoc()) {
    $loadInfoData[] = $row;
}

// Retrieve company payment details
$sqlCompanyPayment = "SELECT loadid, companypaymentstatus, COALESCE(SUM(companypaidamount), 0) AS total_companypaidamount, MAX(companypaymentdate) AS companypaymentdate, MAX(nextpaymentdate) AS nextpaymentdate FROM companypaymentdetail GROUP BY loadid";
$resultCompanyPayment = $mysqli->query($sqlCompanyPayment);
$companyPaymentData = array();
while ($row = $resultCompanyPayment->fetch_assoc()) {
    $companyPaymentData[$row['loadid']] = $row;
}

// Retrieve carrier payment details
$sqlCarrierPayment = "SELECT 
    loadid,
    truckerpaymentstatus,
    COALESCE(SUM(shipperpaidamount), 0) AS total_shipperpaidamount,
    MAX(shippperpaymentdate) AS shippperpaymentdate,
    MAX(carriernextpaymentdate) AS carriernextpaymentdate
    
FROM 
    carrierpaymentdetail 
GROUP BY 
    loadid";
$resultCarrierPayment = $mysqli->query($sqlCarrierPayment);
$carrierPaymentData = array();
while ($row = $resultCarrierPayment->fetch_assoc()) {
    $carrierPaymentData[$row['loadid']] = $row;
}


$mergedData = array();
foreach ($loadInfoData as $load) {
    $loadId = $load['id'];
    $mergedData[$loadId] = $load;
    
    // Add company payment data if available
    if (isset($companyPaymentData[$loadId])) {
        $mergedData[$loadId]['company_payment_data'] = $companyPaymentData[$loadId];
        // Calculate company payment left
        $mergedData[$loadId]['company_payment_left'] = $load['customerrate'] - $companyPaymentData[$loadId]['total_companypaidamount'];
    }
    
    // Add carrier payment data or set as empty if not available
    if (isset($carrierPaymentData[$loadId])) {
        $mergedData[$loadId]['carrier_payment_data'] = $carrierPaymentData[$loadId];
        // Calculate carrier payment left
        $mergedData[$loadId]['carrier_payment_left'] = $load['carrierrate'] - $carrierPaymentData[$loadId]['total_shipperpaidamount'];
    } else {
        // Set carrier payment data as empty
        $mergedData[$loadId]['carrier_payment_data'] = array();
        // Set carrier payment left as the full carrier rate
        $mergedData[$loadId]['carrier_payment_left'] = $load['carrierrate'];
    }

    // Calculate total profit
    $totalProfit = $load['customerrate'] - $load['carrierrate'];

    // Write data to CSV
    fputcsv($output, array(
        $load['locationfrom'],
        $load['locationto'],
        $load['startdate'],
        $load['deliverydate'],
        $load['paymentterm'],
        $load['carrierpaymentterm'],
        $load['companyname'],
        $load['customerrate'],
        $load['carrierrate'],
        $load['addeddate'],
        $load['agentname'],
        isset($companyPaymentData[$loadId]) ? $companyPaymentData[$loadId]['total_companypaidamount'] : '', // Company Payment
        isset($carrierPaymentData[$loadId]) ? $carrierPaymentData[$loadId]['total_shipperpaidamount'] : '', // Carrier Payment
        isset($companyPaymentData[$loadId]) ? $companyPaymentData[$loadId]['companypaymentdate'] : '', // Company Payment Date
        isset($carrierPaymentData[$loadId]) ? $carrierPaymentData[$loadId]['shippperpaymentdate'] : '', // Carrier Payment Date
        isset($mergedData[$loadId]['company_payment_left']) ? $mergedData[$loadId]['company_payment_left'] : '', // Company Payment Left
        isset($mergedData[$loadId]['carrier_payment_left']) ? $mergedData[$loadId]['carrier_payment_left'] : '', // Carrier Payment Left
        isset($companyPaymentData[$loadId]) ? $companyPaymentData[$loadId]['total_companypaidamount'] : '', // Total Company Paid Amount
        isset($companyPaymentData[$loadId]) ? $companyPaymentData[$loadId]['nextpaymentdate'] : '', // Next Payment Date
        isset($carrierPaymentData[$loadId]) ? $carrierPaymentData[$loadId]['total_shipperpaidamount'] : '', // Total Shipper Paid Amount
        isset($carrierPaymentData[$loadId]) ? $carrierPaymentData[$loadId]['carriernextpaymentdate'] : '', // Carrier Next Payment Date
        $totalProfit // Total Profit
    ));
}

fclose($output);
?>
