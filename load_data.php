<?php
session_start();
include('config.php');
include("header.php");
include('function.php');
//session_destroy();
//echo "<pre>"; print_r($_SESSION);die;
  if(!($_SESSION)){
    header("location: login_page.php");
  }

$urlid = $_GET['id'];

$getCompaniesForLoad = getCompaniesForLoad($mysqli,$urlid);
$calculate = calculateleftlimit($mysqli,$urlid);
$calculatepaidamount = calculatepaidamount($mysqli,$urlid);
$calculatetotalbusiness = calculatetotalbusiness($mysqli,$urlid);
$usedlitmit = calculateusedlimit($mysqli,$urlid);
//echo "<pre>"; print_r($calculate);die;
if(isset($_POST['submit'])){
  //echo "<pre>"; print_r($_POST);die;
  function generateUniqueRBLNumbers($count) {
    $uniqueNumbers = [];
    while (count($uniqueNumbers) < $count) {
        $randNumber = mt_rand(100, 999); // Generate a random 3-digit number
        $uniqueNumbers[] = "RWL" . $randNumber;
        $uniqueNumbers = array_unique($uniqueNumbers); // Remove duplicates
    }
    return $uniqueNumbers;
}

$uniqueNumbers = generateUniqueRBLNumbers(5); // Change the count as per your requirement
foreach ($uniqueNumbers as $number) {
    $uid = $number;
}
  $from = $_POST['from'];
  $to = $_POST['to'];
  $sDate = $_POST['sDate'];
  $deliveryDate = $_POST['deliveryDate'];
  $trucker_type = $_POST['trucker_type'];
  $loadtype = $_POST['loadtype'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];
  $commodity = $_POST['commodity'];
  //$dat_rate = $_POST['dat_rate'];

  $carrier_rate = $_POST['carrierrate'];
  $truckerNo = $_POST['truckerNo'];
  $truckerEmail = $_POST['truckerEmail'];
  $truckerAddress = $_POST['truckerAddress'];
  $companyid = $_GET['id'];
  $notes = $_POST['notes1'];
  //$notes1 = $_POST['notes1'];
  $customerrate = $_POST['customerrate'];
  $trucksubcategorytype = $_POST['trucksubcategorytype'];
  $truckerid = $_POST['truckerid'];
  
  $addLoadAndCarrier =  addLoadAndCarrier($mysqli,$from,$to,$sDate,$deliveryDate,$trucker_type,$loadtype,$length,$weight,$commodity,$carrier_rate,$truckerNo,$truckerEmail,$truckerAddress,$notes,$companyid,$trucksubcategorytype,$customerrate,$truckerid,$uid);
  $error = '';
  $msg = '';
  if($addLoadAndCarrier == "Loadadded"){
    $msg = "Load Added";
  }else{
    $error = 'Failed to add load';
  }
}
$getCarrier = getAllCarrier($mysqli);
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Data</title>

    <link rel="stylesheet" type="text/css" media="all" href="css_demo/daterangepicker.css" />
      <script type="text/javascript" src="js_demo/daterangepicker.js"></script>

<?php include("header.php");?>
<section class="main">
      <div class="container-fluid">
        <div class="row">
             <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
          <?php include("topHeader.php");?>
          <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Load Data</h5>
               <?php if(!empty($msg)){
                ?>
                <script>
                 Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "<?php echo $msg?>",
                  showConfirmButton: false,
                  timer: 1500
                });
                </script>
              <?php
                echo $msg;
              }?>
               <?php if(!empty($error)){
                ?>
                <script>
                 Swal.fire({
                  position: "top-end",
                  icon: "error",
                  title: "<?php echo $error?>",
                  showConfirmButton: false,
                  timer: 1500
                });
                </script>
              <?php
                echo $error;
              }?>
</div>

<div class="row mt-4 ">
              <div class="col-lg-8">
                 <!-- Company form start -->
                <div class="main-header p-3" id="companyFormContainer">
                  <form id="companyForm" method="post" onsubmit="return submitCompanyForm()">
                    <h5 class="mt-2 mb-5">Add Load </h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input class="form-control" id="fromInput" name="from" type="text" placeholder="From *" required>
                      </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group mb-4 ">
                        <input class="form-control" id="toInput" name="to" type="text" placeholder="To *" required>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input id="startDate" class="form-control icons_search_input click"  name="sDate" type="text" onfocus="(this.type='date')" placeholder="Booking Date *" required autocomplete="off">
                      </div>
                    </div>

                   
                    <div class="col-md-3">
                    
                    <div class="form-group mb-4 ">
                        <input id="endDate" class="form-control icons_search_input click" name="deliveryDate"type="text" onfocus="(this.type='date')" placeholder="Delivery Date *" required autocomplete="off">
                      </div>
                    </div>

                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select class="form-control" name="trucker_type"  id="trucker_type"> 
                            <option >Truck Type</option>
                            <option value="Dry Van 53">Dry Van 53'</option>
                            <option value="Flatbed 48">Flatbed 48'</option>
                            <option value="Flatbed 53">Flatbed 53'</option>
                            <option value="Stepdeck 53">Stepdeck 53'</option>
                            <option value="Straight Box Truck 26">Straight Box Truck 26'</option>
                            <option value="Conestoga, Reefer 53">Conestoga, Reefer 53'</option>
                            <option value="Flatbed Hotshot">Flatbed Hotshot</option>
                            <option value="Lowboy, Power Only">Lowboy, Power Only</option>
                            <option value="Van Hazmat">Van Hazmat</option>
                            <option value="Reefer Hazmat"> Reefer Hazmat</option>
                            <option value="RGN">RGN</option>
                            <option value="Container">Container</option>
                        </select>
                      </div>

                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select class="form-control"  id="load_type"> 
                            <option >Load Type</option>
                            <option value="Partial">Partial</option>
                            <option value="Full">Full</option>
                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" id="lengthInput" required name="length" type="text" placeholder="Length">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" id="weightInput" required name="weight" type="text" placeholder="Weight">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required id="commodity" name="commodity" type="text" placeholder="Commodity (goods)">
                      </div>

                    </div>

                  

                    <div class="col-md-4 d-none">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="datrate" type="text" placeholder="dat rate" hidden>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required id="customerrateInput" name="customerrate" type="text" placeholder="Customer Rate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required id="carrierrrateInput" name="carrierrate" type="tel" placeholder="Carrier Rate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <textarea class="form-control" name="notes" id="notes" placeholder="Notes " cols="30" rows="1"></textarea>
                      </div>

                    </div>

                    <!-- <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div> -->
                    <div class="col-lg-4 text-end">
                    <div class="form-group mb-4 form-item mt-4" id="submitCompanyFormBtnContainer">
                        <button name="addcompany" class="btn">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>

                 <!-- Company form end -->
                 <!-- Trucker form start -->
                 <div class="main-header p-3" id="truckerFormContainer" style="display: none;">
                  <form method="post">
                    <h5 class="mt-2 mb-5">Add Carrier </h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="from" id="fromInputSecond" type="text" placeholder="From *" required readonly value="">
                      </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group mb-4 ">
                        <input class="form-control" name="to" id="toInputSecond" type="text" placeholder="To *" required readonly value="">
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input id="sDateInputSecond" class="form-control icons_search_input click"  name="sDate" type="text" placeholder="Start Date *" required readonly value="">
                      </div>
                    </div>

                   
                    <div class="col-md-3">
                    
                    <div class="form-group mb-4 ">
                        <input id="deliveryDateInputSecond" class="form-control icons_search_input click" name="deliveryDate" type="text" placeholder="Delivery Date *" required readonly value="">
                      </div>
                    </div>

                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                       <input type="text" id="trucker_typeSecond" class="form-control icons_search_input click" name="trucker_type" placeholder="Delivery trucker_type *" required readonly value="">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                       
                        <input type="text" id="load_typeSecond" class="form-control icons_search_input click" name="loadtype" placeholder="Load Type *" required readonly value="">

                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input id="lengthInputSecond" class="form-control" required name="length" type="text" placeholder="Length" readonly value="">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input id="weightInputSecond" class="form-control" required name="weight" type="text" placeholder="Weight" readonly value="">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input  class="form-control" required id="commodityInputSecond" name="commodity" type="text" placeholder="Commodity (goods)" readonly value="">
                      </div>

                    </div>

                  

                    <div class="col-md-4 d-none">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="dat rate" type="text" placeholder="dat rate" hidden>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input id="customerInputSecond" class="form-control" required name="customerrate" type="text" placeholder="Customer Rate" readonly value="">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input  id="carrierInputSecond" class="form-control" required name="carrierrate" type="tel" placeholder="Carrier Rate" readonly value="">
                      </div>

                    </div>

                  

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <select class="form-control" name="trucksubcategorytype"  id="trucksubcategorytype"> 
                            <option >Trucker Name</option>
                            <?php
                            foreach($getCarrier as $carrier){
                              ?>
                              <option value="<?php echo $carrier['id']?>"><?php echo $carrier['tname']?></option>
                              <?php
                            }
                            ?>
                            <!-- <option value="Dry Van 53">Dry Van 53'</option>
                            <option value="Flatbed 48">Flatbed 48'</option>
                            <option value="Flatbed 53">Flatbed 53'</option>
                            <option value="Stepdeck 53">Stepdeck 53'</option>
                            <option value="Straight Box Truck 26">Straight Box Truck 26'</option>
                            <option value="Conestoga, Reefer 53">Conestoga, Reefer 53'</option>
                            <option value="Flatbed Hotshot">Flatbed Hotshot</option>
                            <option value="Lowboy, Power Only">Lowboy, Power Only</option>
                            <option value="Van Hazmat">Van Hazmat</option>
                            <option value="Reefer Hazmat"> Reefer Hazmat</option>
                            <option value="RGN">RGN</option>
                            <option value="Container">Container</option> -->
                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <input  id="truckerNo" class="form-control" required name="truckerNo" type="tel" placeholder="Contact Number"  value="">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <input  id="truckerEmail" class="form-control" required name="truckerEmail" type="tel" placeholder="Email Address"  value="">
                      </div>

                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <input  id="mcnumber" class="form-control" required name="mcnumber" type="tel" placeholder="MC Number"  value="">
                      <input  id="truckerid" class="form-control" required name="truckerid" type="hidden" >
                      </div>

                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                      <textarea class="form-control" required name="truckerAddress" type="tel" placeholder="Trucker Address"  value="" id="truckerAddress" cols="30" rows="1"></textarea>
                      </div>

                    </div>



                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <textarea class="form-control" name="notes1" id="notes1" placeholder="Notes " cols="30" rows="1"></textarea>
                      </div>

                    </div>
                    <!-- <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div> -->
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 form-item mt-4">
                        <button name="submit" type="submit" class="btn ">Submit Details</button>
                        <button id="showCompanyFormBtn" class="btn">Edit First form?</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>
                 <!-- Trucker form end -->

              </div>
              
              
<div class="col-lg-4">
                  <div class="main-header ">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Logistic Company</h6>
                  </div>
                  <div class="card-body p-3">
                    <div class="text-center">
                    <img width="100" height="100" src="https://img.icons8.com/color/100/circled-user-male-skin-type-7--v1.png" alt="circled-user-male-skin-type-7--v1"/>
                      <p><?php echo ucfirst($getCompaniesForLoad[0]['companyname'])?></p>
                    </div>
                    <div class="d-flex justify-content-between ">
                      <div>

                       <small class="text-black"> Credit Limit: <span class="text-success fs-5"> $<?php echo $getCompaniesForLoad[0]['creditlimit'];?> </span></small><br><br>
                       <small class="text-black"> Left  Limit: <span class="text-success fs-5"> $<?php echo $calculate[0]['remaining_credit_limit'];?> </span></small><br><br>
                       <small class="mt-3"> Total business: <span class="text-success fs-5"> $<?php echo $calculatetotalbusiness[0]['total_business'];?> </span></small>
                      </div>
                      <div>
                        <small class="text-black">Used  Limit: <span class="text-danger fs-5"> $<?php echo $usedlitmit[0]['used_limit'];?></span></small><br><br>
                       <small class="text-black"> Paid Amount: <span class="text-success fs-5">  $<?php echo $calculatepaidamount[0]['total_paid_amount'];?> </span></small><br><br>
                       <small class="mt-3"> Agent Name: <span class="text-black"> <?php echo ucfirst($getCompaniesForLoad[0]['agentname'])?> </span></small>
                      </div>
                    </div>
                    <div class="mt-3">
                  
                    </div>
                  </div>
                </div>
              </div>    


                              <!-- Table start -->
                              <div class="container">
                              <div class="table-responsive p-0 mt-3 main-header main-three p-3">
                                <table class="table align-items-center mb-0">
                                  <thead>
                                    <tr>
                                      <th class="text-start text-uppercase text-th sorting_disabled"> Invoice No</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled"> From</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled">To</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled"> Start Date</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled">End Date</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled">Company Payment Terms</th>
                                         <th class="text-start text-uppercase text-th sorting_disabled">Carrier Payment Terms</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled">Added Date</th>
                                        <th class="text-start text-uppercase text-th sorting_disabled">Added By</th>
                                        
                                    
                  
                                       <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                                       
                                      <!-- <th class="text-secondary "></th> -->
                                      <?php endif; ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     <?php
                                        $loadData = getLoad($mysqli,$urlid);
                                        foreach($loadData as $row){ 
                                        ?>
                                    <tr>
                                      <td>
                                          <div class="d-flex px-2 py-1">
                                            
                                            <div class="d-flex flex-column justify-content-center companyname">
                                              <a title="Load Data" href="load_data.php" class="mb-0 text-xs" ><?php echo ucfirst($row['carrierinvoiceno']); ?></a>
                                              
                                            </div>
                  <!-- 
                                            <div class="d-flex flex-column justify-content-center">
                                              <p class="text-xs font-weight-bold mb-0"><?php// echo ucfirst($row['companyname']); ?></p>
                                              
                                            </div> -->
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex px-2 py-1">
                                            
                                            <div class="d-flex flex-column justify-content-center companyname">
                                              <a title="Load Data" href="load_data.php" class="mb-0 text-xs" ><?php echo ucfirst($row['locationfrom']); ?></a>
                                              
                                            </div>
                  <!-- 
                                            <div class="d-flex flex-column justify-content-center">
                                              <p class="text-xs font-weight-bold mb-0"><?php// echo ucfirst($row['companyname']); ?></p>
                                              
                                            </div> -->
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex px-2 py-1">
                                            
                                            <div class="d-flex flex-column justify-content-center">
                                              <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['locationto']); ?></p>
                                              
                                            </div>
                                          </div>
                                        </td>
                                        
                                        <td class="align-middle text-start text-sm">
                                          <p class="text-xs font-weight-bold mb-0"><?php echo $row['startdate']; ?></p>
                                        </td>
                                        <td class="align-middle text-start">
                                          <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['deliverydate']); ?></span>
                                        </td>
                  
                                        <td class="align-middle text-start">
                                          <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['paymentterm']); ?></span>
                                        </td>
                  
                                        <td class="align-middle text-start text-sm">
                                          <p class="text-xs font-weight-bold mb-0"><?php echo $row['carrierpaymentterm'] . " " . "Days"; ?></p>
                                        </td>
                  
                                        <td class="align-middle text-start">
                                          <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['addeddate']); ?></span>
                                        </td>
                  
                                        <td class="align-middle text-start">
                                          <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['agentname']); ?></span>
                                        </td>
                  
                  
                                       
                                     
                                        
                                        
                                        
                                    
                                        <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                                        
                                        
                  
                                         <td class="align-middle">  
                                          <a href="javascript:;" title="Edit" atrid="<?php echo $row['id']; ?>" id="editlink" class="text-secondary font-weight-bold text-xs editlink"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                          <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                                          </a>
                                          <?php 
                                            if($_SESSION['agentrole'] == "Admin"):
                                          ?>
                                           <a href="deletecompany.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs" ><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/></a>
                                         
                                           <?php endif; ?>
                                         </td>
                                         <?php endif; ?>
                                        
                                      </tr>
                                      <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <!-- Table end -->
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

</section>
  
<script>
  // Function to submit the company form
  function submitCompanyForm() {
    var allFieldsFilled = true;
    var companyForm = document.getElementById("companyForm");
    var inputs = companyForm.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].hasAttribute("required") && inputs[i].value.trim() === "") {
        allFieldsFilled = false;
        break;
      }
    }

    if (allFieldsFilled) {
      document.getElementById("companyFormContainer").style.display = "none";
      document.getElementById("truckerFormContainer").style.display = "block";
      var fromValue = document.getElementById("fromInput").value;
        var toValue = document.getElementById("toInput").value;
        var startValue = document.getElementById("startDate").value;
        var endValue = document.getElementById("endDate").value;
        var truckValue = document.getElementById("trucker_type").value;
        var loadValue = document.getElementById("load_type").value;
        var lengthValue = document.getElementById("lengthInput").value;
        var weigthValue = document.getElementById("weightInput").value;
        var commodity = document.getElementById("commodity").value;
        var customerValue = document.getElementById("customerrateInput").value;
        var carrierValue = document.getElementById("carrierrrateInput").value;
        // Retrieve corresponding fields in the second form
        var fromInputSecond = document.getElementById("fromInputSecond");
        var toInputSecond = document.getElementById("toInputSecond");
        var sDateInputSecond = document.getElementById("sDateInputSecond");
        var deliveryDateInputSecond = document.getElementById("deliveryDateInputSecond");
        var load_typeInputSecond = document.getElementById("load_typeSecond");
        var truckerInputSecond = document.getElementById("trucker_typeSecond");
        var lengthInputSecond = document.getElementById("lengthInputSecond");
        var weightInputSecond = document.getElementById("weightInputSecond");
        var customerInputSecond = document.getElementById("customerInputSecond");
        var carrierInputSecond = document.getElementById("carrierInputSecond");
        var notes = document.getElementById("notes").value;
        // Set values in the second form
        fromInputSecond.value = fromValue; 
        toInputSecond.value = toValue;
        sDateInputSecond.value = startValue;
        deliveryDateInputSecond.value = endValue;
        truckerInputSecond.value = truckValue;
        lengthInputSecond.value = lengthValue;
        load_typeInputSecond.value = loadValue;
        weightInputSecond.value = weigthValue;
        commodityInputSecond.value = commodity;
        customerInputSecond.value = customerValue;
        carrierInputSecond.value = carrierValue;
        notes1.value =  notes; 
    }

    return false;


        // Display the second form
  }

   // Function to submit the trucker form
   
    
    

  document.getElementById("showCompanyFormBtn").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("companyFormContainer").style.display = "block";
    document.getElementById("truckerFormContainer").style.display = "none";
  });

  $(document).ready(function(){
    $("#trucksubcategorytype").change(function(){
      var carrierid = $(this).val();
      $.ajax({
        url : "gettrucker.php",
        type : "post",
        data:{carrierid:carrierid},
        success:function(data){
          var jsonData = JSON.parse(data);
          $("#truckerNo").val(jsonData.tphoneno);
          $("#truckerEmail").val(jsonData.temail);
          $("#mcnumber").val(jsonData.tmcno);
          $("#truckerAddress").val(jsonData.taddress);
          $("#truckerid").val(jsonData.id);
        }
      })

    })
  })
</script>






<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <style>
  .dataTables_wrapper .dataTables_paginate .paginate_button.current{
color: #fff!important;
background: #124483!important;
border-radius: 50%!important;
box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px!important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
color: #124483!important;
background: #fff!important;
}

.dataTables_length label{
  color: #124483!important;
}

.dataTables_filter  label{
  color: #124483!important;
}
</style>
</body>
</html>

