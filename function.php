<?php
// Function to authenticate user login
function authenticateUser($mysqli, $username, $password) {
    // Define variables and initialize with empty values
    $username_err = $password_err = "";

    // Check if username is empty
    if(empty(trim($username))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($username);
    }

    // Check if password is empty
    if(empty(trim($password))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($password);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password,agentrole FROM login WHERE email = '$username'";

        $result = $mysqli->query($sql);

        if($result){
            // Check if username exists, if yes then verify password
            if($result->num_rows == 1){

                $row = $result->fetch_assoc();
                
                if (password_verify($password, $row['password'])) {
                    // Password is correct, start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["agentrole"] = $row['agentrole'];

                    // Redirect user to welcome page
                    header("location: index.php");
                    exit;
                } else{
                    // Password is not valid, display a generic error message
                    return "Invalid username or password.";
                }
            } else{
                // Username doesn't exist, display a generic error message
                return "Invalid username or password.";
            }
        } else{
            return "Oops! Something went wrong. Please try again later.";
        }
    }
}

function duplicateAgentEmail($mysqli, $email){
    $escaped_email = mysqli_real_escape_string($mysqli, $email);
    $checkDuplicateEmail = "SELECT email FROM login WHERE email = '$escaped_email'";
    $result = $mysqli->query($checkDuplicateEmail);
    
    // Check for query execution errors
    if (!$result) {
        // If there's an error, return an error message or handle it appropriately
        return "Error: " . $mysqli->error;
    }
    
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        
        // Duplicate email found
        return true;
    } else {
        
        // No duplicate email found
        return false;
    }
}

function insertData($mysqli, $agentname, $email, $department,$agentphoneno,$agentrole,$date) {
    // Hash the password
    //$password_hash = password_hash($password, PASSWORD_DEFAULT); 

    if (duplicateAgentEmail($mysqli, $email)) {
        
        return "This email is already in use. Please choose a different email.";
    } else {
        //die("else");
        // Construct the SQL query
        $sql = "INSERT INTO login (agentname, email, department,agentphoneno,agentrole,createdat) VALUES ('$agentname', '$email', '$department','$agentphoneno','$agentrole','".$date."')";
        
        // Execute the query
        if ($mysqli->query($sql) === TRUE) {
            require 'PHPMailer/PHPMailerAutoload.php';
                $fromName = "Road Wings Logistic";
                $toName = $email;
                $fromEmailAddress = "support@bookviaus.com";
                $recipient = $email;
                $subject = "Create Password";
                $mail = new PHPMailer;
                 $mail->body = ' <style type="text/css">#outlook a {
        padding:0;
    }
    .ExternalClass {
        width:100%;
    }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
        line-height:100%;
    }
    .es-button {
        mso-style-priority:100!important;
        text-decoration:none!important;
    }
    a[x-apple-data-detectors] {
        color:inherit!important;
        text-decoration:none!important;
        font-size:inherit!important;
        font-family:inherit!important;
        font-weight:inherit!important;
        line-height:inherit!important;
    }
    .es-desk-hidden {
        display:none;
        float:left;
        overflow:hidden;
        width:0;
        max-height:0;
        line-height:0;
        mso-hide:all;
    }
    .es-button-border:hover a.es-button, .es-button-border:hover button.es-button {
        background:#ffffff!important;
    }
    .es-button-border:hover {
        background:#ffffff!important;
        border-style:solid solid solid solid!important;
        border-color:#3d5ca3 #3d5ca3 #3d5ca3 #3d5ca3!important;
    }
    @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:20px!important; text-align:center } h2 { font-size:16px!important; text-align:left } h3 { font-size:20px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:20px!important } h2 a { text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:16px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:10px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:12px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:14px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } }
    @media screen and (max-width:384px) {.mail-message-content { width:414px!important } }</style>';
                $message = '<body style="width:100%;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
      <div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#FAFAFA"><!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="#fafafa"></v:fill>
                </v:background>
            <![endif]-->
       <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
         <tr style="border-collapse:collapse">
          <td valign="top" style="padding:0;Margin:0">
           <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td class="es-adaptive" align="center" style="padding:0;Margin:0">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:10px;Margin:0">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:580px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;display:none"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table cellpadding="0" cellspacing="0" class="es-header" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
             <tr style="border-collapse:collapse">
              <td class="es-adaptive" align="center" style="padding:0;Margin:0">
               <table class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#3d5ca3;width:600px" cellspacing="0" cellpadding="0" bgcolor="#3d5ca3" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-color:#3d5ca3" bgcolor="#3d5ca3" align="left">
                   <table cellspacing="0" cellpadding="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td class="es-m-p0l es-m-txt-c" align="center" style="padding:0;Margin:0;font-size:0px"><a href="https://roadwingslogistics.com/" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#1376C8;font-size:14px"><img src="https://ffyhptr.stripocdn.email/content/guids/9a27bf59-fcf8-499a-8263-d94cc971f987/images/unnamed.gif" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="252"></a></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:40px;background-color:transparent;background-position:left top" bgcolor="transparent" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0"><img src="https://ffyhptr.stripocdn.email/content/guids/CABINET_dd354a98a803b60e2f0411e893c82f56/images/23891556799905703.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="175"></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px"><h1 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333"><strong>CREATE YOUR&nbsp;</strong></h1><h1 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333"><strong>&nbsp;PASSWORD?</strong></h1></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica,helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">HI, Username: '. $email.'</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica,helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">Login Link: https://roadwingslogistics.com/roadwings/login_page.php</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-right:35px;padding-left:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">There was a request to create your password!</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-top:25px;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">If did not make this request, just ignore this email. Otherwise, please click the button below to create your password:</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:40px;padding-bottom:40px"><span class="es-button-border" style="border-style:solid;border-color:#3D5CA3;background:#FFFFFF;border-width:2px;display:inline-block;border-radius:10px;width:auto"><a href="https://roadwingslogistics.com/roadwings/agent_create_password_page.php?email='.$email.'" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#3D5CA3;font-size:14px;display:inline-block;background:#FFFFFF;border-radius:10px;font-family:arial, helvetica neue, helvetica, sans-serif;font-weight:bold;font-style:normal;line-height:17px;width:auto;text-align:center;padding:15px 20px 15px 20px;mso-padding-alt:0;mso-border-alt:10px solid #FFFFFF">CREATE PASSWORD</a></span></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
                 <tr style="border-collapse:collapse">
                  <td style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-top:20px;background-position:center center" align="left"><!--[if mso]><table style="width:580px" cellpadding="0" cellspacing="0"><tr><td style="width:199px" valign="top"><![endif]-->
                   <table class="es-left" cellspacing="0" cellpadding="0" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;width:199px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:center center" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td class="es-m-txt-c" align="right" style="padding:0;Margin:0;padding-top:15px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px"><strong>Follow us:</strong></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table><!--[if mso]></td><td style="width:20px"></td><td style="width:361px" valign="top"><![endif]-->
                   <table class="es-right" cellspacing="0" cellpadding="0" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;width:361px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:center center" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px;font-size:0">
                           <table class="es-table-not-adapt es-social" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                             <tr style="border-collapse:collapse">
                              <td valign="top" align="center" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://www.facebook.com/roadwingslogistic" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/facebook-rounded-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                              <td valign="top" align="center" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://twitter.com/roadwingslogi" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/twitter-rounded-gray.png" alt="Tw" title="Twitter" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                              <td valign="top" align="center" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://www.instagram.com/roadwings.logistics/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/instagram-rounded-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                              <td valign="top" align="center" style="padding:0;Margin:0"><a target="_blank" href="https://www.linkedin.com/in/roadwings-logistics/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/linkedin-rounded-gray.png" alt="In" title="Linkedin" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                             </tr>
                           </table></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table><!--[if mso]></td></tr></table><![endif]--></td>
                 </tr>
                 <tr style="border-collapse:collapse">
                  <td style="Margin:0;padding-top:5px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:left top" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:14px">Contact us: <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px" href="tel:123456789"></a>+1 833 781 8686<a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px" href="tel:123456789"></a> | <a target="_blank" href="mailto:your@mail.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px"></a><a href="mailto:info@roadwingslogistics.com" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px">info@roadwingslogistics.com</a><a target="_blank" href="mailto:your@mail.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px"></a></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-footer" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-footer-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
                 <tr style="border-collapse:collapse">
                  <td style="Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;padding-bottom:30px;background-color:#0b5394;background-position:left top" bgcolor="#0b5394" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><h2 style="Margin:0;line-height:19px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#ffffff"><strong>Have quastions?</strong></h2></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="left" style="padding:0;Margin:0;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#ffffff;font-size:14px">We are here to help, learn more about us <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#ffffff;font-size:14px" href="">here</a></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#ffffff;font-size:14px">or <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#ffffff;font-size:14px" href="">contact us</a><br></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="transparent" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td style="padding:0;Margin:0;padding-top:15px;background-position:left top" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0">
                           <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                             <tr style="border-collapse:collapse">
                              <td style="padding:0;Margin:0;border-bottom:1px solid #fafafa;background:none;height:1px;width:100%;margin:0px"></td>
                             </tr>
                           </table></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-footer" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="transparent" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="Margin:0;padding-bottom:5px;padding-top:15px;padding-left:20px;padding-right:20px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:18px;color:#666666;font-size:12px">This daily newsletter was sent to info@name.com from company name because you subscribed. If you would not like to receive this email <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:12px" class="unsubscribe" href="">unsubscribe here</a>.</p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td align="center" style="padding:0;Margin:0">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;display:none"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
      </div>
     </body>';
                $mail->isHTML(true);
                       
               $mail->isSMTP();
            
               $mail->Debugoutput = 'html';
               
               //Set the hostname of the mail server
               $mail->Host = 'ssl://smtp.gmail.com';
                   
               //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
               $mail->Port = 465;
               //$mail->Port = 465;
                   
               //Set the encryption system to use - ssl (deprecated) or tls
               //$mail->SMTPSecure = 'ssl';
                   
               //Whether to use SMTP authentication
               $mail->SMTPAuth = true;
                   
               //Username to use for SMTP authentication - use full email address for gmail
               $mail->Username = "susheeljamwal@gmail.com";
                   
               //Password to use for SMTP authentication
               $mail->Password = "pktdozoxyjysjajp";
               
                   
               //Set who the message is to be sent from
               $mail->setFrom($fromEmailAddress, $fromName);
                   
                   
               //Set an alternative reply-to address
               //$mail->addReplyTo('replyto@example.com', 'First Last');
               
               //Set who the message is to be sent to
              // $mail->addAddress($toEmailAddress, $toName);
              
                $mail->addAddress($recipient);
            
                   
               //Set who the message is to be copied
               //$mail->AddBCC('', '');
              /* $mail->AddCC($cc, $cc);
               foreach($arrBcc as $bcc)
               {
                   $mail->AddBCC($bcc, $bcc);
               }  */ 
               //Set the subject line
               $mail->Subject = $subject;
                   
                   
               //Read an HTML message body from an external file, convert referenced images to embedded,
               //convert HTML into a basic plain-text alternative body
               $mail->msgHTML($message);
               
               //$ccode45 = $_POST['ccode'];
               
               if( $mail->send() )
               {
                  return "Agent inserted successfully.";
               }
               else
               {
                  return "Agent not inserted";
               }
            
        } 
    }
}

function getAgents($mysqli) {
    $role = $_SESSION['agentrole'];
    $id = $_SESSION['id'];

    $data = array();

    // Perform SQL query to fetch data
    if($role == "MANAGER" || $role == "Admin"){
        $result = $mysqli->query("SELECT * FROM login where agentrole<>'admin' order by id desc");
    }else{
        $result = $mysqli->query("SELECT * FROM login where id = $id");
    }
    

    // Fetch data and store in array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Free result set
    $result->free();

    return $data;
}

function updateData($mysqli, $agentname, $email, $department,$agentphoneno,$agentrole,$updatedat,$id){

    $query = "update login set agentname='$agentname',email='$email',department='$department',agentphoneno='$agentphoneno' where id='$id'";
    if ($mysqli->query($query) === TRUE) {
        return "Agent updated successfully";
    } else {
        return "Error updating agent: " . $mysqli->error;
    }
}

function getCompanies($mysqli){
    $data = array();

    $role = $_SESSION['agentrole'];
    $id = $_SESSION['id'];
    if($role == "Admin" || $role == "MANAGER"){
        $result = $mysqli->query("SELECT company.*, login.agentname 
                              FROM company 
                              LEFT JOIN login ON company.createdby = login.id 
                              ORDER BY company.id DESC");
    }else{
        $result = $mysqli->query("SELECT company.*, login.agentname 
                              FROM company 
                              LEFT JOIN login ON company.createdby = login.id where company.createdby = '$id'
                              ORDER BY company.id DESC");
    }
    

    // Fetch data into an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Free the result set
    $result->free();

    // Return the sorted data
    return $data;
}

function getCompaniesForLoad($mysqli,$id){
    $data = array();

    $role = $_SESSION['agentrole'];
    //$id = $_SESSION['id'];
    //echo "select company.*,login.agentname from company left join login on company.createdby = login.id where company.id = '$id'";die;
    $sql = "select company.*,login.agentname from company left join login on company.createdby = login.id where company.id = '$id'";
    $res = $mysqli->query($sql);
    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }
    $res->free();
    return $data;

    
}

function addCompany($mysqli, $sessionid, $comapnyname,$contactperson,$emailaddress,$companycontactno,$address,$zipcode,$city,$phoneno,$mailingaddress,$accountPayable,$accountPayableEmail,$accountPayableNumber,$creditlimit,$createdat,$state,$paymentterm ) {
    // Escape inputs to prevent SQL injection
    //$sessionid = $_SESSION['id'];
    $companyname = mysqli_real_escape_string($mysqli, $comapnyname);
    $contactperson = mysqli_real_escape_string($mysqli, $contactperson);
    $emailaddress = mysqli_real_escape_string($mysqli, $emailaddress);
    //$companyaddress = mysqli_real_escape_string($mysqli, $companyaddress);
    $companycontactno = mysqli_real_escape_string($mysqli, $companycontactno);
    $address = mysqli_real_escape_string($mysqli, $address);
    $zipcode = mysqli_real_escape_string($mysqli, $zipcode);
    $city = mysqli_real_escape_string($mysqli, $city);
    $state = mysqli_real_escape_string($mysqli, $state);
    $phoneno = mysqli_real_escape_string($mysqli, $phoneno);
    $mailingaddress = mysqli_real_escape_string($mysqli, $mailingaddress);
    $accountPayable = mysqli_real_escape_string($mysqli, $accountPayable);
    $accountPayableEmail = mysqli_real_escape_string($mysqli, $accountPayableEmail);
    $accountPayableNumber = mysqli_real_escape_string($mysqli, $accountPayableNumber);
    $creditlimit = mysqli_real_escape_string($mysqli, $creditlimit);
    $createdat = mysqli_real_escape_string($mysqli, $createdat);
    $paymentterm = mysqli_real_escape_string($mysqli, $paymentterm);
    $status = 3;
    // Prepare SQL statement
   
    $sql = "INSERT INTO company (createdby,companyname,contactperson,emailaddress,companycontactno,address,zipcode,city,phoneno,mailingaddress,accountPayable,accountPayableEmail,accountPayableNumber,creditlimit,createdat,companystatus,state,paymentterm) 
            VALUES ('$sessionid', '$companyname', '$contactperson','$emailaddress','$companycontactno','$address','$zipcode','$city','$phoneno','$mailingaddress','$accountPayable','$accountPayableEmail','$accountPayableNumber','$creditlimit','$createdat','$status','$state','$paymentterm')";

    // Execute SQL query
    if ($mysqli->query($sql) === TRUE) {
        return "Company added successfully";
    } else {
        return "Error while adding company: " . $mysqli->error;
    }
}

function updateCompany($mysqli,$companystatus,$companyid,$companyname,$contactperson,$emailaddress,$companycontactno,$address,$zipcode,$city,$state){
    $companyname = mysqli_real_escape_string($mysqli, $companyname);
    $contactperson = mysqli_real_escape_string($mysqli, $contactperson);
    $emailaddress = mysqli_real_escape_string($mysqli, $emailaddress);
    $companycontactno = mysqli_real_escape_string($mysqli, $companycontactno);
    $address = mysqli_real_escape_string($mysqli, $address);
    $zipcode = mysqli_real_escape_string($mysqli, $zipcode);
    $city = mysqli_real_escape_string($mysqli, $city);
    $state = mysqli_real_escape_string($mysqli, $state);
    $companystatus = mysqli_real_escape_string($mysqli, $companystatus);
    $update = "update company set companystatus = '$companystatus',companyname='$companyname',contactperson='$contactperson',emailaddress='$emailaddress',companycontactno='$companycontactno',address='$address',zipcode='$zipcode',city='$city',state='$state' where id = '$companyid'";
    if ($mysqli->query($update) === TRUE) {
        return "Company updated successfully";
    } else {
        return "Error updating company: " . $mysqli->error;
    }

}

function createPassword($mysqli, $email, $password){
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE login set password = '$password_hash' where email='$email'";

    if($mysqli->query($sql)){
        return "Password create successfully.";
    }else{
        return "Create password faild.";
    }
}

function pedingCount($mysqli){
    $role = $_SESSION['agentrole'];
    $id = $_SESSION['id'];
    if($role == "Admin" || $role == "MANAGER"){
        $query = "select count(*) as countPending from company where companystatus='3'";
    }else{
        $query = "select count(*) as countPending from company where companystatus='3' AND createdby = '$id'";
    }
    $resultCount = mysqli_query($mysqli, $query);
    $countRow = mysqli_fetch_assoc($resultCount);
    $pCount = $countRow['countPending'];
    return $pCount;
}

function workingCount($mysqli){
    $role = $_SESSION['agentrole'];
    $id = $_SESSION['id'];
    if($role == "Admin" || $role == "MANAGER"){
        $query = "select count(*) as countWorking from company where companystatus='1'";
    }else{
        $query = "select count(*) as countWorking from company where companystatus='1' AND createdby = '$id'";
    }
    
    $resultCount = mysqli_query($mysqli, $query);
    $countRow = mysqli_fetch_assoc($resultCount);
    $wCount = $countRow['countWorking'];
    return $wCount;
}

function approvedCount($mysqli){
    $role = $_SESSION['agentrole'];
    $id = $_SESSION['id'];
    if($role == "Admin" || $role == "MANAGER"){
        $query = "select count(*) as countApproved from company where companystatus='2'";
    }else{
        $query = "select count(*) as countApproved from company where companystatus='2' AND createdby = '$id'";
    }
    
    $resultCount = mysqli_query($mysqli, $query);
    $countRow = mysqli_fetch_assoc($resultCount);
    $aCount = $countRow['countApproved'];
    return $aCount; 
}

function rejectedCount($mysqli){
    $role = $_SESSION['agentrole'];
    $id = $_SESSION['id'];
    if($role == "Admin" || $role == "MANAGER"){
        $query = "select count(*) as countRejected from company where companystatus='4'";
    }else{
        $query = "select count(*) as countRejected from company where companystatus='4' AND createdby = '$id'";
    }
    
    $resultCount = mysqli_query($mysqli, $query);
    $countRow = mysqli_fetch_assoc($resultCount);
    $rCount = $countRow['countRejected'];
    return $rCount; 
}

function addLoadAndCarrier($mysqli,$from,$to,$sDate,$deliveryDate,$trucker_type,$loadtype,$lenght,$weight,$commodity,$dat_rate,$customer_rate,$carrier_rate,$truckerno,$truckerEmail,$truckerAddress){
    $from = mysqli_real_escape_string($mysqli, $from);
    $to = mysqli_real_escape_string($mysqli, $to);
    $sDate = mysqli_real_escape_string($mysqli, $sDate);
    $deliveryDate = mysqli_real_escape_string($mysqli, $deliveryDate);
    $trucker_type = mysqli_real_escape_string($mysqli, $trucker_type);
    $loadtype = mysqli_real_escape_string($mysqli, $loadtype);
    $lenght = mysqli_real_escape_string($mysqli, $lenght);
    $weight = mysqli_real_escape_string($mysqli, $weight);
    $commodity = mysqli_real_escape_string($mysqli, $commodity);
    $dat_rate = mysqli_real_escape_string($mysqli, $dat_rate);
    $customer_rate = mysqli_real_escape_string($mysqli, $customer_rate);
    $carrier_rate = mysqli_real_escape_string($mysqli, $carrier_rate);
    $truckerno = mysqli_real_escape_string($mysqli, $truckerno);
    $truckerEmail = mysqli_real_escape_string($mysqli, $truckerEmail);
    $truckerAddress = mysqli_real_escape_string($mysqli, $truckerAddress);

}

function forgotPassword($mysqli,$email){
    require 'PHPMailer/PHPMailerAutoload.php';
    $fromName = "Road Wings Logistic";
    $toName = $email;
    $fromEmailAddress = "support@bookviaus.com";
    $recipient = $email;
    $subject = "Forgot Password";
    $mail = new PHPMailer;
     $mail->body = '<style type="text/css">#outlook a {
        padding:0;
    }
    .ExternalClass {
        width:100%;
    }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
        line-height:100%;
    }
    .es-button {
        mso-style-priority:100!important;
        text-decoration:none!important;
    }
    a[x-apple-data-detectors] {
        color:inherit!important;
        text-decoration:none!important;
        font-size:inherit!important;
        font-family:inherit!important;
        font-weight:inherit!important;
        line-height:inherit!important;
    }
    .es-desk-hidden {
        display:none;
        float:left;
        overflow:hidden;
        width:0;
        max-height:0;
        line-height:0;
        mso-hide:all;
    }
    .es-button-border:hover a.es-button, .es-button-border:hover button.es-button {
        background:#ffffff!important;
    }
    .es-button-border:hover {
        background:#ffffff!important;
        border-style:solid solid solid solid!important;
        border-color:#3d5ca3 #3d5ca3 #3d5ca3 #3d5ca3!important;
    }
    @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:20px!important; text-align:center } h2 { font-size:16px!important; text-align:left } h3 { font-size:20px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:20px!important } h2 a { text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:16px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:10px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:12px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:14px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } }
    @media screen and (max-width:384px) {.mail-message-content { width:414px!important } }</style>';
                $message = '<body style="width:100%;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
      <div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#FAFAFA"><!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="#fafafa"></v:fill>
                </v:background>
            <![endif]-->
       <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
         <tr style="border-collapse:collapse">
          <td valign="top" style="padding:0;Margin:0">
           <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td class="es-adaptive" align="center" style="padding:0;Margin:0">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:10px;Margin:0">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:580px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;display:none"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table cellpadding="0" cellspacing="0" class="es-header" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
             <tr style="border-collapse:collapse">
              <td class="es-adaptive" align="center" style="padding:0;Margin:0">
               <table class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#3d5ca3;width:600px" cellspacing="0" cellpadding="0" bgcolor="#3d5ca3" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-color:#3d5ca3" bgcolor="#3d5ca3" align="left">
                   <table cellspacing="0" cellpadding="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td class="es-m-p0l es-m-txt-c" align="center" style="padding:0;Margin:0;font-size:0px"><a href="https://roadwingslogistics.com/" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#1376C8;font-size:14px"><img src="https://ffyhptr.stripocdn.email/content/guids/9a27bf59-fcf8-499a-8263-d94cc971f987/images/unnamed.gif" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="252"></a></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:40px;background-color:transparent;background-position:left top" bgcolor="transparent" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0"><img src="https://ffyhptr.stripocdn.email/content/guids/CABINET_dd354a98a803b60e2f0411e893c82f56/images/23891556799905703.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="175"></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px"><h1 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333"><strong>CREATE YOUR&nbsp;</strong></h1><h1 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333"><strong>&nbsp;PASSWORD?</strong></h1></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica,helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">HI, Username: '. $email.'</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica,helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">Login Link: https://roadwingslogistics.com/roadwings/login_page.php</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-right:35px;padding-left:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">There was a request to create your password!</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-top:25px;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">If did not make this request, just ignore this email. Otherwise, please click the button below to create your password:</p></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:40px;padding-bottom:40px"><span class="es-button-border" style="border-style:solid;border-color:#3D5CA3;background:#FFFFFF;border-width:2px;display:inline-block;border-radius:10px;width:auto"><a href="https://roadwingslogistics.com/roadwings/agent_create_password_page.php?email='.$email.'" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#3D5CA3;font-size:14px;display:inline-block;background:#FFFFFF;border-radius:10px;font-family:arial, helvetica neue, helvetica, sans-serif;font-weight:bold;font-style:normal;line-height:17px;width:auto;text-align:center;padding:15px 20px 15px 20px;mso-padding-alt:0;mso-border-alt:10px solid #FFFFFF">Forgot PASSWORD</a></span></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
                 <tr style="border-collapse:collapse">
                  <td style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-top:20px;background-position:center center" align="left"><!--[if mso]><table style="width:580px" cellpadding="0" cellspacing="0"><tr><td style="width:199px" valign="top"><![endif]-->
                   <table class="es-left" cellspacing="0" cellpadding="0" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;width:199px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:center center" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td class="es-m-txt-c" align="right" style="padding:0;Margin:0;padding-top:15px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px"><strong>Follow us:</strong></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table><!--[if mso]></td><td style="width:20px"></td><td style="width:361px" valign="top"><![endif]-->
                   <table class="es-right" cellspacing="0" cellpadding="0" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;width:361px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:center center" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px;font-size:0">
                           <table class="es-table-not-adapt es-social" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                             <tr style="border-collapse:collapse">
                              <td valign="top" align="center" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://www.facebook.com/roadwingslogistic" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/facebook-rounded-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                              <td valign="top" align="center" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://twitter.com/roadwingslogi" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/twitter-rounded-gray.png" alt="Tw" title="Twitter" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                              <td valign="top" align="center" style="padding:0;Margin:0;padding-right:10px"><a target="_blank" href="https://www.instagram.com/roadwings.logistics/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/instagram-rounded-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                              <td valign="top" align="center" style="padding:0;Margin:0"><a target="_blank" href="https://www.linkedin.com/in/roadwings-logistics/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px"><img src="https://ffyhptr.stripocdn.email/content/assets/img/social-icons/rounded-gray/linkedin-rounded-gray.png" alt="In" title="Linkedin" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                             </tr>
                           </table></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table><!--[if mso]></td></tr></table><![endif]--></td>
                 </tr>
                 <tr style="border-collapse:collapse">
                  <td style="Margin:0;padding-top:5px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:left top" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:14px">Contact us: <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px" href="tel:123456789"></a>+1 833 781 8686<a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px" href="tel:123456789"></a> | <a target="_blank" href="mailto:your@mail.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px"></a><a href="mailto:info@roadwingslogistics.com" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#0B5394;font-size:16px">info@roadwingslogistics.com</a><a target="_blank" href="mailto:your@mail.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#666666;font-size:14px"></a></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-footer" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-footer-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
                 <tr style="border-collapse:collapse">
                  <td style="Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;padding-bottom:30px;background-color:#0b5394;background-position:left top" bgcolor="#0b5394" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><h2 style="Margin:0;line-height:19px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#ffffff"><strong>Have quastions?</strong></h2></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td align="left" style="padding:0;Margin:0;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#ffffff;font-size:14px">We are here to help, learn more about us <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#ffffff;font-size:14px" href="">here</a></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#ffffff;font-size:14px">or <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#ffffff;font-size:14px" href="">contact us</a><br></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="transparent" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td style="padding:0;Margin:0;padding-top:15px;background-position:left top" align="left">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0">
                           <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                             <tr style="border-collapse:collapse">
                              <td style="padding:0;Margin:0;border-bottom:1px solid #fafafa;background:none;height:1px;width:100%;margin:0px"></td>
                             </tr>
                           </table></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-footer" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
             <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center">
               <table class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="transparent" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="Margin:0;padding-bottom:5px;padding-top:15px;padding-left:20px;padding-right:20px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:18px;color:#666666;font-size:12px">This daily newsletter was sent to info@name.com from company name because you subscribed. If you would not like to receive this email <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:12px" class="unsubscribe" href="">unsubscribe here</a>.</p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
             <tr style="border-collapse:collapse">
              <td align="center" style="padding:0;Margin:0">
               <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                       <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td align="center" style="padding:0;Margin:0;display:none"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
      </div>
     </body>';
                $mail->isHTML(true);
                       
               $mail->isSMTP();
            
               $mail->Debugoutput = 'html';
               
               //Set the hostname of the mail server
               $mail->Host = 'ssl://smtp.gmail.com';
                   
               //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
               $mail->Port = 465;
               //$mail->Port = 465;
                   
               //Set the encryption system to use - ssl (deprecated) or tls
               //$mail->SMTPSecure = 'ssl';
                   
               //Whether to use SMTP authentication
               $mail->SMTPAuth = true;
                   
               //Username to use for SMTP authentication - use full email address for gmail
               $mail->Username = "susheeljamwal@gmail.com";
                   
               //Password to use for SMTP authentication
               $mail->Password = "pktdozoxyjysjajp";
               
                   
               //Set who the message is to be sent from
               $mail->setFrom($fromEmailAddress, $fromName);
                   
                   
               //Set an alternative reply-to address
               //$mail->addReplyTo('replyto@example.com', 'First Last');
               
               //Set who the message is to be sent to
              // $mail->addAddress($toEmailAddress, $toName);
              
                $mail->addAddress($recipient);
            
                   
               //Set who the message is to be copied
               //$mail->AddBCC('', '');
              /* $mail->AddCC($cc, $cc);
               foreach($arrBcc as $bcc)
               {
                   $mail->AddBCC($bcc, $bcc);
               }  */ 
               //Set the subject line
               $mail->Subject = $subject;
                   
                   
               //Read an HTML message body from an external file, convert referenced images to embedded,
               //convert HTML into a basic plain-text alternative body
               $mail->msgHTML($message);
               
               //$ccode45 = $_POST['ccode'];
               
               if( $mail->send() )
               {
                  return "Password updated successfully.";
               }
               else
               {
                  return "Update password faild.";
               }
}

function getCompany($mysqli,$id){
    $query = "select * from company where id='$id'";
    $res = $mysqli->query($query);
    $data = array();
    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }
    $res->free();
    return $data;
}

function addTrucker($mysqli,$tname,$tphoneno,$temail,$tmcno,$taddress,$createdby,$createdat,$carrierpaymentterm,$lane){
    $tname = mysqli_real_escape_string($mysqli, $tname);
    $tphoneno = mysqli_real_escape_string($mysqli, $tphoneno);
    $temail = mysqli_real_escape_string($mysqli, $temail);
    $tmcno = mysqli_real_escape_string($mysqli, $tmcno);
    $taddress = mysqli_real_escape_string($mysqli, $taddress);
    $carrierpaymentterm = mysqli_real_escape_string($mysqli, $carrierpaymentterm);
    $createdby = mysqli_real_escape_string($mysqli, $createdby);
    $createdat = mysqli_real_escape_string($mysqli, $createdat);
    $lane = mysqli_real_escape_string($mysqli, $lane);
    $query = "select  temail from truckerdata where temail = '".$temail."'";
    $res  = $mysqli->query($query);
    if($res->num_rows > 0){
        return "Email already registered";
    }else{
        $sql = "insert into truckerdata(tname,taddress,temail,tphoneno,tmcno,carrierpaymentterm,createdat,createdby,lane) VALUES ('".$tname."','".$taddress."','".$temail."','".$tphoneno."','".$tmcno."','".$carrierpaymentterm."','".$createdat."','".$createdby."','".$lane."')";
        if($mysqli->query($sql)){
            return "Trucker added successfully.";
        }else{
            return "Failed to add trucker.";
        }
    }
}

function getGrucker($mysqli){
    $sessionid = $_SESSION['id'];
    $role = $_SESSION['agentrole'];
    if($role == "Admin" || $role == "MANAGER"){
        $sql = "select truckerdata.*,login.agentname from truckerdata left join login on truckerdata.createdby = login.id order by truckerdata.id DESC";
    }else{
        $sql = "select truckerdata.*,login.agentname from truckerdata left join login on truckerdata.createdby = login.id where truckerdata.createdby = '$sessionid' order by truckerdata.id DESC";
    }
    
    $res = $mysqli->query($sql);
    $data = array();
    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }
    $res->free();
    return $data;
}

function getcarrier($mysqli,$id){
    $sessionid = $_SESSION['id'];
    $role = $_SESSION['agentrole'];
    $sql = "select * from truckerdata where id='$id'";
        
    $res = $mysqli->query($sql);
    $data = array();
    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }
    $res->free();
     return $data;
}

function updateCarrier($mysqli,$tname,$id,$temail,$tphoneno,$taddress,$tmcno,$lane,$carrierpaymentterm){
    $tname = mysqli_real_escape_string($mysqli, $tname);
    $tphoneno = mysqli_real_escape_string($mysqli, $tphoneno);
    $temail = mysqli_real_escape_string($mysqli, $temail);
    $tmcno = mysqli_real_escape_string($mysqli, $tmcno);
    $taddress = mysqli_real_escape_string($mysqli, $taddress);
    $carrierpaymentterm = mysqli_real_escape_string($mysqli, $carrierpaymentterm);
    $lane = mysqli_real_escape_string($mysqli, $lane);
    $query = "update truckerdata set tname='$tname',temail='$temail',tphoneno='$tphoneno',tmcno='$tmcno',taddress='$taddress',carrierpaymentterm='$carrierpaymentterm',lane='$lane' where id='$id'";
    if ($mysqli->query($query) === TRUE) {
        return "Carrier updated successfully";
    } else {
        return "Error updating carrier: " . $mysqli->error;
    }
}
?>