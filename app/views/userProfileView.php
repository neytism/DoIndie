<?php 
$is_self = $data['is_self'];
$user_info = $data['user_info'];
?>

<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Profile Page</h2>

<div style="height: auto; width: auto"><img src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $data['user_info']['picture_path'] ?>" alt="<?= $data['user_info']['username'] ?> Profile Pic"></div>
<h1><?= $data['user_info']['username'] ?></h1>
<?php if ($is_self): ?>
    <h4>This is you.</h4>
<?php endif; ?>
<h4> User id is <?= $data['user_info']['user_id'] ?></h4>
<h4> First Name is <?= $data['user_info']['first_name'] ?></h4>
<h4> Last Name is <?= $data['user_info']['last_name'] ?></h4>
<?php if ($data['user_info']['is_verified_email'] == 'true'): ?>
    <h4>Email is Verified.</h4>
<?php else: ?>
    <h4>Email is Not verified.</h4>
<?php endif; ?>
<?php
$date_joined = new DateTime($data['user_info']['date_joined']);
$formatted_date = $date_joined->format('F j, Y \a\t g:i A');
?>
<h4> Joined last <?= $formatted_date ?></h4>
<h4> Use this to show more info</h4>




