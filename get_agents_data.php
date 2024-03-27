<?php
session_start();
require_once "config.php";
if(!($_SESSION)){
    header("location: login_page.php");
}
if(isset($_POST['agentId'])) {
    $id = $_POST['agentId'];
    $query = "SELECT * FROM login WHERE id=$id";
    $res = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($res);
    $data = $row;
    
    // Echo the data as JSON
    echo json_encode($data);
} else {
    // Handle the case where 'agentId' is not set
    echo json_encode(array('error' => 'Agent ID is not provided'));
}
?>