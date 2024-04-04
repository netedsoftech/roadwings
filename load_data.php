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
              <h5 class="text-break">Load Data</h5>
</div>

<div class="row mt-4 ">
              <div class="col-lg-8">
                 <!-- Company form start -->
                <div class="main-header p-3" id="companyFormContainer">
                  <form id="companyForm" method="post" onsubmit="return submitCompanyForm()">
                    <h5 class="mt-2 mb-5">Add Load </h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input class="form-control" id="fromInput" name="from" type="text" placeholder="From *" required>
                      </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group mb-4 ">
                        <input class="form-control" id="toInput" name="to" type="text" placeholder="To *" required>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input id="startDate" class="form-control icons_search_input click"  name="sDate" type="text" placeholder="Start Date *" required autocomplete="off">
                      </div>
                    </div>

                   
                    <div class="col-md-3">
                    
                    <div class="form-group mb-4 ">
                        <input id="endDate" class="form-control icons_search_input click" name="deliveryDate" type="text" placeholder="Delivery Date *" required autocomplete="off">
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
                        <input class="form-control" id="lengthInput" required name="length" type="text" placeholder="Length">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" id="weightInput" required name="weight" type="text" placeholder="Weight">
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
                        <input class="form-control" required id="customerrateInput" name="customer rate" type="text" placeholder="Customer Rate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required id="carrierrrateInput" name="carrier rate" type="tel" placeholder="Carrier Rate">
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
                    <div class="form-group mb-4 form-item mt-4" id="submitCompanyFormBtnContainer">
                        <button name="addcompany" class="btn">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>

                 <!-- Company form end -->
                 <!-- Trucker form start -->
                 <div class="main-header p-3" id="truckerFormContainer" style="display: none;">
                  <form method="post">
                    <h5 class="mt-2 mb-5">Add Carrier </h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="from" id="fromInputSecond" type="text" placeholder="From *" required readonly value="">
                      </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group mb-4 ">
                        <input class="form-control" name="to" id="toInputSecond" type="text" placeholder="To *" required readonly value="">
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group mb-4 ">
                        <input id="sDateInputSecond" class="form-control icons_search_input click"  name="sDate" type="text" placeholder="Start Date *" required readonly value="">
                      </div>
                    </div>

                   
                    <div class="col-md-3">
                    
                    <div class="form-group mb-4 ">
                        <input id="deliveryDateInputSecond" class="form-control icons_search_input click" name="deliveryDate" type="text" placeholder="Delivery Date *" required readonly value="">
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
                        <input id="lengthInputSecond" class="form-control" required name="length" type="text" placeholder="Length" readonly value="">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input id="weightInputSecond" class="form-control" required name="weight" type="text" placeholder="Weight" readonly value="">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input  class="form-control" required name="commodity" type="text" placeholder="Commodity (goods)" readonly value="">
                      </div>

                    </div>

                  

                    <div class="col-md-4 d-none">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="dat rate" type="text" placeholder="dat rate" hidden>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input id="customerInputSecond" class="form-control" required name="customer rate" type="text" placeholder="Customer Rate" readonly value="">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input  id="carrierInputSecond" class="form-control" required name="carrier rate" type="tel" placeholder="Carrier Rate" readonly value="">
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
                        <button id="showCompanyFormBtn" class="btn">Edit First form?</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>
                 <!-- Trucker form end -->

                              <!-- Table start -->
             <div class="table-responsive p-0 mt-3 main-header main-three p-3">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                      <th class="text-start text-uppercase text-th sorting_disabled"> Order ID</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Name</th>
                      <th class="text-start text-uppercase text-th sorting_disabled"> E-mail ID</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Contact NUmber</th>
                      <th class="text-start text-uppercase text-th sorting_disabled">Action</th>
                      
                  

                     <?php if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER"): ?>
                     
                    <!-- <th class="text-secondary "></th> -->
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
                            <a title="Load Data" href="load_data.php" class="mb-0 text-xs" ><?php echo ucfirst($row['companyname']); ?></a>
                            
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
          <!-- Table end -->
          <script type="text/javascript">
    $(document).ready(function () {
        $('.table').DataTable({
            "ordering": false // Disable sorting
        });
    });
</script>
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
                       <small class="text-black"> Credit Limit: <span class="text-success fs-5"> $2000 </span></small><br><br>
                       <small class="text-black"> Left  Limit: <span class="text-success fs-5"> $1500 </span></small><br><br>
                       <small class="mt-3"> Total business: <span class="text-success fs-5"> $200 </span></small>
                      </div>
                      <div>
                        <small class="text-black">Used  Limit: <span class="text-danger fs-5"> $500</span></small><br><br>
                       <small class="text-black"> Paid Amount: <span class="text-success fs-5">  $200 </span></small><br><br>
                       <small class="mt-3"> Agent Name: <span class="text-black"> Rohan </span></small>
                      </div>
                    </div>
                    <div class="mt-3">
                  
                    </div>
                  </div>
                </div>
              </div>    


         </div>

</div>
</div>
</div>

</section>
  
<script>
  // Function to submit the company form
  function submitCompanyForm() {
    var allFieldsFilled = true;
    var companyForm = document.getElementById("companyForm");
    var inputs = companyForm.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].hasAttribute("required") && inputs[i].value.trim() === "") {
        allFieldsFilled = false;
        break;
      }
    }

    if (allFieldsFilled) {
      document.getElementById("companyFormContainer").style.display = "none";
      document.getElementById("truckerFormContainer").style.display = "block";

      var fromValue = document.getElementById("fromInput").value;
        var toValue = document.getElementById("toInput").value;
        var startValue = document.getElementById("startDate").value;
        var endValue = document.getElementById("endDate").value;
        var lengthValue = document.getElementById("lengthInput").value;
        var weigthValue = document.getElementById("weightInput").value;
        var customerValue = document.getElementById("customerrateInput").value;
        var carrierValue = document.getElementById("carrierrrateInput").value;
        // Retrieve corresponding fields in the second form
        var fromInputSecond = document.getElementById("fromInputSecond");
        var toInputSecond = document.getElementById("toInputSecond");
        var sDateInputSecond = document.getElementById("sDateInputSecond");
        var deliveryDateInputSecond = document.getElementById("deliveryDateInputSecond");
        var lengthInputSecond = document.getElementById("lengthInputSecond");
        var weightInputSecond = document.getElementById("weightInputSecond");
        var customerInputSecond = document.getElementById("customerInputSecond");
        var carrierInputSecond = document.getElementById("carrierInputSecond");
        // Set values in the second form
        fromInputSecond.value = fromValue; 
        toInputSecond.value = toValue;
        sDateInputSecond.value = startValue;
        deliveryDateInputSecond.value = endValue;
        lengthInputSecond.value = lengthValue;
        weightInputSecond.value = weigthValue;
        customerInputSecond.value = customerValue;
        carrierInputSecond.value = carrierValue;
    }

    return false;


        // Display the second form
  }

   // Function to submit the trucker form
   function submitTruckerForm() {
        // Submit the form as usual
        // Retrieve form values
        var fromValue = document.getElementById("fromInput").value;
        var toValue = document.getElementById("toInput").value;
        var startValue = document.getElementById("startDate").value;
        var endValue = document.getElementById("endDate").value;
        var lengthValue = document.getElementById("lengthInput").value;
        var weigthValue = document.getElementById("weightInput").value;
        var customerValue = document.getElementById("customerrateInput").value;
        var carrierValue = document.getElementById("carrierrrateInput").value;
        // Retrieve corresponding fields in the second form
        var fromInputSecond = document.getElementById("fromInputSecond");
        var toInputSecond = document.getElementById("toInputSecond");
        var sDateInputSecond = document.getElementById("sDateInputSecond");
        var deliveryDateInputSecond = document.getElementById("deliveryDateInputSecond");
        var lengthInputSecond = document.getElementById("lengthInputSecond");
        var weightInputSecond = document.getElementById("weightInputSecond");
        var customerInputSecond = document.getElementById("customerInputSecond");
        var carrierInputSecond = document.getElementById("carrierInputSecond");
        // Add more variables for other form fields as needed
        // Display form values in table
        displayFormValues(fromValue, toValue, startValue, endValue , lengthValue , weigthValue , customerValue , carrierValue ,fromInputSecond, toInputSecond , sDateInputSecond, deliveryDateInputSecond, lengthInputSecond, weightInputSecond, customerInputSecond ,carrierInputSecond);
        // Show the table
        document.getElementById("formValuesTable").style.display = "block";
        return false;
    }

    // Function to display form values in table
    function displayFormValues(from, to) {
        var tableBody = document.getElementById("formValuesBody");
        // Clear previous values
        tableBody.innerHTML = "";
        // Append new values
        appendRowToTable("From", fromValue, tableBody);
        appendRowToTable("To", toValue, tableBody);
        appendRowToTable("Start Date", startValue, tableBody);
        appendRowToTable("End Date", endValue, tableBody);
        appendRowToTable("Length", lengthValue, tableBody);
        appendRowToTable("Weigth", weigthValue, tableBody);
        appendRowToTable("Customer", customerValue, tableBody);
        appendRowToTable("Carrier", carrierValue, tableBody);
        appendRowToTable("From Trucker", fromInputSecond, tableBody);
        appendRowToTable("To Trucker", toInputSecond, tableBody);
        appendRowToTable("Start Date Trucker", sDateInputSecond, tableBody);
        appendRowToTable("End Date Trucker", deliveryDateInputSecond, tableBody);
        appendRowToTable("Length Trucker", lengthInputSecond, tableBody);
        appendRowToTable("Weigth Trucker", weightInputSecond, tableBody);
        appendRowToTable("Customer Trucker", customerInputSecond, tableBody);
        appendRowToTable("Carrier Trucker", carrierInputSecond, tableBody);
        // Add more rows for other form fields as needed
    }

    // Function to append a row to the table
    function appendRowToTable(field, value, tableBody) {
        var row = document.createElement("tr");
        var fieldCell = document.createElement("td");
        var valueCell = document.createElement("td");
        fieldCell.textContent = field;
        valueCell.textContent = value;
        row.appendChild(fieldCell);
        row.appendChild(valueCell);
        tableBody.appendChild(row);
    }

  document.getElementById("showCompanyFormBtn").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("companyFormContainer").style.display = "block";
    document.getElementById("truckerFormContainer").style.display = "none";
  });
</script>




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
</body>
</html>