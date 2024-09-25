<div>
    
    <a href="<?php echo BASEURL; ?>">Home</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>artist">Artists</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>products">Products</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>contactUs">Contact us</a>&nbsp;&nbsp;
    <?php if ($view != 'aboutUsView'): ?>
    <a href="<?php echo BASEURL; ?>home/aboutUs">About us</a>&nbsp;&nbsp;
    <?php endif; ?>
    <?php if (!$data['is_logged_in']): ?>
        <a href="" onclick="openLoginPopUp(event,'<?php echo BASEURL; ?>login/popUp')">Log in</a>&nbsp;&nbsp;
        <a href="<?php echo BASEURL; ?>signUp">Sign up</a>&nbsp;&nbsp;
    <?php else: ?>
        <?php if ($view == 'userProfileView'): ?>
            <a href="<?php echo BASEURL; ?>registerAsArtist">Register as Artist</a>&nbsp;&nbsp;
        <?php endif; ?>
        <?php if ($view != 'userProfileView'): ?>
            <a href="<?php echo BASEURL; ?>profile/<?php echo $data['user_info']['username'] ?>">Profile</a>&nbsp;&nbsp;
        <?php endif; ?>
        <a href="<?php echo BASEURL; ?>login/logout">Logout</a>
    <?php endif; ?>
    
</div>

<script type="text/javascript" src="assets/js/logInPopUp.js"></script>

