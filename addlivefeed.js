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
});