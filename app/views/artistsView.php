<?php include 'app/views/navbarView.php'; ?>

<h2>DoIndie Artists Page</h2>

<?php if(count($data['all_artists']) <= 0):?>
    <p>No artists available.</p>
<?php else:?>
    <?php foreach($data['all_artists'] as $artist):?>
        <div>
            <div><img
            style="height: auto; max-width: 250px; min-width: 250px;"
            src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $artist['picture_path'] ?>"
            alt=""></div>
            <h2><a href="<?php echo BASEURL; ?>profile/user/<?=$artist['username']?>"><?= $artist['artist_display_name']?></a></h2>
            <h4><?= $artist['artist_category_name']?></h4>
        </div><br>
    <?php endforeach; ?>
<?php endif;?>
