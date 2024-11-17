<?php
$is_self = $data['is_self'];
?>


<?php include 'app/views/navbarView.php'; ?>

<?php if(!$is_self){
    $user_info = $data['searched_user'];
}else{
    $user_info = $data['user_info'];
}?>

<h2>DoIndie Profile Page</h2>


<div ><img
        style="height: auto; max-width: 300px"
        src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $user_info['picture_path'] ?>"
        alt="<?= $user_info['username'] ?> Profile Pic"></div>
<?php if ($user_info['is_artist'] == "true"): ?>
    <h1>Artist: <?= $user_info['artist_display_name'] ?></h1>
<?php endif; ?>
<h3><?= $user_info['username'] ?></h3>
<?php if ($is_self): ?>
    <h4>This is you.</h4>
<?php endif; ?>
<h4> User id is <?= $user_info['user_id'] ?></h4>
<h4> First Name is <?= $user_info['first_name'] ?></h4>
<h4> Last Name is <?= $user_info['last_name'] ?></h4>
<?php if ($user_info['is_verified_email'] == 'true'): ?>
    <h4>Email is Verified.</h4>
<?php else: ?>
    <h4>Email is Not verified.</h4>
    <?php if ($is_self): ?>
        <button onclick="window.location='<?php echo BASEURL; ?>verifyEmail'">Verify Email</button>
    <?php endif; ?>
<?php endif; ?>
<?php
$date_joined = new DateTime($user_info['date_joined']);
$formatted_date = $date_joined->format('F j, Y \a\t g:i A');
?>
<h4> Joined last <?= $formatted_date ?></h4>
<?php if ($is_self): ?>
    <button onclick="window.location='<?php echo BASEURL; ?>profile/edit'">Edit Profile</button>
<?php endif; ?>
<?php if($user_info['is_artist'] == "true"):?>
<h4><a href="<?php echo BASEURL; ?>products/artist/<?=$user_info['username']?>">See products</a></h4>
<?php endif; ?>
<h4> Use this to show more info</h4><br>

<?php if ($user_info['is_artist'] == "true"):?>
    <h2>Featured Artworks</h2>
<?php endif; ?>

<?php if ($is_self && $user_info['is_artist'] == "true"): ?>
    <button>Upload new Product</button>
<?php endif; ?>