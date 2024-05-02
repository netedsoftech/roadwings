<?php
ob_start();
session_start();
include('config.php');
include("header.php");
include('function.php');
  if(!($_SESSION)){
    header("location: login_page.php");
  }
  $role = $_SESSION['agentrole'];


//echo "<pre>"; print_r($getCompaniesForLoad);die;

?>


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
              <span class="rounded-pill shadow text-white"><span class="text-white" id="downloadBtn">Download Report</span></span>
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


          <!-- <span class="rounded-pill shadow text-white" id="openModalBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Carrier</span>   -->  
          </div>
          <div class="row mt-4 ">
           

        <?php //include("rightbar.php");?>
        <div class="col-lg-12">
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

                       <th class="text-start text-uppercase text-th sorting_disabled">Customer Rate</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Carrier Rate</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Status</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Added Date</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Added By</th>
                      
                  

                     <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                     
                     <th class="text-secondary ">Action</th> 
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                   <?php
                      $loadData = getLoad1($mysqli);
                      foreach($loadData as $row){ 
                      ?>
                  <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center companyname">
                            <a title="Load Data" href="#" class="mb-0 text-xs" ><?php echo ucfirst($row['carrierinvoiceno']); ?></a>
                            
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
                             <p class="text-xs font-weight-bold mb-0"><?php echo ucfirst($row['locationfrom']); ?></p>
                            
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
                        <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['paymentterm']) . " " . "Days"; ?></span>
                      </td>

                      <td class="align-middle text-start text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['carrierpaymentterm'] . " " . "Days"; ?></p>
                      </td>


                      <td class="align-middle text-start">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['customerrate']); ?></span>
                      </td>
                      <td class="align-middle text-start">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['carrierrate']); ?></span>
                      </td>
                      <td class="align-middle text-start">
                        <span class="text-secondary text-xs font-weight-bold"><?php if($row['status'] == 0){
                          echo "Pending";
                        }if($row['status'] == 1){
                        echo "Paid"; }  ?></span>
                      </td>

                      <td class="align-middle text-start">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['addeddate']); ?></span>
                      </td>

                      <td class="align-middle text-start">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['agentname']); ?></span>
                      </td>

                      <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                      
                      

                       <td class="align-middle">  
                        <a href="editload.php?id=<?php echo $row['id']?>" title="Edit" atrid="<?php echo $row['id']; ?>" id="editlink" class="text-secondary font-weight-bold text-xs editlink" >
                        <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                        </a>
                        <a title="Load Data" href="carrierpayment.php?loadid=<?php echo $row['id']?>&cid=<?php echo $row['cid']?>&tid=<?php echo $row['tid']?>" class="mb-0 text-xs" >Carrier Payment</a>
                        <a title="Load Data" href="companypayment.php?loadid=<?php echo $row['id']?>&cid=<?php echo $row['cid']?>&tid=<?php echo $row['tid']?>" class="mb-0 text-xs" >Company Payment</a>
                        <?php 
                          if($_SESSION['agentrole'] == "Admin"):
                        ?>
                         <a href="deleteload.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs" ><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/></a>
                       
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


<script>
        document.getElementById("downloadBtn").addEventListener("click", function() {
            window.location.href = "downloadload.php"; // Replace with the URL of your PHP script
        });
    </script>


