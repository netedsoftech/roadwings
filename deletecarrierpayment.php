<?php 
session_start();
include("header.php");
require_once "config.php";
require_once "function.php";
if(!($_SESSION)){
    header("location: login_page.php");
}

$id = $_GET['id'];
$query = "delete from carrierpaymentdetail where id='$id'";
mysqli_query($mysqli,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>