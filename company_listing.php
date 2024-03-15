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
              <span class="rounded-pill shadow text-white">Assembly</span>
             </div>

             <div class="row mt-4 ">
              <div class="col-lg-12">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                            <th class="text-center text-uppercase text-th "> Name</th>
                            <th class="text-center text-uppercase text-th "> E-mail ID</th>
                            <th class="text-center text-uppercase text-th ">Contact Name</th>
                            <th class="text-center text-uppercase text-th ">Ph. Number</th>
                          <th class="text-center text-uppercase text-th  ps-2"> Address</th>
                          <th class="text-center text-uppercase text-th ">Postal Code</th>
                          <th class="text-center text-uppercase text-th ">City</th>
                          <th class="text-center text-uppercase text-th ">state</th>
                          <th class="text-center text-uppercase text-th "> Status</th>
                          <th class="text-center text-uppercase text-th ">Payment Terms</th>
                          <th class="text-center text-uppercase text-th ">Limit Assign</th>
                           <?php if($_SESSION['agentrole'] == "Agent"): ?>
                            <?php else: ?>
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
                                
                                <div class="d-flex flex-column justify-content-center">
                                  <a href="company_shipment_leads.php" class="mb-0 text-xs"><?php echo ucfirst($row['comapnyname']); ?></a>
                                  
                                </div>
                              </div>
                            </td>
                            <!-- <td>
                              <p class="text-xs text-secondary mb-0"><?php echo ucfirst($row['comapnyname']); ?></p>
                                                          </td> -->
                            <td class="align-middle text-center text-sm">
                              <p class="text-xs font-weight-bold mb-0"><?php echo $row['companyemailid']; ?></p>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['companymanagername']); ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['companycontactno']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['companyaddress']); ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['companypostalcode']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['companycity']); ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['companystate']); ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php if($row['companystatus']==1){
                                echo '<img width="15" height="15" src="https://img.icons8.com/external-others-inmotus-design/15/f14f81ab/external-Dot-atm-others-inmotus-design.png" alt="external-Dot-atm-others-inmotus-design"/>';
                              }else if($row['companystatus']==2){ echo '<img width="15" height="15" src="https://img.icons8.com/external-flat-icons-inmotus-design/15/external-green-political-signs-flat-icons-inmotus-design.png" alt="external-green-political-signs-flat-icons-inmotus-design"/>';}else if($row['companystatus']==3){ echo '<img width="15" height="15" src="https://img.icons8.com/emoji/15/yellow-circle-emoji.png" alt="yellow-circle-emoji"/>';}
                              else if($row['companystatus']==4){ echo '<img width="15" height="15" src="https://img.icons8.com/emoji/15/red-circle-emoji.png" alt="red-circle-emoji"/>';} ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['paymentterm']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <p class="text-xs text-secondary mb-0"><?php echo ucfirst($row['companypaymentlimit']); ?></p>
                                                        </td> 
                            <?php if($_SESSION['agentrole'] == "Agent" || $_SESSION['agentrole'] == "Team leader"): ?>
                            <?php else: ?>
                            

                             <td class="align-middle">  
                              <a href="javascript:;" title="Edit" atrid="<?php echo $row['id']; ?>" id="editlink" class="text-secondary font-weight-bold text-xs editlink"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design"/>
                              </a>
                              <?php 
                                if($_SESSION['agentrole'] == "Admin"):
                              ?>
                               <a href="deletecompany.php" title="Delete" class="text-secondary font-weight-bold text-xs" ><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"/></a>
                             
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
            <!-- <h5 class="mt-2 " id="staticBackdropLabel">Company</h5> -->
    
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <h5 class="mt-2 mb-5">Edit Company</h5>
             <h6 class="mt-2 mb-4"></h6>
             <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Company Name <sub>*</sub></label>
                  <input class="form-control" type="text" placeholder="Morissette PLC">
                </div>

                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Contact Name <sub>*</sub></label>
                  <input class="form-control" type="text" placeholder="XYZ Limited">
                </div>

               
              </div>

              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Company E-mail ID <sub>*</sub></label>
                  <input class="form-control" type="email" placeholder="hudson.wilhelmine@boehm.com">
                </div>

                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
                  <input class="form-control" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686">
                </div>
              </div>
              <span class="aside-hr mt-3 mb-4"></span>
              
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Company Full Address <sub>*</sub></label>
                  <input class="form-control" type="text" placeholder="93229 Carli Points">
                </div>

              </div>

              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Postal Code</label>
                  <input class="form-control" type="text" placeholder="84073">
                </div>

              </div>
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">City</label>
                  <input class="form-control" type="text" placeholder="Port Danielafort">
                </div>

              </div>


               <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">State</label>
                  <input class="form-control" type="text" placeholder="Port Danielafort">
                </div>

              </div>

              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Company Status</label>
                  <select name="companyStatus" class="form-control">
                    <option value="working">Working</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                    <option value="high risk">High Risk</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Payment Terms ( 1 - 45 days)</label>
                  <select name="companyStatus" class="form-control">
                    <option value="1">1</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                  </select>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Limit Assign</label>
                  <input class="form-control" type="tel" minlength="2" maxlength="4" placeholder="2000 USD">
                </div>
              </div>


              <div class="col-lg-4"></div>
              <div class="col-lg-4 text-end">
                <div class="form-group mb-4 mt-4">
                  <button class="btn ">Submit Details</button>
                </div>
              </div>
             </div>
            </form>
          </div>
         
        </div>
      </div>
    </div>
    <!-- modal end -->

    <script type="text/javascript">
      $(document).ready( function () {
          $('.table').DataTable();
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
