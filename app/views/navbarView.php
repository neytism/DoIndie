<div>
    <a>DOINDIE</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>">Home</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>artists">Artists</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>products">Products</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>contactUs">Contact us</a>&nbsp;&nbsp;
    <?php if ($view != 'aboutUsView'): ?>
    <a href="<?php echo BASEURL; ?>home/aboutUs">About us</a>&nbsp;&nbsp;
    <?php endif; ?>
    <?php if ($view != 'signUpView'): ?>
        <?php if (!$is_logged_in): ?>
            <a href="" onclick="openLoginPopUp(event,'<?php echo BASEURL; ?>login/popUp','<?php echo BASEURL; ?>')">Log in</a>&nbsp;&nbsp;
            <a href="<?php echo BASEURL; ?>signUp">Sign up</a>&nbsp;&nbsp;
        <?php else: ?>
            <?php if ($view == 'userProfileView'): ?>
                <?php if($data['user_info']['is_artist'] != 'true'):?>
                    <a href="<?php echo BASEURL; ?>registerAsArtist">Register as Artist</a>&nbsp;&nbsp;
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($view != 'userProfileView'): ?>
                <a href="<?php echo BASEURL; ?>profile/<?php echo $data['user_info']['username'] ?>">Profile</a>&nbsp;&nbsp;
            <?php endif; ?>
            <?php if ($view != 'cartView'): ?>
                <a href="<?php echo BASEURL; ?>cart">Cart</a>&nbsp;&nbsp;
            <?php endif; ?>
            <a href="<?php echo BASEURL; ?>login/logout">Logout</a>
        <?php endif; ?>
    <?php endif; ?>
    
</div>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/logInPopUp.js"></script>
