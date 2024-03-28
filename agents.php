<?php
session_start();
// Include the function.php file
require_once "config.php";
require_once "function.php";
//echo "<pre>"; print_r($_SESSION);die;
if(!($_SESSION)){
    header("location: login_page.php");
  }
  // Check if the form was submitted
if (isset($_POST["submit"])) {
    $agentname = $_POST["agentname"];
    $agentphoneno = $_POST["agentphoneno"];
    $agentrole = $_POST["agentrole"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $date = date('Y-m-d, H:i:s');

    // Call the insertData function
    // Assuming $mysqli is your database connection object
    $insertResult = insertData($mysqli, $agentname, $email, $department,$agentphoneno,$agentrole,$date);
   
    // Check the result of the insertion
    $error = "";
    $message = "";
    if ($insertResult=="This email is already in use. Please choose a different email.") {
        $error = "<span style='color:red'>This email is already in use. Please choose a different email.</span>";
    } else if($insertResult == "Agent inserted successfully."){
        // Insertion failed
        $message = "Agent inserted successfully.";
    }else{
      $error = "<span style='color:red'>Failed to insert agent</span>";
    }
}
if(isset($_POST['update'])){
    //echo "<pre>"; print_r($_POST); die;
    $agentname = $_POST["agentname"];
    $agentphoneno = $_POST["agentphoneno"];
    $agentrole = $_POST["agentrole"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $updatedat = date('Y-m-d, H:i:s');
    $id = $_POST['agentid'];
    $updateinfo = updateData($mysqli, $agentname, $email, $department,$agentphoneno,$agentrole,$updatedat,$id);
    $error = "";
    $message = "";
    if ($updateinfo=="Error updating agent") {
        $error = "<span style='color:red'>Error updating agent</span>";
    } else if($updateinfo == "Agent updated successfully"){
        // Insertion failed
        $message = "Agent updated successfully.";
    }else{
      $error = "<span style='color:red'>Failed to update agent</span>";
    }
}
?>
<?php include("header.php")?>
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
              <h5 class="text-break">Agent Listing</h5>
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
              <!-- Button trigger modal -->
              <?php if(($_SESSION['agentrole'] == "Manager") || ($_SESSION['agentrole'] == "MANAGER") || ($_SESSION['agentrole'] == "Admin")) { ?>
              <span class="rounded-pill shadow text-white"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Agent</span>
            <?php } ?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
        <h5 class="mt-2 " id="staticBackdropLabel">Add Agent </h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post">
         <h6 class="mt-2 mb-4">Agent Information</h6>
         <div class="row">
          <div class="col-md-4">
            <div class="form-group mb-4">
              <input name="agentname" required="" class="form-control" type="text" placeholder="Agent Name *">
            </div>

            

           
            <div class="form-group mb-4 ">
              <!-- <p>ROADWINGS LOGISTICS, <br> 6628 Sky Pointe Dr. Ste- 129
              Las Vegas, NV - 89131</p> -->
              <textarea class="form-control" rows="4" disabled="">ROADWINGS LOGISTICS,
6628 Sky Pointe Dr. Ste- 129
Las Vegas, NV - 89131  
P: +1 833 781 8686
</textarea>
            </div>


            


          </div><div class="col-md-4">
            

            <div class="form-group mb-4 ">
              <input required="" class="form-control" name="agentphoneno" type="tel" minlength="10" maxlength="10" placeholder="Contact Number *">
            </div><div class="form-group mb-4">
                <select name="agentrole" class="form-control">
                  <!-- <option value="Manager">Manager</option>
                  <option value="Team Leader">Team Leader</option>
                  <option value="Agent">Agent</option> -->
  
                  <option value=""> SELECT</option>
                  <option value="COORDINATOR">COORDINATOR</option>
                  <option value="MANAGER">MANAGER</option>
                </select>
              </div>

            

          </div>

          <div class="col-md-4">
            <div class="form-group mb-4">
              <input required="" class="form-control" name="email" type="email" placeholder="Agent E-mail ID *">
            </div>
            <div class="form-group mb-4 ">
              <select name="department" class="form-control">
                <!-- <option value="Manager">Manager</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Agent">Agent</option> -->

                <option selected="">DEPARTMENT</option>
                <option value="DISPATCH">DISPATCH</option>
                <option value="CUSTOMER SUPPORT">CUSTOMER SUPPORT</option>
                <option value="ACCOUNTS">ACCOUNTS</option>
                <option value="CMT PROFILE">CMT PROFILE</option>

              </select>
            </div>

            
            
            
          </div>

          <!-- <span class="aside-hr mt-3 mb-4"></span> -->



          <div class="col-lg-6">
          
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4 text-end">
            <div class="form-group ">
              <button type="submit" name="submit" class="btn ">Submit Details</button>
            </div>
          </div>
         </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<!-- Button trigger modal end -->
</div>
<div class="abc">
 
</div>

             <div class="row mt-4 ">
              <div class="col-lg-12">
                <div class="p-3 ">
                  <div class=" mb-4">
                    <div class="card-header pb-0">
                      <h6 class="text-white">Listing</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-th ">Agents</th>
                              <th class="text-center text-uppercase text-uppercase text-th">DEPARTMENT</th>
                              <th class="text-center text-uppercase text-uppercase text-th">Company Number</th>
                             <!--  <th class="text-uppercase text-uppercase text-th">Company Address</th> -->
                              <th class="text-center text-uppercase text-uppercase text-th">DESIGNATION</th>
                              <th class="text-center text-uppercase text-th">Contact Number</th>
                              <th class="text-center text-uppercase text-th">Joined Date</th>
                              <?php if(($_SESSION['agentrole'] == "Manager") || ($_SESSION['agentrole'] == "MANAGER") || ($_SESSION['agentrole'] == "Admin")) {?>
                              <th class="text-secondary opacity-7"></th>
                            <?php } ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $agentData = getAgents($mysqli);
                            foreach($agentData as $row){ 
                            ?>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <a href="#" class="mb-0 text-sm"><?php echo ucfirst($row['agentname']); ?></a>
                                    <p class="text-xs text-secondary mb-0"><?php echo $row['email']; ?></p>
                                    <p class="text-xs text-secondary mb-0">Username: (<?php echo $row['email']; ?>)</p>
                                  </div>
                                </div>
                              </td>
                              <!-- <td>
                                 <p class="text-xs font-weight-bold mb-0"><?php //echo ucfirst($row['agentrole']); ?></p> 

                                <p class="text-xs text-secondary mb-0"><?php //echo "Roadwings" ?></p> 
                              </td> -->

                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">Dispatch </span>
                              </td>

                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">88449989929 </span>
                              </td>

                             <!--  <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">Roadwings 8584 </span>
                              </td> -->

                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['agentrole']?></span>
                              </td>
                              <td class="align-middle text-center text-sm">
                              
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['agentphoneno']; ?></span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo date('Y-m-d',strtotime($row['createdat'])); ?></span>
                              </td>
                              <?php 
                              if(($_SESSION['agentrole'] == "Manager") || ($_SESSION['agentrole'] == "MANAGER") || ($_SESSION['agentrole'] == "Admin")) {
                                ?>
                              <td class="align-middle">
                                <a href="javascript:" title="Edit" atrid="<?php echo $row['id']; ?>" id="getagents" class="text-secondary font-weight-bold text-xs getagents" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                                </a>
                                <?php if($_SESSION['agentrole'] == "Admin"){?>
                                <a href="delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs" >
                                <img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/>
                                </a>
                              <?php }?>
                              </td>
                            <?php } ?>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                 </div>
              </div>
              <?php// include("livefeed.php")?>
             </div>
          </div>
        </div>
      </div>
    </section>
<script type="text/javascript">
    $(document).ready(function () {
        $('.table').DataTable({
            "ordering": false // Disable sorting
        });
    });
</script>
  <script src="addlivefeed.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
