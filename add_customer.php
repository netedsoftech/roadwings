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
    $companyemailid = $_POST["companyemailid"];
    $companymanagername = $_POST["companymanagername"];
    $companyaddress = $_POST["companyaddress"];
    $companypostalcode = $_POST["companypostalcode"];
    $companycity = $_POST['companycity'];
    $companystate = $_POST['companystate'];
    $companystatus = $_POST['companyStatus'];
    $paymentterm = $_POST['paymentterm'];
    $companypaymentlimit = $_POST['companypaymentlimit'];
    $companycontactno = $_POST['companycontactno'];
    $createdat = date('Y-m-d, H:i:s');

    // Call the insertData function
    // Assuming $mysqli is your database connection object
    $insertResult = addCompany($mysqli, $sessionid, $comapnyname, $companyemailid,$companymanagername,$companyaddress,$companypostalcode,$companycity,$companystate,$companystatus,$paymentterm,$companypaymentlimit,$createdat,$companycontactno);

    // Check the result of the insertion
    $message = "";
    if ($insertResult) {
        $message = "Agent inserted successfully.";
    } else {
        // Insertion failed
        $message = "Failed to insert agent.";
    }
}
?>
  <body>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
             <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Recent Shipments</h5>
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
                        <input class="form-control" name="comapnyname" type="text" placeholder="Company Name *" >
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companymanagername" type="text" placeholder="Manager Name *">
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companyemailid" type="email" placeholder="E-mail ID *">
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companycontactno" type="tel" minlength="10" maxlength="10" placeholder="Contact Number *">
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companyaddress" type="text"  placeholder="Company Full Address *">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companypostalcode" type="text" placeholder="Postal Code">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companycity" type="text" placeholder="City">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companystate" type="text" placeholder="State">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select name="companyStatus"  class="form-control">
                         <?php if($_SESSION['agentrole'] == "Agent" || $_SESSION['agentrole'] == "Team leader"): ?>
                              <option value="3">Pending</option>
                          <?php else: ?>
                              <option ></option>
                              <option selected>Company Status</option>
                              <option value="1">Working</option>
                              <option value="2">Approved</option>
                              <option value="3">Pending</option>
                              <option value="4">Rejected</option>
                              <option value="5">High Risk</option>
                          <?php endif; ?>
                        </select>

                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select name="paymentterm"  class="form-control">
                          <option selected>Payment Terms ( 1 - 45 days)</option>
                          <option value="1">1</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="companypaymentlimit" type="tel" minlength="2" maxlength="4" placeholder="Limit Assign">
                      </div>
                    </div>


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
              <div class="col-lg-3">
                  <div class="main-header ">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Companies Status</h6>
                  </div>
                  <div class="card-body p-3">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/color/35/hourglass-sand-top.png" alt="hourglass-sand-top">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Pending</h6>
                            <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/fluency/35/hard-working.png" alt="hard-working">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Working</h6>
                            <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/doodle/35/ok.png" alt="ok">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Approved</h6>
                            <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/external-bearicons-flat-bearicons/35/external-rejected-approved-and-rejected-bearicons-flat-bearicons-3.png" alt="external-rejected-approved-and-rejected-bearicons-flat-bearicons-3">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Rejected</h6>
                            <span class="text-xs font-weight-bold">+ 430</span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php //include("livefeed.php");?>
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

