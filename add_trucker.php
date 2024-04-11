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
              <h5 class="text-break">Carrier Data</h5>
          </div>
          <div class="row mt-4 ">
            <div class="col-lg-8">
               <!-- Company form start -->
              <div class="main-header p-3" id="companyFormContainer">
                <form method="post">
                  <h5 class="mt-2 mb-5">Add Carrier </h5>
                 <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                 <div class="row">
                  <div class="col-md-4 d-none">
                    <div class="form-group mb-4 ">
                      <input class="form-control" name="dat rate" type="text" placeholder="dat rate" hidden="">
                    </div>

                  </div>

                  

                  

                

                 

                  <div class="col-md-4">
                    <div class="form-group mb-4 ">
                    <input id="truckerNo" class="form-control" required="" name="truckerName" type="text" placeholder="Trucker Name" value="">
                    </div>

                  </div>

                  <div class="col-md-4">
                    <div class="form-group mb-4 ">
                    <input id="truckerNo" class="form-control" required="" name="truckerName" type="tel" placeholder="Contact Number" value="">
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-4 ">
                    <input id="truckerEmail" class="form-control" required="" name="truckerEmail" type="tel" placeholder="Email Address" value="">
                    </div>

                  </div>


                  <div class="col-md-4">
                    <div class="form-group mb-4 ">
                    <input id="truckerAddress" class="form-control" required="" name="truckerAddress" type="tel" placeholder="MC Number" value="">
                    </div>

                  </div>


                  <div class="col-md-4">
                    <div class="form-group mb-4 ">
                    <textarea class="form-control" required="" name="truckerAddress" type="tel" placeholder="Trucker Address" value="" id="truckerAddress" cols="30" rows="1"></textarea>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-4 ">
                      <input id="carrierInputSecond" class="form-control" required="" name="carrier rate" type="tel" placeholder="Carrier Rate" readonly="" value="">
                    </div>

                  </div>

                  <div class="col-md-4"></div>
                  <!-- <div class="col-lg-4"></div>-->
                  <div class="col-lg-4"></div> 
                  <div class="col-lg-4 text-end">
                    <div class="form-group mb-4 form-item mt-4">
                      <button name="submit" type="submit" class="btn ">Add Carrier</button>
                    </div>
                  </div>
                 </div>
                </form>
          </div>

        </div>

        <div class="col-lg-4">
          <div class="main-header ">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Companies Status</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                      <img width="35" height="35" src="https://img.icons8.com/color/35/hourglass-sand-top.png" alt="hourglass-sand-top">
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Pending</h6>
                      <!-- <span class="text-xs">1 in stock, <span class="font-weight-bold">346+ sold</span></span> -->
                      <span class="text-xs">1 is Pending <span class="font-weight-bold"></span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                      <img width="35" height="35" src="https://img.icons8.com/fluency/35/hard-working.png" alt="hard-working">
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Working</h6>
                      <span class="text-xs">1 <span class="font-weight-bold"> is Working</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                      <img width="35" height="35" src="https://img.icons8.com/doodle/35/ok.png" alt="ok">
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Approved</h6>
                      <span class="text-xs">1 is active <span class="font-weight-bold"></span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                      <img width="35" height="35" src="https://img.icons8.com/external-bearicons-flat-bearicons/35/external-rejected-approved-and-rejected-bearicons-flat-bearicons-3.png" alt="external-rejected-approved-and-rejected-bearicons-flat-bearicons-3">
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Rejected</h6>
                      <span class="text-xs font-weight-bold">1 is Rejected</span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
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
                    <th class="text-start text-uppercase text-th sorting_disabled">Carrier Rate</th>
                    <th class="text-start text-uppercase text-th sorting_disabled">Action</th>
                    
                

                                        
                  <!-- <th class="text-secondary "></th> -->
                                    </tr>
              </thead>
              <tbody>
                                   <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center companyname">
                          <a title="Load Data" href="load_data.php" class="mb-0 text-xs">Sdfsdf</a>
                          
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
                          <p class="text-xs font-weight-bold mb-0">Susheel</p>
                          
                        </div>
                      </div>
                    </td>
                    
                    <td class="align-middle text-start text-sm">
                      <p class="text-xs font-weight-bold mb-0">sdf@gmail.com</p>
                    </td>
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                   
                 
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                    
                    
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                                          
                    

                     <td class="align-middle">  
                      <a href="javascript:;" title="Edit" atrid="4" id="editlink" class="text-secondary font-weight-bold text-xs editlink" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design">
                      </a>
                                               <a href="deletecompany.php?id=4" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs"><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"></a>
                     
                                              </td>
                                           
                  </tr>
                                    <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center companyname">
                          <a title="Load Data" href="load_data.php" class="mb-0 text-xs">Sdfsdf</a>
                          
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
                          <p class="text-xs font-weight-bold mb-0">Susheel</p>
                          
                        </div>
                      </div>
                    </td>
                    
                    <td class="align-middle text-start text-sm">
                      <p class="text-xs font-weight-bold mb-0">sdfsdf@gmail.com</p>
                    </td>
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sdfsdfs</span>
                    </td>
                   
                 
                    
                    
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>                 
                    

                     <td class="align-middle">  
                      <a href="javascript:;" title="Edit" atrid="3" id="editlink" class="text-secondary font-weight-bold text-xs editlink" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design">
                      </a>
                                               <a href="deletecompany.php?id=3" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs"><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"></a>
                     
                                              </td>
                                           
                  </tr>
                                    <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center companyname">
                          <a title="Load Data" href="load_data.php" class="mb-0 text-xs">Sdfsdf</a>
                          
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
                          <p class="text-xs font-weight-bold mb-0">Susheel</p>
                          
                        </div>
                      </div>
                    </td>
                    
                    <td class="align-middle text-start text-sm">
                      <p class="text-xs font-weight-bold mb-0">sdfsdf@gmail.com</p>
                    </td>
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sdfsdfs</span>
                    </td>
                   
                 
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                    
                
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>                  
                    

                     <td class="align-middle">  
                      <a href="javascript:;" title="Edit" atrid="2" id="editlink" class="text-secondary font-weight-bold text-xs editlink" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design">
                      </a>
                                               <a href="deletecompany.php?id=2" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs"><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"></a>
                     
                                              </td>
                                           
                  </tr>
                                    <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center companyname">
                          <a title="Load Data" href="load_data.php" class="mb-0 text-xs">Comsdfsdfpany name</a>
                          
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
                          <p class="text-xs font-weight-bold mb-0">Susheel</p>
                          
                        </div>
                      </div>
                    </td>
                    
                    <td class="align-middle text-start text-sm">
                      <p class="text-xs font-weight-bold mb-0">compansdfsdfy@gmail.com</p>
                    </td>
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sussdfsdfsdheel</span>
                    </td>
                   
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                    
                    
                    
                    <td class="align-middle text-start">
                      <span class="text-secondary text-xs font-weight-bold">Sfdsf</span>
                    </td>
                                          
                    

                     <td class="align-middle">  
                      <a href="javascript:;" title="Edit" atrid="1" id="editlink" class="text-secondary font-weight-bold text-xs editlink" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <img width="30" height="30" src="https://img.icons8.com/external-others-inmotus-design/30/external-Edit-vkontakte-others-inmotus-design.png" alt="external-Edit-vkontakte-others-inmotus-design">
                      </a>
                                               <a href="deletecompany.php?id=1" onclick="return confirm('Are you sure?')" title="Delete" class="text-secondary font-weight-bold text-xs"><img width="30" height="30" src="https://img.icons8.com/fluency/30/cancel.png" alt="cancel"></a>
                     
                                              </td>
                                           
                  </tr>
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
</body>
</html>