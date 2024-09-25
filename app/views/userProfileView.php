<?php 
$logged = $data['is_logged_in']; //just to shorten
$user_info = $data['user_info'];
?>

<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Profile Page</h2>

<?php if($logged):?>
    <div style="height: auto; width: auto"><img src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $data['user_info']['picture_path'] ?>" alt="<?= $data['user_info']['username'] ?> Profile Pic"></div>
    <h1>Hello, <?= $data['user_info']['username'] ?></h1>
    <h4> Your user id is <?= $data['user_info']['id'] ?></h4>
    <h4> Your First Name is <?= $data['user_info']['first_name'] ?></h4>
    <h4> Your Last Name is <?= $data['user_info']['last_name'] ?></h4>
    <?php 
    $date_joined = new DateTime($data['user_info']['date_joined']);
    $formatted_date = $date_joined->format('F j, Y \a\t g:i A');
    ?>
    <h4> You joined last <?= $formatted_date ?></h4>
    <h4> Use this to show more info</h4>
    
<?php else: ?>
    <h1>Hello, Guest</h1>
<?php endif; ?>



