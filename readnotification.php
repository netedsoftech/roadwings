<?php
session_start();
require_once "config.php";
if(!($_SESSION)){
    header("location: login_page.php");
}
//echo "<pre>"; print_r($_SESSION); die;
$readnotification = $_POST['readnotification'];
$id = $_SESSION['id'];
if($readnotification == "Read"){
	if($_SESSION['agentrole'] == 'Admin' || $_SESSION['agentrole'] == "MANAGER"){
		
		$query = "update company set is_read = '1'";
	}else{
		//$query = "update company set is_read = '1' where createdby = '$id'";
	}

	mysqli_query($mysqli,$query);
	
}
?>