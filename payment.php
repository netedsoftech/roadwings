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


//echo "<pre>"; print_r($getCompany);die;
if(isset($_POST["submit"])){
  echo "<pre>"; print_r($_POST); die;
  $locationfrom = $_POST['locationfrom'];
  $locationto = $_POST['locationto'];
  $startdate = $_POST['startdate'];
  $deliverydate = $_POST['deliverydate'];
  $trucktype = $_POST['trucktype'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];
  $commodity = $_POST['commodity'];
  $customerrate = $_POST['customerrate'];
  $carrierrate = $_POST['carrierrate'];
  $notes = $_POST['notes'];
  $truckerNo = $_POST['truckerNo'];
  $truckerEmail = $_POST['truckerEmail'];
  $truckerAddress = $_POST['truckerAddress'];
  $status = $_POST['status'];
  $updateLoad = updateLoad($mysqli,$locationfrom,$locationto,$startdate,$deliverydate,$trucktype,$length,$weight,$commodity,$customerrate,$carrierrate,$notes,$truckerNo,$truckerEmail,$truckerAddress,$id,$status);
  $message = "";
  $error =  "";
    if ($updateLoad == "updated") {
        $message = "Load updated successfully";
    } else {
        // Insertion failed
        $error = "Failed to update load.";
    }
}

$getEditLoad = getEditLoad($mysqli,$id);
//echo "<pre>"; print_r($getEditLoad); die;
 
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
                      <input class="form-control" name="companycost" type="text" placeholder="Company Cost *" value="" required>
                    </div>

                    <div class="form-group mb-4">
                      <label for="companypaymentstatus">Company Payment Status *</label>
                     <select name="companypaymentstatus" class="form-control">
                        <option value="">Please Select Status </option>
                        <option value="0">Due </option>
                        <option value="1">Recieved </option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="companypaidamount">Company Paid Amount *</label>
                      <input class="form-control" required name="companypaidamount" type="text" value=""  placeholder="Company Paid Amount *">
                    </div>

                    <div class="form-group mb-4">
                      <label for="companypaymentdate">Company Payment Date *</label>
                      <input class="form-control" required name="companypaymentdate" type="date" value="" placeholder="Company Payment Date">
                    </div>
                  </div>

                  <span class="aside-hr mt-3 mb-4"></span>

                 <!--  <div class="col-md-4">
                    <div class="form-group mb-4">
                      <label for="companypaidamount">Company Paid Amount *</label>
                      <input class="form-control" required name="companypaidamount" type="text" value=""  placeholder="Company Paid Amount *">
                    </div>
                  </div> -->

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                     <label for="truckercost">Carrier Cost *</label>
                      <input class="form-control" name="truckercost" type="text" placeholder="Carrier Cost *" value="" required>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                       <label for="truckerpaymentstatus">Carrier Payment Status *</label>
                     
                         <select name="truckerpaymentstatus" class="form-control">
                          <option value="">Please Select Status </option>
                          <option value="0">Due </option>
                          <option value="1">Paid </option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                     <label for="shipperpaidamount">Carrier Paid Amount *</label>
                      <input class="form-control" required name="shipperpaidamount" type="text" value="Carrier Paid Amount" placeholder="Length">
                    </div>
                  </div>

                   <div class="col-md-4">
                    <div class="form-group mb-4">
                       <label for="shippperpaymentdate">Shipper Payment Date *</label>
                      <input class="form-control" required name="shippperpaymentdate" type="date" value="" placeholder="Shipper Payment Date">
                    </div>
                  </div> 

                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4 text-end">
                    <div class="form-group mb-4 form-item mt-4">
                      <button name="submit" class="btn ">Submit Details</button>
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

