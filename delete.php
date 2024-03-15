<?php
include('config.php');
$id = $_GET["id"];
$delete = "delete from login where id='$id'";
mysqli_query($mysqli,$delete);
header('Location: ' . $_SERVER['HTTP_REFERER']);