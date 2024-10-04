<?php 
$user_info = $data['user_info'];
$user_address = $data['user_address'];
?>

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
    <select name="region_id" id="region_id" onchange="checkRegion(this)" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>>
                <option value="">
                    ---Select Region---
                </option>
            <?php foreach ($data['regions'] as $region): ?>
                <option value="<?= htmlspecialchars($region['regCode'])?>" <?php if($region['id'] == $user_address['region_id']) echo 'selected'?>>
                    <?= htmlspecialchars($region['regDesc']) ?>
                </option>
            <?php endforeach; ?>
    </select><br><br>

    <label for="province_id">Province:</label><br>
    <select name="province_id" id="province_id" value="<?=$user_address['province_id']?>" onchange="checkProvince(this)" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>>
                <option value="">
                    ---Select Province---
                </option>
                <?php foreach ($data['provinces'] as $province): ?>
                <option value="<?= htmlspecialchars($province['provCode'])?>" <?php if($province['id'] == $user_address['province_id']) echo 'selected'?>>
                    <?= htmlspecialchars($province['provDesc']) ?>
                </option>
                <?php endforeach; ?>
    </select><br><br>
    
    <label for="city_id">City:</label><br>
    <select name="city_id" id="city_id" value="<?=$user_address['city_id']?>" onchange="checkCity(this)" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>>
                <option value="">
                    ---Select City---
                </option>
                <?php foreach ($data['cities'] as $city): ?>
                <option value="<?= htmlspecialchars($city['citymunCode'])?>" <?php if($city['id'] == $user_address['city_id']) echo 'selected'?>>
                    <?= htmlspecialchars($city['citymunDesc']) ?>
                </option>
                <?php endforeach; ?>
    </select><br><br>
    
    <label for="brgy_id">Brgy:</label><br>
    <select name="brgy_id" id="brgy_id" value="<?=$user_address['brgy_id']?>" onchange="" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>>
                <option value="">
                    ---Select Barangay---
                </option>
                <?php foreach ($data['brgys'] as $brgy): ?>
                <option value="<?= htmlspecialchars($brgy['brgyCode'])?>" <?php if($brgy['id'] == $user_address['brgy_id']) echo 'selected'?>>
                    <?= htmlspecialchars($brgy['brgyDesc']) ?>
                </option>
                <?php endforeach; ?>
    </select><br><br>

    <label for="detailed_address">Street, building, and  number:</label><br>
    <input type="text" id="detailed_address" name="detailed_address" value="<?= $user_address['detailed_info'] ?>" <?php if($user_info['is_artist'] == 'true') echo 'required' ?>><br><br>
    
    <label for="landmark">Landmark:</label><br>
    <input type="text" id="landmark" name="landmark" value="<?= $user_address['landmark'] ?>"><br><br>

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