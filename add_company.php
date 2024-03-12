<?php include("header.php");
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
                   <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6>
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Company Name <sub>*</sub></label>
                        <input class="form-control" name="comapnyname" type="text" placeholder="Morissette PLC" >
                      </div>

                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Manager Name <sub>*</sub></label>
                        <input class="form-control" name="companymanagername" type="text" placeholder="XYZ Limited" >
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Company E-mail ID <sub>*</sub></label>
                        <input class="form-control" name="companyemailid" type="email" placeholder="hudson.wilhelmine@boehm.com" >
                      </div>

                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
                        <input class="form-control" name="companycontactno" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686" >
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Company Full Address <sub>*</sub></label>
                        <input class="form-control" name="companyaddress" type="text" placeholder="93229 Carli Points" >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Postal Code</label>
                        <input class="form-control" name="companypostalcode" type="text" placeholder="84073" >
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">City</label>
                        <input class="form-control" name="companycity" type="text" placeholder="Port Danielafort" >
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">State</label>
                        <input class="form-control" name="companystate" type="text" placeholder="Port Danielafort" >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input"  class="form-control-label mb-2">Company Status</label>
                        <select name="companyStatus"  class="form-control">
                         <?php if($_SESSION['agentrole'] == "Agent"): ?>
                              <option value="3">Pending</option>
                          <?php else: ?>
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
                      <div class="form-group mb-4">
                        <label for="example-text-input"  class="form-control-label mb-2">Payment Terms ( 1 - 45 days)</label>
                        <select name="paymentterm"  class="form-control">
                          <option value="1">1</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Limit Assign</label>
                        <input class="form-control" name="companypaymentlimit" type="tel" minlength="2" maxlength="4" placeholder="2000 USD" >
                      </div>
                    </div>


                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 mt-4">
                        <button name="addcompany" class="btn ">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>
              </div>
              <?php include("livefeed.php");?>
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

