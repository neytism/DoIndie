
<link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/login.css">

<div class="navbar row-list <?php if ($view == 'userProfileView') echo 'transparent' ?>">
    <a class="icon non-selectable"><img style="width: 140px;" src="<?php echo BASEURL; ?>assets\img\logo_cream_v2.png" alt="DoIndie Logo"></a>
    
    <ul class="menu">
        <li> <a href="<?php echo BASEURL; ?>" <?php if ($view == 'homeView') echo ' class="active-page" ' ?>>HOME</a></li>
        <li> <a href="<?php echo BASEURL; ?>artists" <?php if ($view == 'artistsView') echo ' class="active-page" ' ?>>ARTISTS</a></li>
        <li> <a href="<?php echo BASEURL; ?>products" <?php if ($view == 'productsView') echo ' class="active-page" ' ?>>PRODUCTS</a></li>
        <?php if ($is_logged_in): ?>
                <li> <a href="<?php echo BASEURL; ?>cart" <?php if ($view == 'cartView') echo ' class="active-page" ' ?>>CART</a></li>
                <?php if ($data['user_info']['is_artist'] == "true"): ?>
                    <li> <a href="<?php echo BASEURL; ?>products/upload">UPLOAD</a></li>
                <?php endif; ?>
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
                    <li><a href="<?php echo BASEURL; ?>profile/<?php echo $data['user_info']['username'] ?>">Profile</a></li>
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
    
        <div id="search-container" style="display: none;">
    
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
