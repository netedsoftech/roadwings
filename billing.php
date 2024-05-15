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
                       <th class="text-start text-uppercase text-th sorting_disabled">Company Payment Status</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Carrier Payment Status</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Carrier Paid Amount</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Company Paid Amount</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Carrier Amount Left</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Company Amount Left</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Carrier Payment Date</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Compay Payment Date</th>
                       <th class="text-start text-uppercase text-th sorting_disabled">Total Profit</th>
                       
                      <th class="text-start text-uppercase text-th sorting_disabled">Carrier Next Date</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Company Next Date</th>
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
                <td><?php echo ucfirst($row['carrierinvoiceno']); ?></td>
                <td><?php echo ucfirst($row['locationfrom']); ?></td>
                <td><?php echo ucfirst($row['locationto']); ?></td>
                <td><?php echo $row['startdate']; ?></td>
                <td><?php echo ucfirst($row['deliverydate']); ?></td>
                <td><?php echo ucfirst($row['paymentterm']) . " " . "Days"; ?></td>
                <td><?php echo $row['carrierpaymentterm'] . " " . "Days"; ?></td>
                <td>$<?php echo ucfirst($row['customerrate']); ?></td>
                <td>$<?php echo ucfirst($row['carrierrate']); ?></td>
                <td><?php echo isset($row['company_payment_data']['companypaymentstatus']) ? $row['company_payment_data']['companypaymentstatus'] : ''; ?></td>
                <td>
    <?php 
    if (isset($row['carrier_payment_data']['truckerpaymentstatus'])) {
        if ($row['carrier_payment_data']['truckerpaymentstatus'] === 'Tono') {
            echo 'Tono';
        } else {
            echo $row['carrier_payment_data']['truckerpaymentstatus'];
        }
    } else {
        echo '';
    }
    ?>
</td>
                
                <td>$<?php echo isset($row['carrier_payment_data']['total_shipperpaidamount']) ? $row['carrier_payment_data']['total_shipperpaidamount'] : ''; ?></td>
                <td>$<?php echo isset($row['company_payment_data']['total_companypaidamount']) ? $row['company_payment_data']['total_companypaidamount'] : ''; ?></td>
                <td>$<?php echo $row['carrier_payment_left']; ?></td>
                <td>$<?php if(isset($row['company_payment_left'])){ echo $row['company_payment_left']; } ?></td>
                <td><?php echo isset($row['carrier_payment_data']['shippperpaymentdate']) ? $row['carrier_payment_data']['shippperpaymentdate'] : ''; ?></td>
                <td><?php echo isset($row['company_payment_data']['companypaymentdate']) ? $row['company_payment_data']['companypaymentdate'] : ''; ?></td>
               <td><?php echo $row['customerrate'] - $row['carrierrate'];?></td>
                <td>
                <?php 
                if (isset($row['carrier_payment_data']['carriernextpaymentdate'])) {
                    $nextPaymentDate = strtotime($row['carrier_payment_data']['carriernextpaymentdate']);
                    if ($nextPaymentDate > time()) {
                        echo $row['carrier_payment_data']['carriernextpaymentdate'];
                    } else {
                        echo 'No due date left';
                    }
                } else {
                    echo '';
                }
                ?>
            </td>
            <td>
    <?php 
    if (isset($row['company_payment_data']['nextpaymentdate'])) {
        $nextPaymentDate = strtotime($row['company_payment_data']['nextpaymentdate']);
        if ($nextPaymentDate > time()) {
            echo $row['company_payment_data']['nextpaymentdate'];
        } else {
            echo 'No due date left';
        }
    } else {
        echo '';
    }
    ?>
</td>


                <td><?php echo ucfirst($row['agentname']); ?></td>
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


