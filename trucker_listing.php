<?php
ob_start();
session_start();
include('config.php');
include("header.php");
include('function.php');
//session_destroy();
//echo "<pre>"; print_r($_SESSION);die;
  if(!($_SESSION)){
    header("location: login_page.php");
  }
  if(isset($_POST['submit'])){
    //echo "<pre>"; print_r($_POST); die;
    $tname = $_POST['tname'];
    $tphoneno = $_POST['tphoneno'];
    $temail = $_POST['temail'];
    $tmcno = $_POST['tmcno'];
    $taddress = $_POST['taddress'];
    $carrierpaymentterm = $_POST['carrierpaymentterm'];
    $createdby = $_SESSION['id'];
    $createdat = date('Y-m-d, H:i:s');
    $lane = $_POST['lane'];

    $addTrucker = addTrucker($mysqli,$tname,$tphoneno,$temail,$tmcno,$taddress,$createdby,$createdat,$carrierpaymentterm,$lane);
    $message = "";
    $error = "";
    if($addTrucker == "Trucker added successfully."){
      $message = "Trucker added successfully.";
    }
    else if($addTrucker == "Email already registered" ){
      $error = "Email already registered.";
    }
    else{
      $error = "Failed to add trucker.";
    }

  }

  //$getLoad = getLoad($mysqli);
  $trucker = getGrucker($mysqli);

  $role = $_SESSION['agentrole'];


//echo "<pre>"; print_r($getCompaniesForLoad);die;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trucker</title>
</head>
<body>
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
              <h5 class="text-break">Carrier Listing</h5>
              <?php if($role == "Admin" || $role == "MANAGER"){?>
              <span class="rounded-pill shadow text-white"><span class="text-white" id="downloadBtn">Download Carrier</span></span>
            <?php } ?>
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
                echo "<h5>" . $message . "</h5>";
              }?>
              <?php if(!empty($error)){
        ?>
         <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
        <?php

        echo "<h5>" . $error . "</h5>";

    }?>


          <span class="rounded-pill shadow text-white" id="openModalBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Carrier</span>    
          </div>
          <div class="row mt-4 ">
           

        <?php //include("rightbar.php");?>
        <div class="col-lg-12">
          <div class="table-responsive p-0 mt-3 main-header main-three p-3">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th class="text-start text-uppercase text-th sorting_disabled">Trucker Name</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Contact NUmber</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">E-mail ID</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">MC Number</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Trucker Address</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Payment Terms</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Lane</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Added Date</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Added By</th>
                    <?php if($role == "Admin" || $role == "MANAGER"){?>
                    <th class="text-start text-uppercase text-th sorting_disabled ">Action</th>
                  <?php } ?>
                    
                

                                        
                  <!-- <th class="text-secondary "></th> -->
              </tr>
              </thead>
              <tbody>
                <?php foreach($trucker as $load){ ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center companyname">
                          <a title="Load Data" class="mb-0 text-xs"><?php echo $load['tname']?></a>
                          
                        </div>

                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0"><?php echo $load['tphoneno']?></p>
                          
                        </div>
                      </div>
                    </td>
                    
                    <td class="align-middle text-start text-sm">
                      <p class="text-xs font-weight-bold mb-0"><?php echo $load['temail']?></p>
                    </td>
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $load['tmcno']?></span>
                    </td>
                   
                 
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $load['taddress']?></span>
                    </td>
                    
                    
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $load['carrierpaymentterm'] . ' ' . "Days"?></span>
                    </td>

                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($load['lane']);?></span>
                    </td>

                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold"><?php  

                      $date = new DateTime($load['createdat']);
                      $dateWithoutTime = $date->format('Y-m-d');
                      echo $dateWithoutTime;
                    ?></span>
                    </td>

                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $load['agentname']?></span>
                    </td>
                                          
                    
                    <?php if($role == "Admin" || $role == "MANAGER"){?>
                     <td class="align-middle ">  
                      <a href="edittcarrier.php?id=<?php echo $load['id']?>" title="Edit" atrid="4"  class="text-secondary font-weight-bold text-xs editlink">
                      <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design">
                      </a>
                       <a href="deletetrucker.php?id=<?php echo $load['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs"><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"></a>

                      </td>
                    <?php }?>
                                           
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
</div>

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

<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>



<!-- 
 
 -->


 <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <form method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header di-flex justify-content-between">
        <h5 class="modal-title">Add Trucker</h5>
        
          <span aria-hidden="true"><img class="close" data-dismiss="modal" id="closeModalBtn" aria-label="Close" width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"></span>
       
      </div>
    
        <div class="col-md-12">
            <div class="form-group mb-4">
                <input id="truckerNo" class="form-control" required name="tname" type="text" placeholder="Trucker Name" value="<?php echo isset($_POST['tname']) ? $_POST['tname'] : ''; ?>">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-4">
                <input id="truckerNo" class="form-control" required name="tphoneno" type="tel" placeholder="Contact Number" value="<?php echo isset($_POST['tphoneno']) ? $_POST['tphoneno'] : ''; ?>">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-4">
                <input id="truckerEmail" class="form-control" required name="temail" type="email" placeholder="Email Address" value="<?php echo isset($_POST['temail']) ? $_POST['temail'] : ''; ?>">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-4">
                <input id="truckerAddress" class="form-control" required name="tmcno" type="text" placeholder="MC Number" value="<?php echo isset($_POST['tmcno']) ? $_POST['tmcno'] : ''; ?>">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-4">
                <textarea class="form-control" required="" name="taddress" placeholder="Trucker Address" id="truckerAddress" cols="30" rows="1"><?php echo isset($_POST['taddress']) ? $_POST['taddress'] : ''; ?></textarea>
            </div>
        </div>

         <div class="col-md-12">
            <div class="form-group mb-4">
                <input id="carrierInputSecond" class="form-control" required="" name="lane" type="text" placeholder="Lane" value="<?php echo isset($_POST['lane']) ? $_POST['lane'] : ''; ?>">
            </div>
        </div>
<!-- 
        <div class="col-md-12">
            <div class="form-group mb-4">
                <input id="carrierInputSecond" class="form-control" required="" name="tcarrierrate" type="text" placeholder="Carrier Rate" value="<?php// echo isset($_POST['tcarrierrate']) ? $_POST['tcarrierrate'] : ''; ?>">
            </div>
        </div> -->

         <div class="col-md-12">
            <div class="form-group mb-4">
                        <select name="carrierpaymentterm"  class="form-control">
                          <option selected>Payment Terms ( 1 - 50 days)</option>
                          <option value="1">1</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                          <option value="30">30</option>
                          <option value="35">35</option>
                          <option value="40">40</option>
                          <option value="45">45</option>
                          <option value="50">50</option>
                          <option value="COD">COD</option>
                         
                         
                        </select>
                      </div>
                    </div>

        <div class="col-lg-4"></div> 
        <div class="col-lg-4 text-end">
            <div class="form-group mb-4 form-item mt-4">
                
            </div>
        </div>
  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
       <button name="submit" type="submit" class="rounded-pill shadow text-white">Add Carrier</button>
      </div>
    </div>
  </div>
  </form>
</div>


<script>
$(document).ready(function(){
  $("#openModalBtn").click(function(){
    $("#exampleModal").modal('show');
  });

  $('#closeModalBtn').click(function() {
    
    $('#exampleModal').modal('hide');
});
});
</script>

<script>
        document.getElementById("downloadBtn").addEventListener("click", function() {
            window.location.href = "downloadtrucker.php"; // Replace with the URL of your PHP script
        });
    </script>


