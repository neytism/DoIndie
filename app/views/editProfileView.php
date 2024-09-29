<?php $user_info = $data['user_info']?>

<h2>Edit Profile</h2>

<p id="error-message" style="color: red;"></p>

<form id="edit-profile-form" method="POST" enctype="multipart/form-data">
    <div><img style="height: auto; max-width: 250px" src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?php echo $user_info['picture_path']?>" alt=""></div><br>
    <label for="image">Image:</label><br>
    <input type="file" name="image" id="image" accept="image/*" required><br><br>
    
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" value="<?= $user_info['username'] ?>" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= $user_info['email'] ?>" required <?php if($user_info['is_verified_email'] == 'true') echo 'disabled' ?>><br>
    <?php if($user_info['is_verified_email'] != 'true'): ?>
        <label style="color:red;" for="email">* email not verified</label><br>
    <?php else: ?>
        <label style="color:green;" for="email">* email verified</label><br>
    <?php endif; ?>
    <br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" value="<?= $user_info['address'] ?>" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>><br><br>

    <?php if($user_info['is_artist'] == 'true'):?>

        <label for="artist_display_name">Artist Display Name:</label><br>
        <input type="text" id="artist_display_name" name="artist_display_name" value="<?= $user_info['artist_display_name'] ?>" required><br><br>

        <label for="artist_category_id">Category:</label><br>
        <select name="artist_category_id" id="artist_category_id" >
            <?php foreach ($data['artist_categories'] as $category): ?>
                <option value="<?= htmlspecialchars($category['artist_category_id']) ?>" <?php if($user_info['artist_category_id'] == $category['artist_category_id']) echo 'selected' ?>>
                    <?= htmlspecialchars($category['artist_category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
    <?php endif; ?>
    
    <input type="submit" value="Save" onclick="sendForm(event,'edit-profile-form','error-message','<?php echo BASEURL; ?>updateProfile/checkProfile')">
    
    <input type="button" value="Back" onclick="history.back()">
</form>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/updateUploadImage.js"></script>
