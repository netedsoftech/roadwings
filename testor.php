<div class="main-header p-3 ">
                  <form method="post">
                    <h5 class="mt-2 mb-5"></h5>
                   <!-- <h6 class="mt-2 mb-4">COMPANY INFORMATION</h6> -->
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <input class="form-control" name="tname" type="text" placeholder="Trucker Name *" value="<?php echo $getcarrier[0]['tname']?>" required="">
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" name="temail" type="email" placeholder="E-mail ID *" value="<?php echo $getcarrier[0]['temail']?>" required="">
                      </div>

                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="tphoneno" type="tel" minlength="12" value="<?php echo $getcarrier[0]['tphoneno']?>" maxlength="12" placeholder="Contact Number *">
                      </div>

                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="taddress" type="text" value="<?php echo $getcarrier[0]['taddress']?>"  placeholder="Address *">
                      </div>
                    </div>
                    <span class="aside-hr mt-3 mb-4"></span>
                    
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" required name="tmcno" type="text" value="<?php echo $getcarrier[0]['tmcno']?>" placeholder="MC Number">
                      </div>

                    </div>

                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                        <input class="form-control" equired name="lane" type="text" value="<?php echo $getcarrier[0]['lane']?>" placeholder="State">
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-4 ">
                             <select name="paymentterm"  class="form-control">
                          <?php if($getcarrier[0]['paymentterm']){
                            ?>
                            <option value="<?php echo $getcarrier[0]['paymentterm']?>"><?php echo $getcarrier[0]['paymentterm']?></option>
                            <?php
                          }?>
                          <option >Payment Terms ( 1 - 50 days)</option>
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
                        <button name="editcompany" class="btn ">Submit Details</button>
                      </div>
                    </div>
                   </div>
                  </form>
                 </div>