<?php
session_start();
require_once "config.php";
if(!($_SESSION)){
    header("location: login_page.php");
}
$id = $_GET["id"];
$delete = "delete from truckerdata where id='$id'";
mysqli_query($mysqli,$delete);
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>