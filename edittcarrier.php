<?php 
session_start();
include("header.php");
require_once "config.php";
require_once "function.php";
if(!($_SESSION)){
    header("location: login_page.php");
  }

$id = $_GET['id'];


//echo "<pre>"; print_r($getCompany);die;
if(isset($_POST["editcarrier"])){
  //echo "<pre>"; print_r($id); die;
  $tname = $_POST['tname'];
  $temail = $_POST['temail'];
  $tphoneno = $_POST['tphoneno'];
  $taddress = $_POST['taddress'];
  $tmcno = $_POST['tmcno'];
  $lane = $_POST['lane'];
  $carrierpaymentterm = $_POST['carrierpaymentterm'];
  
  $updatecarrier = updateCarrier($mysqli,$tname,$id,$temail,$tphoneno,$taddress,$tmcno,$lane,$carrierpaymentterm);
  $message = "";
  $error =  "";
    if ($updatecarrier) {
        $message = "Carrier updated successfully";
    } else {
        // Insertion failed
        $error = "Failed to update carrier.";
    }
}

$getcarrier = getcarrier($mysqli,$id);
//echo "<pre>"; print_r($getcarrier); die;
 
?>
<title>Edit Carrier</title>
  <body>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
        <?php  
           include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
            <?php include("topHeader.php");?>
             <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Edit Carrier Details</h5>
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
              <?php if(!empty($error)){
                ?>
                <script>
                 Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "<?php echo $error?>",
                  showConfirmButton: false,
                  timer: 1500
                });
                </script>
              <?php
                echo $error;
              }?>
              <span class="rounded-pill shadow text-white">Assembly</span>
             </div>

             <div class="row mt-4 ">
              <div class="col-lg-9">
               <div class="main-header p-3 ">
                  <form method="post">
                    <h5 class="mt-2 mb-5"></h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <label for="tname">Trucker Name *</label>
                        <input class="form-control" name="tname" type="text" value="<?php echo $getcarrier[0]['tname']?>" required="">
                      </div>

                      <div class="form-group mb-4 ">
                        <label for="temail">E-mail ID *</label>
                        <input class="form-control" name="temail" type="email" value="<?php echo $getcarrier[0]['temail']?>" required="">
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <label for="tphoneno">Contact Number *</label>
                        <input class="form-control" required name="tphoneno" type="tel" minlength="12" value="<?php echo $getcarrier[0]['tphoneno']?>" maxlength="12" >
                      </div>

                      <div class="form-group mb-4 ">
                        <label for="taddress">Address *</label>
                        <input class="form-control" required name="taddress" type="text" value="<?php echo $getcarrier[0]['taddress']?>"  >
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <label for="tmcno">MC Number</label>
                        <input class="form-control" required name="tmcno" type="text" value="<?php echo $getcarrier[0]['tmcno']?>" >
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <label for="loadcarrierpaymentdate">Carrier Payment Date</label>
                        <input class="form-control" equired name="lane" type="text" value="<?php echo $getcarrier[0]['lane']?>" placeholder="Lane">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                             <select name="carrierpaymentterm"  class="form-control">
                          <?php if($getcarrier[0]['carrierpaymentterm']){
                            ?>
                            <option value="<?php echo $getcarrier[0]['carrierpaymentterm']?>"><?php echo $getcarrier[0]['carrierpaymentterm']?></option>
                            <?php
                          }?>
                          <option  >Payment Terms ( 1 - 50 days)</option>
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
                         
                        </select>
                      </div>

                    </div>


                     <div class="col-md-4">
                      
                    </div>

                   <!--  <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="phoneno" type="text" placeholder="PHONE NUMBER:">
                      </div>

                    </div> -->

                    


                    <div class="col-md-4">
                     

                    </div>

                     <div class="col-md-4">
                      
                    </div> 

                   <div class="col-md-4">
                      
                    </div>


                    <div class="col-md-4">
                     
                    </div>


                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 form-item mt-4">
                        <button name="editcarrier" class="btn ">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>
              </div>
              
              <?php include("rightbar.php");?>
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

