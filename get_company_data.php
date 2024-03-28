<?php
session_start();
require_once "config.php";
if(!($_SESSION)){
    header("location: login_page.php");
}
if(isset($_POST['companyId'])){
    $id = $_POST['companyId'];
    $query = "select * from company where id='$id'";
    $res = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($res);
    $data = $row;
    echo json_encode($data);
}else {
    // Handle the case where 'agentId' is not set
    echo json_encode(array('error' => 'Company ID is not provided'));
}
?>