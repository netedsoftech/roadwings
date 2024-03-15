<?php
// Include the function.php file
require_once "config.php";
require_once "function.php";
//echo "<pre>"; print_r($_SESSION);die;
if(!($_SESSION)){
    header("location: login_page.php");
  }
  // Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $agentname = $_POST["agentname"];
    $agentphoneno = $_POST["agentphoneno"];
    $agentrole = $_POST["agentrole"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $date = date('Y-m-d, H:i:s');

    // Call the insertData function
    // Assuming $mysqli is your database connection object
    $insertResult = insertData($mysqli, $agentname, $email, $password,$agentphoneno,$agentrole,$date);

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
              <!-- Button trigger modal -->
              <?php if(($_SESSION['agentrole'] == "Manager") || ($_SESSION['agentrole'] == "Admin")) { ?>
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
         <h6 class="mt-2 mb-4">Agent INFORMATION</h6>
         <div class="row">
          <div class="col-md-4">
            <div class="form-group mb-4">
              <input name="agentname" required="" class="form-control" type="text" placeholder="Agent Name *">
            </div>

            

           
            <div class="form-group mb-4">
              <input required="" class="form-control" name="agentphoneno" type="tel" minlength="10" maxlength="10" placeholder="Contact Number *">
            </div>


            


          </div><div class="col-md-4">
            

            <div class="form-group mb-4 ">
              <input required="" class="form-control" name="agentphoneno" type="tel" minlength="10" maxlength="10" placeholder="Company Default Number *">
            </div><div class="form-group mb-4">
                <select name="agentrole" class="form-control">
                  <!-- <option value="Manager">Manager</option>
                  <option value="Team Leader">Team Leader</option>
                  <option value="Agent">Agent</option> -->
  
                  <option selected="">DESIGNATION</option>
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
              <select name="agentrole" class="form-control">
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
          <div class="form-group mb-4 ">
              <p>ROADWINGS LOGISTICS, <br> 6628 Sky Pointe Dr. Ste- 129
Las Vegas, NV - 89131</p>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4 text-end">
            <div class="form-group ">
              <button class="btn ">Submit Details</button>
            </div>
          </div>
         </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
        <h5 class="mt-2 " id="staticBackdropLabel1">Edit Agent Details</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
         <h6 class="mt-2 mb-4">Agent INFORMATION</h6>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-4 form-item">
              <label for="example-text-input" class="form-control-label mb-2">Agent Name <sub>*</sub></label>
              <input class="form-control" type="text" placeholder="Morissette PLC">
            </div>

            <div class="form-group mb-4 form-item">
              <label for="example-text-input" class="form-control-label mb-2">Agent Username <sub>*</sub></label>
              <input class="form-control" type="text" minlength="10" maxlength="10" placeholder="wick2@roadwings">
            </div>

            <div class="form-group mb-4 form-item">
              <label for="example-text-input" class="form-control-label mb-2">Agent Role</label>
              <select name="companyStatus" class="form-control">
                <option value="Manager">Manager</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Agent">Agent</option>

              </select>
            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group mb-4 form-item">
              <label for="example-text-input" class="form-control-label mb-2">Agent E-mail ID <sub>*</sub></label>
              <input class="form-control" type="email" placeholder="hudson.wilhelmine@boehm.com">
            </div>

            <div class="form-group mb-4 form-item">
              <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
              <input class="form-control" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686">
            </div>
            
          </div>
          <!-- <span class="aside-hr mt-3 mb-4"></span> -->



          <div class="col-lg-4"></div>
          <div class="col-lg-4 text-end px-3">
    <div class="form-group ">
              <button class="btn bg-danger">Delete Agent</button>
            </div>
</div>
          <div class="col-lg-4 text-start">
            <div class="form-group ">
              <button class="btn bg-success">Update Info</button>
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
                              <th class="text-uppercase text-uppercase text-th">DEPARTMENT</th>
                              <th class="text-uppercase text-uppercase text-th">Company Number</th>
                              <th class="text-uppercase text-uppercase text-th">Company Address</th>
                              <th class="text-uppercase text-uppercase text-th">DESIGNATION</th>
                              <th class="text-center text-uppercase text-th">Contact Number</th>
                              <th class="text-center text-uppercase text-th">Employed</th>
                              <th class="text-secondary opacity-7"></th>
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

                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">Roadwings 8584 </span>
                              </td>

                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">Manager</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                              
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['agentphoneno']; ?></span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo date('Y-m-d',strtotime($row['createdat'])); ?></span>
                              </td>
                              <?php 
                              if(($_SESSION['agentrole'] == "Manager") || ($_SESSION['agentrole'] == "Admin")) {
                                ?>
                              <td class="align-middle">
                                <a href="javascript:" title="Edit" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                                </a>
                                <?php if($_SESSION['agentrole'] == "Admin"){?>
                                <a href="delete.php" title="Delete" class="text-secondary font-weight-bold text-xs" >
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
      $(document).ready( function () {
          $('.table').DataTable();
      });
  </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
