<?php
session_start();
include('config.php');
//session_destroy();
//echo "<pre>"; print_r($_SESSION);die;
  if(!($_SESSION)){
    header("location: login_page.php");
  }

 if(isset($_POST['carrierid'])){
    $id = $_POST['carrierid'];
    $sql = "select * from truckerdata where id='$id'";
    $res = $mysqli->query($sql);
    $data = $res->fetch_assoc();
    // Convert data to JSON format and send it back to the client
    echo json_encode($data);
    exit(); // Stop further execution
}

?>