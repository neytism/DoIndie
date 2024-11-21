
<div class="navbar row-list">
    <a class="icon non-selectable"><img class="logo-img" src="<?php echo BASEURL; ?>assets\img\LOGO.png" alt="DoIndie Logo"></a>
    
    <ul class="menu">
        <li> <a href="<?php echo BASEURL; ?>">HOME</a></li>
        <li> <a href="<?php echo BASEURL; ?>artists">ARTISTS</a></li>
        <li> <a href="<?php echo BASEURL; ?>products">PRODUCTS</a></li>
        <?php if ($is_logged_in && $view != 'cartView'): ?>
                <li> <a href="<?php echo BASEURL; ?>cart">CART</a></li>
        <?php endif; ?>
        <li><a href="#">PROFILE</a>
            <ul>
                <?php if (!$is_logged_in): ?>
                    <li><a href="" onclick="openLoginPopUp(event,'<?php echo BASEURL; ?>login/popUp','<?php echo BASEURL; ?>')">Log in</a></li>
                    <li><a href="<?php echo BASEURL; ?>signUp">Sign up</a></li>
                <?php else: ?>
                    <?php if ($view == 'userProfileView'): ?>
                        <?php if($data['user_info']['is_artist'] != 'true'):?>
                            <li><a href="<?php echo BASEURL; ?>registerAsArtist">Register as Artist</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($view != 'userProfileView'): ?>
                        <li><a href="<?php echo BASEURL; ?>profile/<?php echo $data['user_info']['username'] ?>">Profile</a></li>
                    <?php endif; ?>
                    <a href="<?php echo BASEURL; ?>login/logout">Logout</a>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
    
    <!-- <a href="<?php echo BASEURL; ?>contactUs">Contact us</a>&nbsp;&nbsp;
    <?php if ($view != 'aboutUsView'): ?>
    <a href="<?php echo BASEURL; ?>home/aboutUs">About us</a>&nbsp;&nbsp;
    <?php endif; ?> -->
    
    <?php if ($view != 'cartView' && $view != 'userProfileView' && $view != 'checkOutView'): ?>
        <a class="search">
            <input class="navbarSearch" type="search" name="" placeholder="Search..."
                oninput="inputSearch(this,'<?php echo BASEURL; ?>')">
            <button class="navbarSearchButton">Search</button>
        </a>
    
        <div id="search-container" style="background-color: gray; display: none;">
    
            <div id="loading" style="display: none;">Loading...</div>
            <div id="no-result" style="display: none;">No Result.</div>
    
            <div id="results" style="display: none;">
    
            </div>
    
        </div>
    <?php else: ?>
        <a class="search"></a>
    <?php endif; ?>

</div>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/logInPopUp.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/search.js"></script>
