<?php
session_start();
include("config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Truckerdata.csv');
$output = fopen("php://output", "w");
fputcsv($output, array("Trucker Name", "Trucker Address", "Email", "Phone Number", "MC Number", "Payment Terms", "Date", "Added By"));

$sessionid = $_SESSION['id'];
$role = $_SESSION['agentrole'];
if ($role == "Admin" || $role == "MANAGER") {
    $query = "SELECT truckerdata.tname, truckerdata.taddress, truckerdata.temail, truckerdata.tphoneno, truckerdata.tmcno, truckerdata.carrierpaymentterm, truckerdata.createdat, login.agentname AS added_by FROM truckerdata LEFT JOIN login ON truckerdata.createdby = login.id ORDER BY truckerdata.id ASC";
} else {
    $query = "SELECT tname, taddress, temail, tphoneno, tmcno, carrierpaymentterm, createdat FROM company WHERE createdby = '$sessionid' ORDER BY id ASC";
}

$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $row['Added By'] = $row['added_by']; // Rename 'added_by' to 'Added By'
    unset($row['added_by']); // Remove 'added_by' column
    fputcsv($output, $row);
}

fclose($output);
?>