<?php $user_info = $data['user_info']?>

<h2>Edit Profile</h2>

<p id="error-message" style="color: red;"></p>

<form id="edit-profile-form" method="POST" enctype="multipart/form-data">
    <div><img style="height: auto; max-width: 250px" src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?php echo $user_info['picture_path']?>" alt=""></div><br>
    <label for="image">Image:</label><br>
    <input type="file" name="image" id="image" accept="image/*"><br><br>
    
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
    
    <label for="">ADDRESS:</label><br>
    
    <label for="region_id">Region:</label><br>
    <select name="region_id" id="region_id" onchange="checkRegion(this)">
                <option value="">
                    ---Select Region---
                </option>
            <?php foreach ($data['regions'] as $region): ?>
                <option value="<?= htmlspecialchars($region['regCode']) //add selected?>" >
                    <?= htmlspecialchars($region['regDesc']) ?>
                </option>
            <?php endforeach; ?>
    </select><br><br>

    <label for="province_id">Province:</label><br>
    <select name="province_id" id="province_id" onchange="checkProvince(this)">
                <option value="">
                    ---Select Province---
                </option>
    </select><br><br>
    
    <label for="city_id">City:</label><br>
    <select name="city_id" id="city_id" onchange="checkCity(this)">
                <option value="">
                    ---Select City---
                </option>
    </select><br><br>
    
    <label for="brgy_id">Brgy:</label><br>
    <select name="brgy_id" id="brgy_id" onchange="">
                <option value="">
                    ---Select Barangay---
                </option>
    </select><br><br>

    <label for="">Street, building, and  number:</label><br>
    <input type="text" id="address" name="address" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>><br><br>

    <label for="">Landmark:</label><br>
    <input type="text" id="address" name="address"><br><br>

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
    
    <input type="submit" value="Save" onclick="sendForm(event,'edit-profile-form','error-message','<?php echo BASEURL; ?>profile/verifyProfileEdit')">
    
    <input type="button" value="Back" onclick="history.back()">
</form>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/updateUploadImage.js"></script>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/address.js"></script>

<script>setBaseUrl('<?php echo BASEURL; ?>');</script>