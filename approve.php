<?php
session_start();
require_once "config.php";
require_once "function.php";
//echo "<pre>"; print_r($_SESSION);die;
if(!($_SESSION)){
    header("location: login_page.php");
  }
  include("header.php");

  $query = "update company set companystatus = '2'";
  $res = $mysqli->query($query);
  header("Location:".$_SERVER['HTTP_REFERER']);
?>