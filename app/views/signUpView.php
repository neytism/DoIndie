<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Sign Up</h2>

<p id="error-message" style="color: red;"></p>

<!-- sending form data with javascript, no need for refreshing -->
<form id="signup-form" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="repeat_password">Repeat Password:</label><br>
    <input type="password" id="repeat_password" name="repeat_password" required><br><br>
    
    <input type="submit" value="Sign Up" onclick="sendForm(event,'signup-form','error-message','<?php echo BASEURL; ?>signUp/checkSignUp')">
    <input type="button" value="Already have an account." onclick="window.location='<?php echo BASEURL; ?>login'">
   
</form>

<script type="text/javascript" src="assets/js/sendForm.js"></script>