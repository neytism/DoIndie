<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="footer">
    <ul class="row-list center">
        <li><a class="rowItem" href="<?php echo BASEURL; ?>">Home</a></li>
        <li><a class="rowItem" href="<?php echo BASEURL; ?>products">Products</a></li>
        
        <?php if ($is_logged_in): ?>
                <li><a class="rowItem" href="<?php echo BASEURL; ?>cart">Shopping Cart</a></li>
        <?php endif; ?>
        
        <?php if ($is_logged_in): ?>
            <li><a class="rowItem" href="<?php echo BASEURL; ?>profile/<?php echo $data['user_info']['username']; ?>">Profile</a></li>
        <?php endif; ?>
        
        <li><a class="rowItem" href="<?php echo BASEURL; ?>home/aboutUs">About Us</a></li>
    </ul>
    <ul class="row-list center">
        <a href="https://www.facebook.com" class="fa fa-facebook" style="font-size: 30px;" target="_blank"></a>
        <a href="https://www.youtube.com" class="fa fa-youtube" style="font-size: 30px;" target="_blank"></a>
        <a href="https://www.twitter.com" class="fa fa-twitter" style="font-size: 30px;" target="_blank"></a>
        <a href="https://www.instagram.com" class="fa fa-instagram" style="font-size: 30px;" target="_blank"></a>
        <a href="https://www.tumblr.com" class="fa fa-tumblr" style="font-size: 30px;" target="_blank"></a>
    </ul>
    <p style="color: #f4e9dc">&copy; 2024 DoIndie. All rights reserved.</p>
</div>