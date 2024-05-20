<?php 
session_start();
include("header.php");
require_once "config.php";
require_once "function.php";
if(!($_SESSION)){
    header("location: login_page.php");
  }

  //echo "<pre>"; print_r($_SESSION);die;


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "<pre>"; print_r($_POST);die;
    // Get the form data
    $sessionid = $_SESSION['id'];
    $comapnyname = $_POST["comapnyname"];
    $contactperson = $_POST["contactperson"];
    $emailaddress = $_POST['emailaddress'];
    $phone_cleaned = $_POST['companycontactno'];
    $companycontactno = preg_replace('/\D/', '', $phone_cleaned);
    
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $phoneno = "";
    $mailingaddress = $_POST['mailingaddress'];
    $accountPayable = $_POST['accountPayable'];
    $accountPayableEmail = $_POST['accountPayableEmail'];
    $accountPayableNumber = $_POST['accountPayableNumber'];
    $creditlimit = $_POST['creditlimit'];
    $paymentterm =  $_POST['paymentterm'];
    
    $createdat = date('Y-m-d, H:i:s');

    // Call the insertData function
    // Assuming $mysqli is your database connection object
    $insertResult = addCompany($mysqli, $sessionid, $comapnyname,$contactperson,$emailaddress,$companycontactno,$address,$zipcode,$city,$phoneno,$mailingaddress,$accountPayable,$accountPayableEmail,$accountPayableNumber,$creditlimit,$createdat,$state,$paymentterm );

    // Check the result of the insertion
    $message = "";
    if ($insertResult) {
        $message = "Company added successfully.";
    } else {
        // Insertion failed
        $message = "Failed to add company.";
    }
}
?>
<title>Add Customer</title>
  <body>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
        <?php  
           include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
            <?php include("topHeader.php");?>
             <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Add  Shipments</h5>
              <?php if(!empty($message)){
                ?>
                <script>
                 Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "<?php echo $message?>",
                  showConfirmButton: false,
                  timer: 1500
                });
                </script>
              <?php
                echo $message;
              }?>
              <span class="rounded-pill shadow text-white">Assembly</span>
             </div>

             <div class="row mt-4 ">
              <div class="col-lg-9">
                <div class="main-header p-3 ">
                  <form method="post">
                    <h5 class="mt-2 mb-5">Edit Company Details</h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                      <label for="comapnyname">Company Name *</label>
                        <input class="form-control" name="comapnyname" type="text"  required >
                      </div>

                      <div class="form-group mb-4 ">
                      <label for="contactperson">Contact Person *</label>
                        <input class="form-control" name="contactperson" type="text"  required>
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                      <label for="emailaddress">E-mail ID *</label>
                        <input class="form-control" name="emailaddress" type="email"  required>
                      </div>

                      <div class="form-group mb-4 ">
                      <label for="companycontactno">Contact Number *</label>
                        <input class="form-control" required name="companycontactno" type="tel" minlength="12" maxlength="12">
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="address">Address *</label>
                        <input class="form-control" required name="address" type="text"  >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="zipcode">Zip Code</label>
                        <input class="form-control" required name="zipcode" type="text" >
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="city">City</label>
                        <input class="form-control" required name="city" type="text" >
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="state">State</label>
                        <input class="form-control" required name="state" type="text" >
                      </div>

                    </div>

                   <!--  <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="phoneno" type="text" placeholder="PHONE NUMBER:">
                      </div>

                    </div> -->

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="mailingaddress">Mailiing Address</label>
                        <input class="form-control" name="mailingaddress" type="text" >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="accountPayable">Account Payable</label>
                        <input class="form-control" required name="accountPayable" type="text" >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="accountPayableEmail">Account Payable Email</label>
                        <input class="form-control" required name="accountPayableEmail" type="text" >
                      </div>

                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="accountPayableNumber">Account Payable Number</label>
                        <input class="form-control" required name="accountPayableNumber" type="tel" >
                      </div>

                    </div>

                    <!-- <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select name="companyStatus"  class="form-control">
                         <?php //if($_SESSION['agentrole'] == "Agent" || $_SESSION['agentrole'] == "Team leader"): ?>
                              <option value="3">Pending</option>
                          <?php //else: ?>
                              <option ></option>
                              <option selected>Company Status</option>
                              <option value="1">Working</option>
                              <option value="2">Approved</option>
                              <option value="3">Pending</option>
                              <option value="4">Rejected</option>
                              <option value="5">High Risk</option>
                          <?php //endif; ?>
                        </select>

                      </div>
                    </div> -->

                   <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="paymentterm">Payment Terms ( 1 - 50 days)</label>
                        <select name="paymentterm"  class="form-control">
                          <option value="1">1</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                          <option value="30">30</option>
                          <option value="35">35</option>
                          <option value="40">40</option>
                          <option value="45">45</option>
                          <option value="50">50</option>
                         
                        </select>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <label for="creditlimit">Credit Limit</label>
                        <input class="form-control" required name="creditlimit" type="tel" minlength="2" maxlength="4" >
                      </div>
                    </div>


                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 form-item mt-4">
                        <button name="addcompany" class="btn ">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>
              </div>
              
              <?php include("rightbar.php");?>
             </div>
          </div>
        </div>
      </div>
    </section>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

