<?php 
session_start();
include("header.php");
require_once "config.php";
require_once "function.php";
if(!($_SESSION)){
    header("location: login_page.php");
  }

$companyIds = $_GET['id'];


//echo "<pre>"; print_r($getCompany);die;
if(isset($_POST["editcompany"])){
  //echo "<pre>"; print_r($_POST); die;
  $companyname = $_POST['comapnyname'];
  $contactperson = $_POST['contactperson'];
  $emailaddress = $_POST['emailaddress'];
  $companycontactno = $_POST['companycontactno'];
  $address = $_POST['address'];
  $zipcode = $_POST['zipcode'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $companystatus = $_POST['companyStatus'];
  $companyid = $companyIds;
  $updatecompany = updateCompany($mysqli,$companystatus,$companyid,$companyname,$contactperson,$emailaddress,$companycontactno,$address,$zipcode,$city,$state);
  $message = "";
  $error =  "";
    if ($updatecompany) {
        $message = "Company updated successfully";
    } else {
        // Insertion failed
        $error = "Failed to update company.";
    }
}

$getCompany = getCompany($mysqli,$companyIds);
 
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
              <h5 class="text-break">Edit Company Details</h5>
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
                    <h5 class="mt-2 mb-5"></h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="comapnyname" type="text" placeholder="Company Name *" value="<?php echo $getCompany[0]['companyname']?>" required >
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" name="contactperson" type="text" placeholder="Contact Person *" value="<?php echo $getCompany[0]['contactperson']?>" required>
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="emailaddress" type="email" placeholder="E-mail ID *" value="<?php echo $getCompany[0]['emailaddress']?>" required>
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="companycontactno" type="tel" minlength="12" value="<?php echo $getCompany[0]['companycontactno']?>" maxlength="12" placeholder="Contact Number *">
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="address" type="text" value="<?php echo $getCompany[0]['address']?>"  placeholder="Address *">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="zipcode" type="text" value="<?php echo $getCompany[0]['zipcode']?>" placeholder="Zip Code">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="city" type="text" value="<?php echo $getCompany[0]['city']?>" placeholder="City">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="state" type="text" value="<?php echo $getCompany[0]['state']?>" placeholder="State">
                      </div>

                    </div>

                   <!--  <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="phoneno" type="text" placeholder="PHONE NUMBER:">
                      </div>

                    </div> -->

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="mailingaddress" type="text" value="<?php echo $getCompany[0]['mailingaddress']?>" placeholder="Mailiing Address">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="accountPayable" value="<?php echo $getCompany[0]['accountPayable']?>" type="text" placeholder="Account Payable">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="accountPayableEmail" value="<?php echo $getCompany[0]['accountPayableEmail']?>" type="text" placeholder="Account Payable Email">
                      </div>

                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="accountPayableNumber" value="<?php echo $getCompany[0]['accountPayableNumber']?>" type="tel" placeholder="Account Payable Number">
                      </div>

                    </div>

                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select name="companyStatus"  class="form-control">
                              <?php if($getCompany[0]['companystatus']){
                                $showStatus = $getCompany[0]['companystatus'];
                                switch ($showStatus) {
                                  case 1:
                                    $showStatus = "Working";
                                    break;
                                  case 2:
                                  $showStatus = "Approved";
                                  break;
                                  case 3:
                                  $showStatus = "Pending";
                                  break;
                                  case 4:
                                  $showStatus = "Rejected";
                                  break;
                                  case 5:
                                  $showStatus = "High Risk";
                                  break;
                                  default:
                                    $showStatus = "Please Selected";
                                }
                                ?>
                                <option value="<?php echo $getCompany[0]['companystatus']?>" ><?php echo $showStatus;?></option>
                                <?php
                              } ?>
                              
                              <option >Company Status</option>
                              <option value="1">Working</option>
                              <option value="2">Approved</option>
                              <option value="3">Pending</option>
                              <option value="4">Rejected</option>
                              <option value="5">High Risk</option>
                          <?php //endif; ?>
                        </select>

                      </div>
                    </div> 

                   <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select name="paymentterm"  class="form-control">
                          <?php if($getCompany[0]['paymentterm']){
                            ?>
                            <option value="<?php echo $getCompany[0]['paymentterm']?>"><?php echo $getCompany[0]['paymentterm']?></option>
                            <?php
                          }?>
                          <option >Payment Terms ( 1 - 50 days)</option>
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
                        <input class="form-control" required name="creditlimit" type="tel" value="<?php echo $getCompany[0]['creditlimit']?>" minlength="2" maxlength="4" placeholder="Credit Limit">
                      </div>
                    </div>


                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 form-item mt-4">
                        <button name="editcompany" class="btn ">Submit Details</button>
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

