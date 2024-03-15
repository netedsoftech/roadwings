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
      @media (max-width:1300px){
        .text-th {
  font-size: 8px!important;
}
      }

      @media (min-width:1400){
        .text-th {
  font-size: 11px!important;
}
      }

      .form-group > h6{
        font-size:14px;
      }
    </style>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content">
             <!-- <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Recent Shipments</h5>
              <span class="rounded-pill shadow text-white">Assembly</span>
             </div> -->

             <div class="row mt-4">
              <div class="col-lg-9">
              <div class="row main-header pt-4 mx-1">
              <div class="col-md-3">
                <div class="form-group mb-4">
                  <h6>Company Name</h6>
                 <p class="text-xs">Morissette PLC</p>
                </div>

                <div class="form-group mb-4">
                <h6>Contact Name</h6>
                 <p class="text-xs">XYZ Limited</p>
                
                </div><div class="form-group mb-4">
                  <h6>Company Status</h6>
                 <p class="text-xs">Working</p>
                </div>
                

               
              </div>

              <div class="col-md-3">
                

                <div class="form-group mb-4">
                  <h6>Contact Number</h6>
                 <p class="text-xs">+1 (323) 916-4686</p>
                </div>

                <div class="form-group mb-4">
                  <h6>City</h6>
                 <p class="text-xs">Port Danielafort</p>
                </div>
    
                <div class="form-group mb-4">
                  <h6>Payment Terms</h6>
                 <p class="text-xs">15 days</p>
                </div>
              </div>
              <!-- <span class="aside-hr mt-3 mb-4"></span> -->
              
              <div class="col-md-3">
                <div class="form-group mb-4">
                <h6>Company Full Address</h6>
                 <p class="text-xs">93229 Carli Points</p>
                </div>
                <div class="form-group mb-4">
                  <h6>State</h6>
                 <p class="text-xs">Port Danielafort</p>
                </div>
                <div class="form-group mb-4">
                  <h6>Limit Assign</h6>
                 <p class="text-xs">2000 USD</p>
                </div>

              </div>

              <div class="col-md-3">
                <div class="form-group mb-4">
                  <h6>Postal Code</h6>
                 <p class="text-xs">84073</p>
                </div>
                <div class="form-group mb-4">
                <h6>Company E-mail ID</h6>
                 <p class="text-xs">hudson.wilhelmine@boehm.com</p>
                </div>

              </div>
             </div>
            </div>
            <div class="col-lg-3 main-header pt-3">
            <h6>Company Payment Status</h6>
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


<script src="addlivefeed.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
