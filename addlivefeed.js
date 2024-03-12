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
});