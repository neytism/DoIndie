<div>
    
    <a href="<?php echo BASEURL; ?>">Home</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>artist">Artists</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>products">Products</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>contactUs">Contact us</a>&nbsp;&nbsp;
    <a href="<?php echo BASEURL; ?>aboutUs">About us</a>&nbsp;&nbsp;
    <?php if(!$logged){?>
        <a href="" onclick="openLoginPopUp(event,'<?php echo BASEURL; ?>login/popUp')">Log in</a>&nbsp;&nbsp;
        <a href="<?php echo BASEURL; ?>signUp">Sign up</a>&nbsp;&nbsp;
    <?php } else{
        ?> <a href="<?php echo BASEURL; ?>login/logout">Logout</a><?php }?>
    
    
</div>

<script type="text/javascript" src="assets/js/logInPopUp.js"></script>
