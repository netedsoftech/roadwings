
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
if(isset($_POST["addcarrierpayment"])){
  //echo "<pre>"; print_r($_POST); die;
  $sessionid = $_SESSION['id'];
  $truckercost = $_POST['truckercost'];
  $truckerpaymentstatus = $_POST['truckerpaymentstatus'];
  $shipperpaidamount = $_POST['shipperpaidamount'];
  $shippperpaymentdate = $_POST['shippperpaymentdate'];
  $modeofpayment = $_POST['modeofpayment'];
  $carriernextpaymentdate = $_POST['carriernextpaymentdate'];
  
  $addPayment = addcarrierPayment($mysqli,$truckercost,$truckerpaymentstatus,$shipperpaidamount,$shippperpaymentdate,$id,$cid,$tid,$sessionid,$modeofpayment,$carriernextpaymentdate);
  $message = "";
  $error =  "";
    if ($addPayment == "Payment submit") {
        $message = "Payment submit";
    } else {
        // Insertion failed
        $error = "Payment faild";
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
          <span class="rounded-pill shadow text-white">Assembly</span>
        </div>

        <div class="row mt-4 ">
          <div class="col-lg-9">
            <div class="main-header p-3 ">
              <form method="post" class="abc">
                <h5 class="mt-2 mb-5"></h5>
                <div class="row">
                 

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                     <label for="truckercost">Carrier Cost *</label>
                      <input class="form-control" name="truckercost" type="text" placeholder="Carrier Cost *" value="<?php echo $ctData[0]['carrierrate']?>" required>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4">
                       <label for="truckerpaymentstatus">Carrier Payment Status *</label>
                       <select id="truckerpaymentstatus" name="truckerpaymentstatus" class="form-control" onchange="toggleFields()">
                        
                          <option value="">Please Select Status </option>
                          <option value="Due">Due </option>
                          <option value="Paid">Paid </option>
                          <option value="Cancelled">Cancelled </option>
                          <option value="Tono">Tono </option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4" id="shipperpaidamount">
                     <label for="shipperpaidamount" >Carrier Paid Amount </label>
                      <input class="form-control"  name="shipperpaidamount" type="text" value="" placeholder="Carrier Paid Amount">
                    </div>
                  </div>

                   <div class="col-md-4">
                    <div class="form-group mb-4" id="modeofpayment">
                     <label for="modeofpayment">Mode Of Payment *</label>
                       <select name="modeofpayment" class="form-control">
                          <option value="">Please Select Payment Mode </option>
                          <option value="Account">Account </option>
                          <option value="ACH">ACH </option>
                         
                        </select>
                    </div>
                  </div>

                   <div class="col-md-4">
                    <div class="form-group mb-4" id="shippperpaymentdate">
                       <label for="shippperpaymentdate" >Carrier Payment Date *</label>
                      <input class="form-control"  name="shippperpaymentdate" type="text" onfocus="(this.type='date')" value="" placeholder="Due / Paid  Date">
                    </div>
                  </div> 

                  <div class="col-md-4">
                    <div class="form-group mb-4" id="carriernextpaymentdate">
                       <label for="carriernextpaymentdate">Next Payment Date </label>
                      <input class="form-control"  name="carriernextpaymentdate" type="text" onfocus="(this.type='date')" value="" placeholder="Next Payment  Date">
                    </div>
                  </div> 

                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4 text-end">
                    <div class="form-group mb-4 form-item mt-4">
                      <button name="addcarrierpayment" class="btn ">Submit Details</button>
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
                      $carrierData = carrierData($mysqli,$id,$cid,$tid);
                      //echo "<pre>"; print_r($carrierData);die;
                      foreach($carrierData as $row){ 
                      ?>
                  <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center companyname">
                            <a title="Load Data" href="#" class="mb-0 text-xs" ><?php echo ucfirst($row['shipperpaidamount']); ?></a>
                            
                          </div>

                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center companyname">
                             <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['shippperpaymentdate']); ?></p>
                            
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
                            <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['truckerpaymentstatus']); ?></p>
                            
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
                        <a href="editcarrierpayment.php?id=<?php echo $row['id']?>" title="Edit" atrid="<?php echo $row['id']; ?>" id="editlink" class="text-secondary font-weight-bold text-xs editlink" >
                        <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                        </a> 
                       
                        <?php 
                          if($_SESSION['agentrole'] == "Admin"):
                        ?>
                         <a href="deletecarrierpayment.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs" ><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/></a>
                       
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

<script>
    $(document).ready(function() {
    // Function to toggle fields based on Carrier Payment Status
    function toggleFields() {
        var status = $('#truckerpaymentstatus').val();
        if (status === 'Cancelled') {
            // Hide the fields if status is Cancelled
            $('#shipperpaidamount, #modeofpayment, #shippperpaymentdate, #carriernextpaymentdate').closest('.form-group').hide();
        } else {
            // Show the fields for other statuses
            $('#shipperpaidamount, #modeofpayment, #shippperpaymentdate, #carriernextpaymentdate').closest('.form-group').show();
        }
    }

    // Call the function initially on page load
    toggleFields();

    // Bind change event to Carrier Payment Status select element
    $('#truckerpaymentstatus').change(function() {
        // Call toggleFields function whenever the select value changes
        toggleFields();
    });
});
</script>

