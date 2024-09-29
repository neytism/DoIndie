<h2>DoIndie Verify Email</h2>

<div id="verify-email-container">
    
    <p id="error-message" style="color: red;"></p>
    
    <p>We emailed you a six-character code to <?= $data['user_info']['email']?>. Enter the code below to verify your email address. Code will expire within 3 minutes.</p>
    <!-- sending form data with javascript, no need for refreshing -->
    <form id="verify-email-form" method="POST" onsubmit="sendForm(event, 'verify-email-form', 'error-message', '<?php echo BASEURL; ?>verifyEmail/verify')">
        <label for="code">Code:</label><br>
        <input type="text" id="code" name="code" required><br><br>
        
        <input type="submit" value="Submit">
        
        <input type="button" value="Go Back" onclick="history.back()">
    
    </form>

</div>

<script type="text/javascript" src="assets/js/sendForm.js"></script>