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
    <title>RW Logistics</title>
    <link rel="stylesheet" href="assets/style_login.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                <canvas id="canvas"  >Not supported Canvas!</canvas>
                
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
                                        
                                        <h3 class="form-title">Login</h3>
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group">
                                            <label>Username / Email</label>
                                                <input type="email" name="username" class="form-control">
                                            </div>
                                            <div class="form-group">
                                            <label>Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>


                                            <div class="form-group">
                                            <a class="text-danger" href="forget_password_form.php">forget password?</a>
                                            </div>

                                            <button type="submit" name="login" class="btn signin">Login</button>

                                             <?php if(!empty($errorMessage)){ ?>
                                            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                                        <?php } ?>
                                          
                                        </form>
                                    
                                    </div>
                                </div>
                            
                </div>
            </div>
        </div>
    </div>
</section>


<script src="main_login.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>