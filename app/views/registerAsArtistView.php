<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Register As Artist</h2>

<p id="error-message" style="color: red;"></p>

<!-- sending form data with javascript, no need for refreshing -->
<form id="register-artist-form" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="artist_name">Artist Name:</label><br>
    <input type="artist_name" id="artist_name" name="artist_name" required><br><br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" required><br><br>
    
    <!-- update form based on required -->
    
    <input type="submit" value="Register" onclick="sendForm(event,'register-artist-form','error-message','<?php echo BASEURL; ?>artist/checkRegister')">
   
</form>

<script type="text/javascript" src="assets/js/sendForm.js"></script>