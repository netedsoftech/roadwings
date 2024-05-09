<?php 
session_start();
include("header.php");
require_once "config.php";
require_once "function.php";
if(!($_SESSION)){
    header("location: login_page.php");
}

$id = $_REQUEST['id'];
$getcarrierpaymentdata = getcarrierpaymentdata($mysqli,$id);
//echo "<pre>"; print_r($getcarrierpaymentdata); die;
if(isset($_POST['editcarrierpayment'])){
  $truckercost = $_POST['truckercost'];
  $truckerpaymentstatus = $_POST['truckerpaymentstatus'];
  $shipperpaidamount = $_POST['shipperpaidamount'];
  $shippperpaymentdate = $_POST['shippperpaymentdate'];
  $modeofpayment = $_POST['modeofpayment'];
  $editpayment = editPayment($mysqli,$truckercost,$truckerpaymentstatus,$shipperpaidamount,$shippperpaymentdate,$modeofpayment,$id);
  $error = "";
  $message = "";
  if($editpayment == "Payment updated"){
    $message = "Payment updated";
  }else{
    $error = "Payment update failed";
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
                 

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                     <label for="truckercost">Carrier Cost *</label>
                      <input class="form-control" name="truckercost" type="text" placeholder="Carrier Cost *" value="<?php echo $getcarrierpaymentdata[0]['truckercost']?>" required>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                       <label for="truckerpaymentstatus">Carrier Payment Status *</label>
                     
                         <select name="truckerpaymentstatus" class="form-control">
                          <option value="<?php echo $getcarrierpaymentdata[0]['truckerpaymentstatus']?>"><?php echo $getcarrierpaymentdata[0]['truckerpaymentstatus']?></option>
                          <!-- <option value="">Please Select Status </option> -->
                          <option value="Due">Due </option>
                          <option value="Paid">Paid </option>
                          <option value="Cancelled">Cancelled </option>
                          <option value="Tono">Tono </option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                     <label for="shipperpaidamount">Carrier Paid Amount </label>
                      <input class="form-control"  name="shipperpaidamount" type="text" value="<?php echo $getcarrierpaymentdata[0]['shipperpaidamount']?>" placeholder="Carrier Paid Amount">
                    </div>
                  </div>

                   <div class="col-md-4">
                    <div class="form-group mb-4">
                     <label for="shipperpaidamount">Mode Of Payment *</label>
                       <select name="modeofpayment" class="form-control">
                        <option value="<?php echo $getcarrierpaymentdata[0]['paymentmode']?>"><?php echo $getcarrierpaymentdata[0]['paymentmode']?></option>
                          <!-- <option value="">Please Select Payment Mode </option> -->
                          <option value="Account">Account </option>
                          <option value="ACH">ACH </option>
                         
                        </select>
                    </div>
                  </div>

                   <div class="col-md-4">
                    <div class="form-group mb-4">
                       <label for="shippperpaymentdate">Carrier Payment Date *</label>
                      <input class="form-control" required name="shippperpaymentdate" type="text" onfocus="(this.type='date')" value="<?php echo $getcarrierpaymentdata[0]['shippperpaymentdate']?>" placeholder="Due / Paid  Date">
                    </div>
                  </div> 

                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4 text-end">
                    <div class="form-group mb-4 form-item mt-4">
                      <button name="editcarrierpayment" class="btn ">Submit Details</button>
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