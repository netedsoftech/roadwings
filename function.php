<?php
// Function to authenticate user login
function authenticateUser($mysqli, $username, $password) {
    // Define variables and initialize with empty values
    $username_err = $password_err = "";

    // Check if username is empty
    if(empty(trim($username))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($username);
    }

    // Check if password is empty
    if(empty(trim($password))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($password);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM login WHERE username = '$username'";

        $result = $mysqli->query($sql);

        if($result){
            // Check if username exists, if yes then verify password
            if($result->num_rows == 1){

                $row = $result->fetch_assoc();
                
                if(md5($password) == $row['password']){
                    // Password is correct, start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["username"] = $row['username'];

                    // Redirect user to welcome page
                    header("location: index.php");
                    exit;
                } else{
                    // Password is not valid, display a generic error message
                    return "Invalid username or password.";
                }
            } else{
                // Username doesn't exist, display a generic error message
                return "Invalid username or password.";
            }
        } else{
            return "Oops! Something went wrong. Please try again later.";
        }
    }
}
?>