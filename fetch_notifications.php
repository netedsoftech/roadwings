<?php
session_start();
require_once "config.php";
if(!($_SESSION)){
    header("location: login_page.php");
}
$id = $_SESSION['id'];
// Fetch count of unread notifications
/*if($_SESSION['agentrole'] == 'Admin' || $_SESSION['agentrole'] == "MANAGER"){
$queryCount = "SELECT COUNT(*) AS unread_count 
               FROM company 
               WHERE is_read = '0'"; // Assuming you have a column is_read to track read/unread status
}else{
    $queryCount = "SELECT COUNT(*) AS unread_count 
               FROM company 
               WHERE is_read = '0' AND createdby = '$id'"; // Assuming you have a column is_read to track read/unread status
}
$resultCount = mysqli_query($mysqli, $queryCount);
$countRow = mysqli_fetch_assoc($resultCount);
$unreadCount = $countRow['unread_count'];*/

if ($_SESSION['agentrole'] == 'Admin' || $_SESSION['agentrole'] == "MANAGER") {
    $queryCount = "SELECT SUM(unread_count) AS total_unread_count
                   FROM (
                       SELECT COUNT(*) AS unread_count 
                       FROM company 
                       WHERE is_read = '0'
                       UNION ALL
                       SELECT COUNT(*) AS unread_count 
                       FROM truckerdata 
                       WHERE isread = '0'
                   ) AS combined_counts"; // Assuming you have a column is_read to track read/unread status
} else {
    $queryCount = "SELECT SUM(unread_count) AS total_unread_count
                   FROM (
                       SELECT COUNT(*) AS unread_count 
                       FROM company 
                       WHERE is_read = '0' AND createdby = '$id'
                       UNION ALL
                       SELECT COUNT(*) AS unread_count 
                       FROM truckerdata 
                       WHERE isread = '0' AND createdby = '$id'
                   ) AS combined_counts"; // Assuming you have a column is_read to track read/unread status
}

$resultCount = mysqli_query($mysqli, $queryCount);
$countRow = mysqli_fetch_assoc($resultCount);
$unreadCount = $countRow['total_unread_count'];

// Fetch notifications
if($_SESSION['agentrole'] == 'Admin' || $_SESSION['agentrole'] == "MANAGER"){
$query = "SELECT company.createdby, login.agentname, company.createdat 
          FROM company 
          LEFT JOIN login ON company.createdby = login.id
          ORDER BY company.id DESC";
}else{
    $query = "SELECT company.createdby, login.agentname, company.createdat 
          FROM company 
          LEFT JOIN login ON company.createdby = login.id 
          WHERE  company.createdby = '$id'
          ORDER BY company.id DESC";
}


$result = mysqli_query($mysqli, $query);

// Display notifications
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $notificationTime = date('Y-m-d', strtotime($row['createdat'])); // Format the timestamp
        echo '<li>' .'<a class="dropdown-item" href="#" >' . $row['agentname'] . ' added new company at ' . $notificationTime . '</a>' . '</li>';
    }
} else {
    echo 'No new notifications';
}

// Return unread count
echo '<input type="hidden" id="unreadCount" value="' . $unreadCount . '">';
?>