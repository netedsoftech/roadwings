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

?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Data</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="css_demo/daterangepicker.css" />
      <script type="text/javascript" src="js_demo/daterangepicker.js"></script>

<section class="main">
      <div class="container-fluid">
        <div class="row">
             <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
          <?php include("topHeader.php");?>
          <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Load Data</h5>
</div>

<div class="row mt-4 ">
              <div class="col-lg-8">
                <div class="main-header p-3 ">
                  <form method="post">
                    <h5 class="mt-2 mb-5">Add Load Data Details</h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="from" type="text" placeholder="From *" required>
                      </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group mb-4 ">
                        <input class="form-control" name="to" type="text" placeholder="To *" required>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input id="startDate" class="form-control icons_search_input click"  name="sDate" type="text" placeholder="Start Date *" required>
                      </div>
                    </div>

                   
                    <div class="col-md-3">
                    
                    <div class="form-group mb-4 ">
                        <input id="endDate" class="form-control icons_search_input click" name="deliveryDate" type="text" placeholder="Delivery Date *" required>
                      </div>
                    </div>

                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <select class="form-control"> 
                            <option >Truck Type</option>
                            <option value="Dry Van 53">Dry Van 53'</option>
                            <option value="Flatbed 48">Flatbed 48'</option>
                            <option value="Flatbed 53">Flatbed 53'</option>
                            <option value="Stepdeck 53">Stepdeck 53'</option>
                            <option value="Straight Box Truck 26">Straight Box Truck 26'</option>
                            <option value="Conestoga, Reefer 53">Conestoga, Reefer 53'</option>
                            <option value="Flatbed Hotshot">Flatbed Hotshot</option>
                            <option value="Lowboy, Power Only">Lowboy, Power Only</option>
                            <option value="Van Hazmat">Van Hazmat</option>
                            <option value="Reefer Hazmat"> Reefer Hazmat</option>
                            <option value="RGN">RGN</option>
                            <option value="Container">Container</option>
                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="length" type="text" placeholder="Length">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="weight" type="text" placeholder="Weight">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="commodity" type="text" placeholder="Commodity (goods)">
                      </div>

                    </div>

                  

                    <div class="col-md-4 d-none">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="dat rate" type="text" placeholder="dat rate" hidden>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="customer rate" type="text" placeholder="Customer Rate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="carrier rate" type="tel" placeholder="Carrier Rate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <textarea class="form-control" name="" id="notes" placeholder="Notes " cols="30" rows="4"></textarea>
                      </div>

                    </div>

                    <!-- <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div> -->
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 form-item mt-4">
                        <button name="addcompany" class="btn ">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>
              </div>
              
              
<div class="col-lg-4">
                  <div class="main-header ">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Logistic Company</h6>
                  </div>
                  <div class="card-body p-3">
                    <div class="text-center">
                    <img width="100" height="100" src="https://img.icons8.com/color/100/circled-user-male-skin-type-7--v1.png" alt="circled-user-male-skin-type-7--v1"/>
                      <p>Susheel Jamwal</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                      <div>
                       <small class="text-black"> Credit Limit: <span class="text-success"> $2000 </span></small><br><br>
                       <small class="text-black"> Left  Limit: <span class="text-success"> $1500 </span></small><br><br>
                       <small class="mt-3"> Total business: <span class="text-success"> $200 </span></small>
                      </div>
                      <div>
                        <small class="text-black">Used  Limit: <span class="text-danger"> $500</span></small><br><br>
                       <small class="text-black"> Paid Amount: <span class="text-success">  $200 </span></small><br><br>
                       <small class="mt-3"> Agent Name: <span class="text-black"> Rohan </span></small>
                      </div>
                    </div>
                    <div class="mt-3">
                  
                    </div>
                  </div>
                </div>
              </div>             </div>

</div>
</div>
</div>
</section>


<script>
    $(function() {
        //   $("#range").daterangepicker({
        //     autoUpdateInput: false,
        //     autoApply: true,
        //     minDate: new Date(),
        //     locale: {
        //       cancelLabel: "Clear",
        //     },
        //   });
        //   $("#range").on("apply.daterangepicker", function(ev, picker) {
        //     $(this).val(picker.startDate.format("YYYY/MM/DD") + " - " + picker.endDate.format("YYYY/MM/DD"));
        //   });
        //   $("#range").on("cancel.daterangepicker", function(ev, picker) {
        //     $(this).val("");
        //   });
         });
        $("#startDate").daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: true,
            minDate: new Date(),
          },
          (from_date) => {
            $("#startDate").val(from_date.format("YYYY/MM/DD"));
          });

          $("#endDate").daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: true,
            minDate: new Date(),
          },
          (from_date) => {
            $("#endDate").val(from_date.format("YYYY/MM/DD"));
          });
</script>

<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>