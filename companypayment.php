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

$id = $_GET['loadid'];
$cid= $_GET['cid'];
$tid= $_GET['tid'];


//echo "<pre>"; print_r($getCompany);die;
if(isset($_POST["addcompanypayment"])){
  //echo "<pre>"; print_r($_POST); die;
  $companycost = $_POST['companycost'];
  $companypaymentstatus = $_POST['companypaymentstatus'];
  $companypaidamount = $_POST['companypaidamount'];
  $companypaymentdate = $_POST['companypaymentdate'];
  $companymodeofpayment = $_POST['companymodeofpayment'];
  $nextpaymentdate = $_POST['nextpaymentdate'];
  
  
  $addPayment = addcompanyPayment($mysqli,$companycost,$companypaymentstatus,$companypaidamount,$companypaymentdate,$id,$cid,$tid,$companymodeofpayment,$nextpaymentdate);
  $message = "";
  $error =  "";
    if ($addPayment == "Payment submit") {
        $message = "Payment add successfully";
    } else {
        // Insertion failed
        $error = "Failed to add payment";
    }
}

$ctData = ctData($mysqli,$id,$cid,$tid);
//echo "<pre>"; print_r($ctData); die;
 
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
          <span>
            <?php
            
            $lcd = $ctData[0]['loaddatacompanypaymentdate'];
            $paymentTimestamp = strtotime($lcd);
            $currentTimestamp = time();
                // Check if payment date has passed
                if ($paymentTimestamp < $currentTimestamp) {
                  // Payment date has passed, show in red color
                  echo "<span style='color: red;'>Payment date has passed: $lcd</span>";
              } else {
                  // Payment date is in the future, show in green color
                  echo "<span style='color: green;'>Payment date is: $lcd</span>";
              }
            ?>
          </span>
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
                      <input class="form-control" name="companycost" type="text" placeholder="Company Cost *" value="<?php echo $ctData[0]['customerrate']?>" required>
                    </div>

                    <div class="form-group mb-4">
                      <label for="companypaymentstatus">Company Payment Status *</label>
                     <select name="companypaymentstatus" class="form-control">
                        <option value="">Please Select Status </option>
                        <option value="Due">Due </option>
                        <option value="Recieved">Recieved </option>
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

                  <div class="col-md-6"><div class="form-group mb-4">
                      <label for="nextpaymentdate">Next Payment Date</label>
                      <input class="form-control"  name="nextpaymentdate" type="date" value="" placeholder="Next Payment Date">
                    </div></div>

                    <div class="col-md-6">
                    <div class="form-group mb-4">

                     <label for="companymodeofpayment">Mode Of Payment *</label>
                       <select name="companymodeofpayment" class="form-control">
                          <option value="">Please Select Payment Mode </option>
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
                      <button name="addcompanypayment" class="btn ">Submit Details</button>
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
        <div class="col-lg-12">
          <div class="table-responsive p-0 mt-3 main-header main-three p-3">
           <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                  <th class="text-start text-uppercase text-th sorting_disabled">Paid Amount</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Payment Date</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Payment Mode</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Carrier Payment Status</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Added Date</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Added By</th>
                      
                  

                     <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                     
                     <th class="text-secondary ">Action</th> 
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                   <?php
                      $getcompanypaymentdata = getcompanypaymentdata($mysqli,$id,$cid,$tid);
                      foreach($getcompanypaymentdata as $row){ 
                      ?>
                  <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center companyname">
                            <a title="Load Data" href="#" class="mb-0 text-xs" ><?php echo ucfirst($row['companypaidamount']); ?></a>
                            
                          </div>

                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center companyname">
                             <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['companypaymentdate']); ?></p>
                            
                          </div>

                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center companyname">
                             <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['paymentmode']); ?></p>
                            
                          </div>

                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['companypaymentstatus']); ?></p>
                            
                          </div>
                        </div>
                      </td>
                      
                      <td class="align-middle text-start text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['createdat']; ?></p>
                      </td>
                      

                      <td class="align-middle text-start">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['agentname']); ?></span>
                      </td>

                     

                      <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER" || $_SESSION['agentrole'] == "ACCOUNTS"):?>
                      
                      

                       <td class="align-middle">  
                        <a href="editcompanypayment.php?id=<?php echo $row['id']?>" title="Edit" atrid="<?php echo $row['id']; ?>" id="editlink" class="text-secondary font-weight-bold text-xs editlink" >
                        <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                        </a> 
                       
                        <?php 
                          if($_SESSION['agentrole'] == "Admin"):
                        ?>
                         <a href="deletecompanypayment.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs" ><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/></a>
                       
                         <?php endif; ?>
                       </td>
                       <?php endif; ?>
                      
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
          </div>
          <script type="text/javascript">
            $(document).ready(function () {
                $('.table').DataTable({
                    "ordering": false // Disable sorting
                });
            });
          </script>
        </div>
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

