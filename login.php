<?php
session_start();

// Check if the user is already logged in, if yes, redirect to homepage
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";
// Include functions file
require_once "function.php";
$errorMessage = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Call the authenticateUser function
    $loginResult = authenticateUser($mysqli, $_POST["username"], $_POST["password"]);
    if ($loginResult !== true) {
        // Display error message if login failed
        $errorMessage = $loginResult;
        header("location: login_page.php");
    }
}


// Close connection (moved inside the authenticateUser function)
//$mysqli->close();
?>