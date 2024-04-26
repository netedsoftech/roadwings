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
if(isset($_POST["editload"])){
  //echo "<pre>"; print_r($_POST); die;
  $locationfrom = $_POST['locationfrom'];
  $locationto = $_POST['locationto'];
  $startdate = $_POST['startdate'];
  $deliverydate = $_POST['deliverydate'];
  $trucktype = $_POST['trucktype'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];
  $commodity = $_POST['commodity'];
  $customerrate = $_POST['customerrate'];
  $carrierrate = $_POST['carrierrate'];
  $notes = $_POST['notes'];
  $truckerNo = $_POST['truckerNo'];
  $truckerEmail = $_POST['truckerEmail'];
  $truckerAddress = $_POST['truckerAddress'];
  $status = $_POST['status'];
  $updateLoad = updateLoad($mysqli,$locationfrom,$locationto,$startdate,$deliverydate,$trucktype,$length,$weight,$commodity,$customerrate,$carrierrate,$notes,$truckerNo,$truckerEmail,$truckerAddress,$id,$status);
  $message = "";
  $error =  "";
    if ($updateLoad == "updated") {
        $message = "Load updated successfully";
    } else {
        // Insertion failed
        $error = "Failed to update load.";
    }
}

$getEditLoad = getEditLoad($mysqli,$id);
//echo "<pre>"; print_r($getEditLoad); die;
 
?>
<title>Add Customer</title>
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
              <h5 class="text-break">Edit Load Details</h5>
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
                  icon: "error",
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
                        <input class="form-control" name="locationfrom" type="text" placeholder="From *" value="<?php echo $getEditLoad[0]['locationfrom']?>" required >
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" name="locationto" type="text" placeholder="To *" value="<?php echo $getEditLoad[0]['locationto']?>" required>
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="startdate" type="date" placeholder="Start Date *" value="<?php echo $getEditLoad[0]['startdate']?>" required>
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="deliverydate" type="date" minlength="12" value="<?php echo $getEditLoad[0]['deliverydate']?>" maxlength="12" placeholder="Delivery Date*">
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="trucktype" type="text" value="<?php echo $getEditLoad[0]['trucktype']?>"  placeholder="Truck Type *">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="length" type="text" value="<?php echo $getEditLoad[0]['length']?>" placeholder="Length">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="weight" type="text" value="<?php echo $getEditLoad[0]['weight']?>" placeholder="weight">
                      </div>

                    </div>


                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="commodity" type="text" value="<?php echo $getEditLoad[0]['commodity']?>" placeholder="commodity">
                      </div>

                    </div>

                   <!--  <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="phoneno" type="text" placeholder="PHONE NUMBER:">
                      </div>

                    </div> -->

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="customerrate" type="text" value="<?php echo $getEditLoad[0]['customerrate']?>" placeholder="Mcustomerrate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="carrierrate" value="<?php echo $getEditLoad[0]['carrierrate']?>" type="text" placeholder="carrierrate">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="notes" value="<?php echo $getEditLoad[0]['notes']?>" type="text" placeholder="notes">
                      </div>

                    </div>


                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="truckerNo" value="<?php echo $getEditLoad[0]['truckerNo']?>" type="text" placeholder="Trucker Phone No.">
                      </div>

                    </div>

                     <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="truckerEmail" value="<?php echo $getEditLoad[0]['truckerEmail']?>" type="text" placeholder="Trucker Email.">

                      </div>
                    </div> 

                   <div class="col-md-4">
                      <div class="form-group mb-4 ">
                         <input class="form-control" required name="truckerAddress" value="<?php echo $getEditLoad[0]['truckerAddress']?>" type="text" placeholder="Trucker Address.">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                         <select name="status" class="form-control">
                            <option value="">Please Select Status </option>
                            <option value="0">Pending </option>
                            <option value="1">Paid </option>
                         </select>
                      </div>
                    </div>


                   


                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                      <div class="form-group mb-4 form-item mt-4">
                        <button name="editload" class="btn ">Submit Details</button>
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

