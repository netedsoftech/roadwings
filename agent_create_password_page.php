<?php

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
    //echo "<pre>"; print_r($_POST);die;
    // Call the authenticateUser function
    $password = $_POST["password"];
    $email = $_GET['email'];
    $result = createPassword($mysqli, $email, $password);
    $error = "";
    $success = "";
    if ($result=="Password create successfully.") {
        $success = "Password create successfully.";
    }else{
        $error = "Create password faild.";
    }
}
//echo $errorMessage; die("here i am working");


// Close connection (moved inside the authenticateUser function)
//$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style_login.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                
            </div>
            <div class="col-lg-4">
                <div class="form-bg">

                                <div class="form-container rounded">
                                    <div class="left-content rounded">
                                        <img class=" title w-50" src="./assets/img/logo_img.png">
                                        <!-- <h3 class="title">RoadWings <span>Logistics</span> </h3> -->
                                        <h4 class="sub-title">Better solution
                                            For Logistics</h4>
                                           
                                    </div>
                                    <div class="right-content">
                                        
                                        <!-- <h3 class="form-title">Create Passw</h3> -->
 


<form class="form-horizontal" method="post" onsubmit="return validatePasswords()">
    <?php if(!empty($success)){
        ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Success",
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = "login_page.php";
            });
        </script>
        <?php
        echo $success;
    }?>
    <?php if(!empty($error)){
        ?>
         <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
        <?php

        echo $error;

    }?>
    <div class="form-group">
        <label>Create Password</label>
        <input type="password" name="password" id="createpassword" name="createpassword" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" required>
        <span id="passwordError" style="color: red; display: none;">Passwords do not match.</span>
    </div>
    <div class="form-group">
        <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()"> Show Password
    </div>
    <button type="submit" name="login" class="btn signin">Create Password</button>
</form>

<script>
    function validatePasswords() {
        var password1 = document.getElementById("createpassword").value;
        var password2 = document.getElementById("confirmpassword").value;

        if (password1 !== password2) {
            document.getElementById("passwordError").style.display = "block";
            return false;
        } else {
            document.getElementById("passwordError").style.display = "none";
            return true;
        }
    }

    function togglePasswordVisibility() {
        var createPasswordInput = document.getElementById("createpassword");
        var confirmPasswordInput = document.getElementById("confirmpassword");
        var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

        if (showPasswordCheckbox.checked) {
            createPasswordInput.type = "text";
            confirmPasswordInput.type = "text";
        } else {
            createPasswordInput.type = "password";
            confirmPasswordInput.type = "password";
        }
    }
</script>

                                    
                                    </div>
                                </div>
                            
                </div>
            </div>
            <div class="col-lg-4">
                
            </div>
        </div>
    </div>
</section>


<script src="main_login.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>