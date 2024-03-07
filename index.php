<?php
session_start();
//session_destroy();
//echo "<pre>"; print_r($_SESSION);die;
  if(!($_SESSION)){
    header("location: login_page.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/style.css" />

    <!-- font style start -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,300&family=Prata&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- font style end -->
  </head>
  <body>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
             <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Recent Shipments</h5>
              <span class="rounded-pill shadow text-white">Assembly</span>
             </div>

             <div class="row mt-4 ">
              <div class="col-lg-9">
                <div class="main-header p-3 ">
                  <form>
                    <h5 class="mt-2 mb-5">Edit Company Details</h5>
                   <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6>
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Company Name <sub>*</sub></label>
                        <input class="form-control" type="text" placeholder="Morissette PLC" >
                      </div>

                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Manager Name <sub>*</sub></label>
                        <input class="form-control" type="text" placeholder="XYZ Limited" >
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Company E-mail ID <sub>*</sub></label>
                        <input class="form-control" type="email" placeholder="hudson.wilhelmine@boehm.com" >
                      </div>

                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
                        <input class="form-control" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686" >
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Company Full Address <sub>*</sub></label>
                        <input class="form-control" type="text" placeholder="93229 Carli Points" >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">Postal Code</label>
                        <input class="form-control" type="text" placeholder="84073" >
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">City</label>
                        <input class="form-control" type="text" placeholder="Port Danielafort" >
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label for="example-text-input" class="form-control-label mb-2">State</label>
                        <input class="form-control" type="text" placeholder="Port Danielafort" >
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
                        <input class="form-control" type="tel" minlength="2" maxlength="4" placeholder="2000 USD" >
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
              <div class="col-lg-3">
                <div class="left-content rounded">
                
                  <h4 class="text-white">Smart Shipment</h4>
                  <p class="text-white">Let plan your shipment to save cost</p>
                  <a href="#" class="btn text-white">Tell me more!</a>
              </div>

              <div class="scrollbar-main mt-3">
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
              </div>

              <div class="msgBox form-group mt-3">
                <textarea class="form-control" placeholder="Live Feed" name="" id="" cols="30" rows="5"></textarea>
                <input type="submit" class="btn form-control mt-2">
              </div>
              </div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

