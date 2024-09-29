<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Register As Artist</h2>

<p id="error-message" style="color: red;"></p>

<?php if($data['user_info']['is_verified_email'] != 'true'):?>
    <a style="color: red;" href="<?php echo BASEURL; ?>verifyEmail"> Email is not verified. Verify email First. Click Here To Verify Email.</a><br><br>
<?php endif; ?>

<!-- sending form data with javascript, no need for refreshing -->
<form id="register-artist-form" method="POST">

    <label for="artist_name">Artist Name:</label><br>
    <input type="text" id="artist_name" name="artist_name" value="<?=$data['user_info']['artist_display_name'] ?>" required <?php if($data['user_info']['is_verified_email'] != 'true') echo ' readonly'?>><br><br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" value="<?=$data['user_info']['address'] ?>" required <?php if($data['user_info']['is_verified_email'] != 'true') echo ' readonly'?>><br><br>
    
    <label for="artist_category_id">Category:</label><br>
    <select name="artist_category_id" id="artist_category_id" >
        <?php foreach ($data['artist_categories'] as $category): ?>
            <option value="<?= htmlspecialchars($category['artist_category_id']) ?>">
                <?= htmlspecialchars($category['artist_category_name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    
    <!-- update form based on required -->
    
    <input type="submit" value="Register" onclick="sendForm(event,'register-artist-form','error-message','<?php echo BASEURL; ?>registerAsArtist/checkRegister')">
   
</form>

<script type="text/javascript" src="assets/js/sendForm.js"></script>