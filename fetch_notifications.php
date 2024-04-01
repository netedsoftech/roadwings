<?php
session_start();
require_once "config.php";
if(!($_SESSION)){
    header("location: login_page.php");
}

// Fetch count of unread notifications

$queryCount = "SELECT COUNT(*) AS unread_count 
               FROM company 
               WHERE is_read = '0'"; // Assuming you have a column is_read to track read/unread status
$resultCount = mysqli_query($mysqli, $queryCount);
$countRow = mysqli_fetch_assoc($resultCount);
$unreadCount = $countRow['unread_count'];

// Fetch notifications
$query = "SELECT company.createdby, login.agentname, company.createdat 
          FROM company 
          LEFT JOIN login ON company.createdby = login.id 
          WHERE company.is_read = '0'
          ORDER BY company.id DESC";
$result = mysqli_query($mysqli, $query);

// Display notifications
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $notificationTime = date('Y-m-d', strtotime($row['createdat'])); // Format the timestamp
        echo '<div class="notification">' . $row['agentname'] . ' added new company at ' . $notificationTime . '</div>';
    }
} else {
    echo 'No new notifications';
}

// Return unread count
echo '<input type="hidden" id="unreadCount" value="' . $unreadCount . '">';
?>