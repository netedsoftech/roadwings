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
?>
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
              <span class="rounded-pill shadow text-white">Assembly</span>
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

                           <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                           
                          <th class="text-secondary "></th>
                          <?php endif; ?>
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
<!-- 
                                <div class="d-flex flex-column justify-content-center">
                                  <p class="text-xs font-weight-bold mb-0"><?php// echo ucfirst($row['companyname']); ?></p>
                                  
                                </div> -->
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
              <div class="col-lg-3 d-none">
                <?php include("livefeed.php");?>
              </div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <!-- modal start -->
    <div class="xyz">
    </div>
    <!-- modal end -->

    <script type="text/javascript">
    $(document).ready(function () {
        $('.table').DataTable({
            "ordering": false // Disable sorting
        });
    });
</script>


<!-- <script src="addlivefeed.js"></script> -->


<script>
  $(document).ready(function(){
    // Define the mapping object for company status
    var statusMap = {
        1: "Working",
        2: "Approved",
        3: "Pending",
        4: "Rejected"
    };

    $('.editlink').click(function(e){
        e.preventDefault();
        
        // Retrieve the ID from the 'atrid' attribute
        var companyId = $(this).attr('atrid');
        
        // Send AJAX request to retrieve data
        $.ajax({
            type: 'POST',
            url: 'get_company_data.php', // Replace 'get_company_data.php' with your PHP file to handle the request
            data: { companyId: companyId },
            dataType: 'json',
            success: function(data){
                // Handle the data returned from the server
                console.log("Data received from server:", data);
                var content = `<div class="modal fade" id="dynamicBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
                                <!-- <h5 class="mt-2 " id="staticBackdropLabel">Company</h5> -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <h5 class="mt-2 mb-5">Edit Company</h5>
                                    <h6 class="mt-2 mb-4"></h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Company Name <sub>*</sub></label>
                                                <input class="form-control" type="text" name="companyname" value="${data.companyname}" placeholder="Morissette PLC">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Contact Name <sub>*</sub></label>
                                                <input class="form-control" type="text" value="${data.contactperson}" name="contactperson" placeholder="XYZ Limited">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Company E-mail ID <sub>*</sub></label>
                                                <input class="form-control" type="email" value="${data.emailaddress}" name="emailaddress" placeholder="hudson.wilhelmine@boehm.com">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
                                                <input class="form-control" type="tel" value="${data.companycontactno}" name="companycontactno" minlength="12" maxlength="12" placeholder="+1 (323) 916-4686">
                                            </div>
                                        </div>
                                        <span class="aside-hr mt-3 mb-4"></span>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Company Full Address <sub>*</sub></label>
                                                <input class="form-control" value="${data.address}" name="address" type="text" placeholder="93229 Carli Points">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Postal Code</label>
                                                <input class="form-control" value="${data.zipcode}" name="zipcode" type="text" placeholder="84073">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">City</label>
                                                <input class="form-control" value="${data.city}" name="city" type="text" placeholder="Port Danielafort">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">State</label>
                                                <input class="form-control" value="${data.state}" name="state" type="text" placeholder="Port Danielafort">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <label for="example-text-input" class="form-control-label mb-2">Company Status</label>
                                                <select name="companystatus" class="form-control">
                                                    <!-- Populate options dynamically -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4 text-end">
                                            <div class="form-group mb-4 mt-4">
                                                <input type="hidden" name="companyid" value="${data.id}">
                                                <button name="update" class="btn ">Submit Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('#dynamicBackdrop1').remove();
                // Append the modal content to the body
                $('body').append(content);
                // Map the numeric status value to its string representation
                var status = statusMap[data.companystatus];
                console.log("Mapped status:", status);
                // Update the selected option in the dropdown with the mapped string representation
                var dropdown = $('select[name="companystatus"]');
                dropdown.empty(); // Clear existing options
                $.each(statusMap, function(key, value) {
                    dropdown.append($('<option></option>').attr('value', key).text(value));
                });
                dropdown.val(data.companystatus).change(); // Set selected value
                // Show the modal
                $('#dynamicBackdrop1').modal('show');
            },
            error: function(xhr, status, error){
                // Handle errors
                console.error("Error fetching company data:", xhr.responseText);
            }
        });
    });
});
</script>



<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>