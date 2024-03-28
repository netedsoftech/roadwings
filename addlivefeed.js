$(document).ready(function(){
    $('#livefeed').click(function(e){
        alert("here");
        e.preventDefault();
        
        // Gather form data
        var formData = {
            'textvalue': $('#feedtextarea').val(),
            'addedby': $("").val(),
            // Add more fields as needed
        };
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'insert.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(data){
                // Handle success
                if(data.success){
                    // Update live website
                    $('#insertedData').append('<p>' + data.message + '</p>');
                    // Clear form fields
                    $('#name').val('');
                    $('#email').val('');
                    // Add more fields as needed
                } else {
                    // Handle errors
                    console.log(data.message);
                }
            },
            error: function(xhr, status, error){
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });

    $('.editlink').click(function(e){
          e.preventDefault();
          
          // Retrieve the ID from the 'atrid' attribute
          var companyId = $(this).attr('atrid');
          //alert(companyId);
          // Send AJAX request to retrieve data
          $.ajax({
              type: 'POST',
              url: 'get_company_data.php', // Replace 'get_company_data.php' with your PHP file to handle the request
              data: { companyId: companyId },
              dataType: 'json',
              success: function(data){
                  // Handle the data returned from the server
                  // You can populate your modal or perform other actions here
                  console.log(data);
                  var content = `<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                  <input class="form-control" type="text" name="comapnyname" value="${data.comapnyname}" placeholder="Morissette PLC">
                </div>

                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Contact Name <sub>*</sub></label>
                  <input class="form-control" type="text" value="${data.companymanagername}" name="companymanagername" placeholder="XYZ Limited">
                </div>

               
              </div>

              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Company E-mail ID <sub>*</sub></label>
                  <input class="form-control" type="email" value="${data.companyemailid}" name="companyemailid" placeholder="hudson.wilhelmine@boehm.com">
                </div>

                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
                  <input class="form-control" type="tel" value="${data.companycontactno}" name="companycontactno" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686">
                </div>
              </div>
              <span class="aside-hr mt-3 mb-4"></span>
              
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Company Full Address <sub>*</sub></label>
                  <input class="form-control" value="${data.companyaddress}" name="companyaddress" type="text" placeholder="93229 Carli Points">
                </div>

              </div>

              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">Postal Code</label>
                  <input class="form-control" value="${data.companypostalcode}" name="companypostalcode" type="text" placeholder="84073">
                </div>

              </div>
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">City</label>
                  <input class="form-control" value="${data.companycity}" name="companycity" type="text" placeholder="Port Danielafort">
                </div>

              </div>


               <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="example-text-input" class="form-control-label mb-2">State</label>
                  <input class="form-control" value="${data.companystate}" name="companystate" type="text" placeholder="Port Danielafort">
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
                  <input class="form-control" name="" value="${data.comapnyname}" type="tel" minlength="2" maxlength="4" placeholder="2000 USD">
                </div>
              </div>


              <div class="col-lg-4"></div>
              <div class="col-lg-4 text-end">
                <div class="form-group mb-4 mt-4">
                  <button name="update" class="btn ">Submit Details</button>
                </div>
              </div>
             </div>
            </form>
          </div>
         
        </div>
      </div>
    </div>`;
            $('#staticBackdrop').remove();
            
            // Append the modal content to the body
            $('body').append(content);
            
            // Show the modal
            //$('#staticBackdrop').modal('show');
            
              },
              error: function(xhr, status, error){
                  // Handle errors
                  console.error(xhr.responseText);
              }
          });
        });

    $('.getagents').click(function(e){
    e.preventDefault();
    
    // Retrieve the ID from the 'atrid' attribute
    var agentId = $(this).attr('atrid');
    
    // Send AJAX request to retrieve data
    $.ajax({
        type: 'POST',
        url: 'get_agents_data.php',
        data: { agentId: agentId },
        dataType: 'json',
        success: function(data){
            // Handle the data returned from the server
            console.log("Data:", data);

            // Generate HTML content for the modal dynamically
            var modalContent = `
                <div class="modal fade" id="dynamicBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dynamicBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="mt-2" id="dynamicBackdropLabel">Edit Agent Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <h6 class="mt-2 mb-4">Agent Information</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <input name="agentname" required class="form-control" type="text" placeholder="Agent Name *" value="${data.agentname}">
                                            </div>
                                            <!-- Add other input fields here and populate them with data -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <input required class="form-control" name="agentphoneno" type="tel" minlength="10" maxlength="10" placeholder="Contact Number *" value="${data.agentphoneno}">
                                            </div>
                                            <div class="form-group mb-4">
                                                <select name="agentrole" class="form-control">
                                                    
                                                    <option value="${data.agentrole}">${data.agentrole}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-4">
                                                <input required class="form-control" name="email" type="email" placeholder="Agent E-mail ID *" value="${data.email}">
                                            </div>
                                            <div class="form-group mb-4 ">
                                                <select name="department" class="form-control">
                                                    
                                                    <option value="${data.department}">${data.department}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6"></div>
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-4 text-end">
                                        <div class="form-group">
                                        <input type="hidden" name="agentid" value="${data.id}">
                                            <button type="submit" name="update" class="btn btn-success">Update Info</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Remove any existing dynamic backdrop modals
            $('#dynamicBackdrop').remove();
            
            // Append the modal content to the body
            $('body').append(modalContent);
            
            // Show the modal
            $('#dynamicBackdrop').modal('show');
        },
        error: function(xhr, status, error){
            // Handle errors
            console.error(xhr.responseText);
        }
    });
});



});