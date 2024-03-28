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
          alert(companyId);
          // Send AJAX request to retrieve data
          $.ajax({
              type: 'POST',
              url: 'get_company_data.php', // Replace 'get_company_data.php' with your PHP file to handle the request
              data: { id: companyId },
              dataType: 'json',
              success: function(data){
                  // Handle the data returned from the server
                  // You can populate your modal or perform other actions here
                  console.log(data);
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
                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="mt-2" id="staticBackdropLabel1">Edit Agent Details</h5>
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
            
            // Append the modal content to a container or display it directly
            $('.abc').html(modalContent);
            
            // Show the modal
            $('#staticBackdrop1').modal('show');
        },
        error: function(xhr, status, error){
            // Handle errors
            console.error(xhr.responseText);
        }
    });
});



});