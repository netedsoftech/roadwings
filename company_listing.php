<?php
// Include the function.php file
session_start();
require_once "config.php";
require_once "function.php";
//echo "<pre>"; print_r($_SESSION);die;
if(!($_SESSION)){
    header("location: login_page.php");
  }
  include("header.php");

if(isset($_POST["update"])){
  //echo "<pre>"; print_r($_POST); die;
  $companyname = $_POST['companyname'];
  $contactperson = $_POST['contactperson'];
  $emailaddress = $_POST['emailaddress'];
  $companycontactno = $_POST['companycontactno'];
  $address = $_POST['address'];
  $zipcode = $_POST['zipcode'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $companystatus = $_POST['companystatus'];
  $companyid = $_POST['companyid'];
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

$getrole = $_SESSION['agentrole'];
?>
<title>Customer Lists</title>
  <body>
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


</style>


<script type="text/javascript">

    $(document).ready(function () {
        
        $('.table').DataTable({
            "ordering": false // Disable sorting
        });
    });
</script>




    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
          <?php include("topHeader.php");?>

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
              <?php 
                if(!empty($error)){
                  ?>
                  <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "$error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                  <?php
                  echo $error;
                }
              ?>
              <span class="rounded-pill shadow text-white"><span class="text-white" id="downloadBtn">Download CSV</span></span>
             </div>

             <div class="row mt-4 ">
              <div class="col-lg-12">
                <div class="table-responsive p-0 mt-3 main-header main-three p-3">

                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                            <th class="text-start text-uppercase text-th "> Name</th>
                            <th class="text-start text-uppercase text-th ">Added By</th>
                            <th class="text-start text-uppercase text-th "> E-mail ID</th>
                            <th class="text-start text-uppercase text-th ">Contact Name</th>
                            <th class="text-start text-uppercase text-th ">Ph. Number</th>
                          <th class="text-start text-uppercase text-th  ps-2"> Address</th>
                          <th class="text-start text-uppercase text-th ">Postal Code</th>
                          <th class="text-start text-uppercase text-th ">City</th>
                          <th class="text-start text-uppercase text-th ">state</th>
                          <th class="text-start text-uppercase text-th "> Status</th>
                          
                          <th class="text-start text-uppercase text-th ">Limit Assign</th>
                          <?php if($getrole == "Admin" || $getrole == "MANAGER"){?>
                          <th class="text-start text-uppercase text-th ">Action</th>
                      <?php } ?>
                        
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                            $companyData = getCompanies($mysqli);
                            foreach($companyData as $row){ 
                            ?>
                        <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                
                                <div class="d-flex flex-column justify-content-center companyname">
                                  <a title="Load Data" href="load_data.php?id=<?php echo $row['id']?>" class="mb-0 text-xs" ><?php echo ucfirst($row['companyname']); ?></a>
                                  
                                </div>

                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2 py-1">
                                
                                <div class="d-flex flex-column justify-content-center">
                                  <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['agentname']); ?></p>
                                  
                                </div>
                              </div>
                            </td>
                            
                            <td class="align-middle text-start text-sm">
                              <p class="text-xs font-weight-bold mb-0"><?php echo $row['emailaddress']; ?></p>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['contactperson']); ?></span>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['companycontactno']; ?></span>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['address']); ?></span>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['zipcode']; ?></span>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['city']); ?></span>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['state']); ?></span>
                            </td>
                            <td class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold title_main"><?php if($row['companystatus']==1){
                                echo '<img title="Working" width="15" height="15" src="https://img.icons8.com/emoji/15/orange-circle-emoji.png" alt="orange-circle-emoji"/>';
                              }else if($row['companystatus']==2){ echo '<img title="Approved" width="15" height="15" src="https://img.icons8.com/external-flat-icons-inmotus-design/15/external-green-political-signs-flat-icons-inmotus-design.png" alt="external-green-political-signs-flat-icons-inmotus-design"/>';}else if($row['companystatus']==3){ echo '<img title="Pending" width="15" height="15" src="https://img.icons8.com/emoji/15/yellow-circle-emoji.png" alt="yellow-circle-emoji"/>';}
                              else if($row['companystatus']==4){ echo '<img title="Rejected" width="15" height="15" src="https://img.icons8.com/emoji/15/red-circle-emoji.png" alt="red-circle-emoji"/>';} ?></span>
                            </td>
                            
                            <td class="align-middle text-start">
                              <p class="text-xs text-secondary mb-0"><?php echo ucfirst($row['creditlimit']); ?></p>
                                                        </td> 
                                                         
                            <?php if($getrole == "Admin" || $getrole == "MANAGER"){ ?>
                            
                            <td class="align-middle"> 

                             
                              <a href="editCompany.php?id=<?php echo $row['id'];?>" title="Edit" atrid="<?php echo $row['id']; ?>" id="editlink" class="text-secondary font-weight-bold text-xs editlink" >
                              <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                              </a>
                              <?php 
                                if($getrole == "Admin"){
                              ?>
                               <a href="deletecompany.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs" ><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/></a>
                             
                               <?php } ?>
                             </td>
                             <?php } ?>
                            
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                  </div>
            
              </div>
              <div class="col-lg-3 d-none">
                <?php include("livefeed.php");?>
              </div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <!-- modal start -->
   <!--  <div class="xyz">
    </div> -->
    <!-- modal end -->



<!-- <script src="addlivefeed.js"></script> -->






<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

  </body>
</html>
<style>
    a{
  text-decoration: none!important;
}
</style>

 <script>
        document.getElementById("downloadBtn").addEventListener("click", function() {
            window.location.href = "downloadCustomer.php"; // Replace with the URL of your PHP script
        });
    </script>


