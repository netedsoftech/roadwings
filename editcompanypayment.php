<!-- company cost
trucker cost
profile
company payment status(option will be due or recieved)
trucker payment status(option will be due or paid)
company paid amount
shipper paid amount
company payment date
shipper payment date -->
<?php 
session_start();
include("header.php");
require_once "config.php";
require_once "function.php";
if(!($_SESSION)){
    header("location: login_page.php");
}

$id = $_GET['id'];

$getcompanypaymentdata = geteditcompanypaymentdata($mysqli,$id);

//echo "<pre>"; print_r($getcompanypaymentdata);die;
if(isset($_POST["editcompanypayment"])){
  //echo "<pre>"; print_r($_POST); die;
  $companycost = $_POST['companycost'];
  $companypaymentstatus = $_POST['companypaymentstatus'];
  $companypaidamount = $_POST['companypaidamount'];
  $companypaymentdate = $_POST['companypaymentdate'];
  $companymodeofpayment = $_POST['companymodeofpayment'];
  
  
  $editcpayment = editcpayment($mysqli,$companypaymentstatus,$companypaidamount,$companypaymentdate,$id,$companymodeofpayment);
  $message = "";
  $error =  "";
    if ($editcpayment == "Payment Update") {
        $message = "Payment updated successfully";
    } else {
        // Insertion failed
        $error = "Failed to update payment";
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
        <?php include("topHeader.php");?>
        <div class="d-flex justify-content-between p-3 main-header ">
          <h5 class="text-break">Accounts</h5>
          <?php if(!empty($message)){ ?>
            <script>
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "<?php echo $message?>",
                showConfirmButton: false,
                timer: 1500
              });
            </script>
          <?php echo $message; }?>
          <?php if(!empty($error)){ ?>
            <script>
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: "<?php echo $error?>",
                showConfirmButton: false,
                timer: 1500
              });
            </script>
          <?php echo $error; }?>
          <span class="rounded-pill shadow text-white">Assembly</span>
        </div>

        <div class="row mt-4 ">
          <div class="col-lg-9">
            <div class="main-header p-3 ">
              <form method="post">
                <h5 class="mt-2 mb-5"></h5>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="companycost">Company Cost *</label>
                      <input class="form-control" name="companycost" type="text" placeholder="Company Cost *" value="<?php echo $getcompanypaymentdata[0]['companycost']?>" required>
                    </div>

                    <div class="form-group mb-4">
                      <label for="companypaymentstatus">Company Payment Status *</label>
                     <select name="companypaymentstatus" class="form-control">
                        
                        <option value="<?php echo $getcompanypaymentdata[0]['companypaymentstatus'];?>"><?php echo $getcompanypaymentdata[0]['companypaymentstatus'];?> </option>
                        <option value="Due">Due </option>
                        <option value="Recieved">Recieved </option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="companypaidamount">Company Paid Amount *</label>
                      <input class="form-control" required name="companypaidamount" type="text" value="<?php echo $getcompanypaymentdata[0]['companypaidamount'];?>"  placeholder="Company Paid Amount *">
                    </div>

                    <div class="form-group mb-4">
                      <label for="companypaymentdate">Company Payment Date *</label>
                      <input class="form-control" required name="companypaymentdate" type="date" value="<?php echo $getcompanypaymentdata[0]['companypaymentdate'];?>" placeholder="Company Payment Date">
                    </div>

                   
                    <div class="form-group mb-4">
                     <label for="companymodeofpayment">Mode Of Payment *</label>
                       <select name="companymodeofpayment" class="form-control">
                          <option value="<?php echo $getcompanypaymentdata[0]['companypaymentdate'];?>"><?php echo $getcompanypaymentdata[0]['companypaymentdate'];?> </option>
                          <option value="Account">Account </option>
                          <option value="ACH">ACH </option>
                         
                        </select>
                    
                  </div>
                  </div>

                  <span class="aside-hr mt-3 mb-4"></span>

                 <!--  <div class="col-md-4">
                    <div class="form-group mb-4">
                      <label for="companypaidamount">Company Paid Amount *</label>
                      <input class="form-control" required name="companypaidamount" type="text" value=""  placeholder="Company Paid Amount *">
                    </div>
                  </div> -->

                  

                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4 text-end">
                    <div class="form-group mb-4 form-item mt-4">
                      <button name="editcompanypayment" class="btn ">Submit Details</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
           
          <?php include("rightbar.php");?>
          
        </div>
        <div class="row mt-4 ">
           

        <?php //include("rightbar.php");?>
        
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

