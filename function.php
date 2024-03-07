<?php
session_start();
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
        $sql = "SELECT id, email, password,agentrole FROM login WHERE email = '$username'";

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
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["agentrole"] = $row['agentrole'];

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

function insertData($mysqli, $agentname, $email, $password,$agentphoneno,$agentrole,$date) {
    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Construct the SQL query
    $sql = "INSERT INTO login (agentname, email, password,agentphoneno,agentrole,createdat) VALUES ('$agentname', '$email', '$password_hash','$agentphoneno','$agentrole','".$date."')";
    
    // Execute the query
    if ($mysqli->query($sql) === TRUE) {
        return true; // Insertion successful
    } else {
        return false; // Insertion failed
    }
}

function getAgents($mysqli) {
    $data = array();

    // Perform SQL query to fetch data
    $result = $mysqli->query("SELECT * FROM login where agentrole<>'admin' order by id desc");

    // Fetch data and store in array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Free result set
    $result->free();

    return $data;
}
?>