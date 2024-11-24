<?php 
$user_info = $data['user_info'];
$user_address = $data['user_address'];
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
                <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc;">EDIT PROFILE
                </h1><br>           
                
                <form id="edit-profile-form" class="form">

                    <div class="group" style="padding: 20px;">
                        <img style="height: auto; width: 100%; border-radius: 20px; aspect-ratio: 1 / 1; object-fit: cover;" src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?php echo $user_info['picture_path']?>" alt="">
                    </div>
                    
                    <div class="group" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" accept="image/*"><br>
                    </div>

                    <div class="group full-width">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value='<?= $user_info['username'] ?>' required>
                    </div>

                    <div class="group full-width">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value='<?= $user_info['email'] ?>' required <?php if($user_info['is_verified_email'] == 'true') echo 'disabled' ?>>
                        <?php if($user_info['is_verified_email'] != 'true'): ?>
                            <label style="color:#760f14;" for="email">* email not verified</label><br>
                            <button  type="button" class="buttonCheckout" style="width: 50%;">Verify Email</button>
                        <?php else: ?>
                            <label style="color:#9ec43a;" for="email">* email verified</label><br>
                        <?php endif; ?>
                    </div>

                    <div class="group full-width">
                        <label for="bio">Bio:</label><br>
                        <textarea style="height: auto;"  id="bio" name="bio"><?= $user_info['bio'] ?></textarea>
                    </div>
                    
                     
                    <div class="group full-width">
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" value='<?= $user_info['full_name'] ?>'>
                    </div>
                    
                    <div class="group full-width">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" id="phone_number" name="phone_number" value='<?= $user_info['phone_number'] ?>'>
                    </div>

                    <?php if($user_info['is_artist'] == 'true'): ?>
                        <div class="group full-width">
                            <label for="artist_display_name">Artist Name:</label>
                            <input type="text" id="artist_display_name" name="artist_display_name" value='<?= $user_info['artist_display_name'] ?>' required>
                        </div>

                        <div class="group full-width">
                            <label for="artist_category_id">Artist Category</label>
                            <select name="artist_category_id" id="artist_category_id" value="<?=$user_info['artist_category_id']?>" required>
                                <option></option>
                                <?php foreach ($data['artist_categories'] as $category): ?>
                                    <option value="<?= htmlspecialchars($category['artist_category_id'])?>" <?php if($category['artist_category_id'] == $user_info['artist_category_id']) echo 'selected'?>>
                                        <?= htmlspecialchars($category['artist_category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    
                    
                    <div class="group full-width">
                        <label for="">ADDRESS</label>
                    </div>

                    <div class="group">
                        <label for="region_id">Region</label>
                        <select name="region_id" id="region_id" onchange="checkRegion(this)" required>
                            <option></option>
                            <?php foreach ($data['regions'] as $region): ?>
                                <option value="<?= htmlspecialchars($region['regCode'])?>" <?php if( $region['id'] == $user_address['region_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($region['regDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group">
                        <label for="province_id">Province</label>
                        <select name="province_id" id="province_id" value="<?=$user_address['province_id']?>" onchange="checkProvince(this)" required>
                            <option></option>
                            <?php foreach ($data['provinces'] as $province): ?>
                                <option value="<?= htmlspecialchars($province['provCode'])?>" <?php if($province['id'] == $user_address['province_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($province['provDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group">
                        <label for="city_id">City</label>
                        <select  name="city_id" id="city_id" value="<?=$user_address['city_id']?>" onchange="checkCity(this)" required>
                            <option></option>
                            <?php foreach ($data['cities'] as $city): ?>
                                <option value="<?= htmlspecialchars($city['citymunCode'])?>" <?php if($city['id'] == $user_address['city_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($city['citymunDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group">
                        <label for="brgy_id">Barangay</label>
                        <select name="brgy_id" id="brgy_id" value="<?=$user_address['brgy_id']?>" onchange="" required>
                            <option></option>
                            <?php foreach ($data['brgys'] as $brgy): ?>
                                <option value="<?= htmlspecialchars($brgy['brgyCode'])?>" <?php if($brgy['id'] == $user_address['brgy_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($brgy['brgyDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="group full-width">
                        <label for="detailed_address">Street, Building, and Number</label>
                        <input type="detailed_address" id="detailed_address" name="detailed_address" value='<?= $user_address['detailed_info'] ?>' required>
                    </div>

                    <div class="group full-width">
                        <label for="landmark">Landmark</label>
                        <input type="landmark" id="landmark" name="landmark" value='<?= $user_address['landmark'] ?>' required>
                    </div>

                    <p class="full-width" id="error-message" style="color: #760f14;"></p>
                
                    <button form="edit-profile-form" class="buttonCheckout full-width" type="submit"  onclick="sendForm(event,'edit-profile-form','error-message','<?php echo BASEURL; ?>profile/verifyProfileEdit')">Save</button>
    
                    <button class="buttonCheckout full-width" type="button"  onclick="history.back()">Back</button>
                </form>
                
            </div>
        </div>

    </div>
    
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/address.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/updateUploadImage.js"></script>
</body>

</html>

<script>setBaseUrl('<?php echo BASEURL; ?>');</script>