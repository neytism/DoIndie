<?php 
$user_info = $data['user_info'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>assets\img\LOGO.png" />
    <title>DoIndie</title>

    <!-- CSS FILE LINK -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\checkout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    

</head>

<body>
    
    <div class="container" style="width: 100%; max-width: 100%">
        <div class="checkoutLayout" style="display: flex; align-items: center; justify-content: center;">
            
            <div class="right" style="max-width: 50%; margin: 50px 0;">
                <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc;">REGISTER AS ARTIST
                </h1><br>           
                
                <form id="verify-email-form" class="form" onsubmit="sendForm(event, 'verify-email-form', 'error-message', '<?php echo BASEURL; ?>verifyEmail/verify')">

                    <p class="full-width">We emailed you a six-character code to <?= $data['user_info']['email']?>. Enter the code below to verify your email address. Code will expire within 3 minutes.</p>

                    
                    <div class="group full-width">
                            <label for="code">Code:</label>
                            <input type="text" id="code" name="code" placeholder="Enter code sent via email..." required>
                    </div>

                    <button form="verify-email-form" class="buttonCheckout full-width" type="submit">Submit</button>
                    
                    <button class="buttonCheckout full-width" type="button"  onclick="history.back()">Back</button>
                    
                    <p id="error-message" class="full-width" style="color:#760f14;"></p>
                    
                </form>
                
            </div>
        </div>
    
    </div>
    
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>

</body>

</html>

