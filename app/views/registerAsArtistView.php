
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

    <!-- PRODUCT LIST START -->
    <div class="container" style="width: 100%; max-width: 100%">
        <div class="checkoutLayout" style="display: flex; align-items: center; justify-content: center;">
            
            <div class="right" style="max-width: 50%; margin: 50px 0;">
                <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc;">REGISTER AS ARTIST
                </h1><br>           
                
                <form id="register-artist-form" class="form">
                    
                
                    
                    <div class="group full-width">
                        <?php if($data['user_info']['is_verified_email'] != 'true'):?>
                            <label style="color: #760f14;"> Email is not verified. Verify email First.</label><br>
                            <button class="buttonCheckout" type="button" onclick="window.location='<?php echo BASEURL; ?>verifyEmail'">Verify Email</button>
                        <?php endif; ?>
                    </div>
                    
                    <?php if($data['user_info']['is_verified_email'] == 'true'):?>

                        <div class="group full-width">
                            <label for="artist_name">Artist Name:</label>
                            <input type="text" id="artist_name" name="artist_name" placeholder="Enter artist display name..." required>
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
                        
                        <button form="register-artist-form" class="buttonCheckout full-width" type="submit" onclick="sendForm(event,'register-artist-form','error-message','<?php echo BASEURL; ?>registerAsArtist/checkRegister')">Register</button>
    
                        
                    <?php endif; ?>
                    
                    <button class="buttonCheckout full-width" type="button"  onclick="history.back()">Back</button>

                    <p id="error-message"class="full-width"  style="color: #760f14;"></p>
                    
                </form>
                
            </div>
        </div>
    
    </div>
    
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>

</body>

</html>

<script>setBaseUrl('<?php echo BASEURL; ?>');</script>
