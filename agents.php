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
  <body>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
    

          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
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
  <div class="modal-dialog">
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
          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Name <sub>*</sub></label>
              <input name="agentname" required class="form-control" type="text" placeholder="Morissette PLC">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Password <sub>*</sub></label>
              <input name="password" required class="form-control" type="password"  placeholder="************">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Role</label>
              <select name="agentrole" class="form-control">
                <option value="Manager">Manager</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Agent">Agent</option>

              </select>
            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent E-mail ID <sub>*</sub></label>
              <input required class="form-control" name="email" type="email" placeholder="hudson.wilhelmine@boehm.com">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
              <input required class="form-control" name="agentphoneno" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686">
            </div>
            
          </div>
          <!-- <span class="aside-hr mt-3 mb-4"></span> -->



          <div class="col-lg-4"></div>
          <div class="col-lg-4"></div>
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
  <div class="modal-dialog">
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
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Name <sub>*</sub></label>
              <input class="form-control" type="text" placeholder="Morissette PLC">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Username <sub>*</sub></label>
              <input class="form-control" type="text" minlength="10" maxlength="10" placeholder="wick2@roadwings">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Role</label>
              <select name="companyStatus" class="form-control">
                <option value="Manager">Manager</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Agent">Agent</option>

              </select>
            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent E-mail ID <sub>*</sub></label>
              <input class="form-control" type="email" placeholder="hudson.wilhelmine@boehm.com">
            </div>

            <div class="form-group mb-4">
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
              <div class="col-lg-9">
                <div class="main-header p-3 ">
                  <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Listing</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs ">Agents</th>
                              <th class="text-uppercase text-uppercase text-xxs">Role</th>
                              <th class="text-center text-uppercase text-xxs">Contact Number</th>
                              <th class="text-center text-uppercase text-xxs">Employed</th>
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
                                    <h6 class="mb-0 text-sm"><?php echo ucfirst($row['agentname']); ?></h6>
                                    <p class="text-xs text-secondary mb-0"><?php echo $row['email']; ?></p>
                                    <p class="text-xs text-secondary mb-0">Username: (<?php echo $row['email']; ?>)</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['agentrole']); ?></p>
                                <p class="text-xs text-secondary mb-0"><?php echo "Roadwings" ?></p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success"><?php echo $row['agentphoneno']; ?></span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo date('Y-m-d',strtotime($row['createdat'])); ?></span>
                              </td>
                              <?php 
                              if(($_SESSION['agentrole'] == "Manager") || ($_SESSION['agentrole'] == "Admin")) {
                                ?>
                              <td class="align-middle">
                                <a href="javascript:" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                  Edit
                                </a>
                                <?php if($_SESSION['agentrole'] == "Admin"){?>
                                <a href="delete.php" class="text-secondary font-weight-bold text-xs" >
                                  Delete
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
              <?php include("livefeed.php")?>
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
