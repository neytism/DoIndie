<?php include 'app/views/navbarView.php'; ?>

<?php ?>

<h2>DoIndie Product Page</h2>

<?php if(count($data['all_products']) <= 0):?>
    <p>No products available.</p>
<?php else:?>
    <?php foreach($data['all_products'] as $product):?>
        <?php $is_self = false;
            if(isset($data['user_info']) && $product['artist_id'] == $data['user_info']['user_id']) {
                $is_self = true;
            }; 
        ?>
        <div style="background-color: #dbdbdb; padding: 10px; border-radius: 5px; cursor: pointer; " onclick="openProductPopUp(event, '<?= BASEURL; ?>', '<?= $product['product_id'] ?>', '<?= $product['product_picture_path'] ?>', '<?= $product['title'] ?>', '<?= $product['artist_display_name'] ?>', '<?= $product['product_description'] ?>', '<?= $product['views'] ?>', <?php echo $is_logged_in ?> )">
            <div>
                <img
                style="height: auto; max-width: 250px; min-width: 250px;"
                src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>"
                alt="">
            </div>
            <h3>Title: <?= $product['title']?></h3>
            <h4><a href="<?php echo BASEURL; ?>profile/user/<?=$product['username']?>" onclick="event.stopPropagation();">Artist: <?= $product['artist_display_name']?><a></h4>
            <?php if (!$is_self): ?>
                <?php if ($is_logged_in): ?>
                    <button onclick="addToCart(event,<?=$product['product_id']?>,'<?php echo BASEURL; ?>cart/addToCart'); event.stopPropagation();">Add to cart</button><br>
                <?php else: ?>
                    <button onclick="window.location='<?php echo BASEURL; ?>logIn'; event.stopPropagation();">Add to cart</button><br>
                <?php endif; ?>
            <?php endif;?>
        </div><br>
    <?php endforeach; ?>
<?php endif;?>


<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/productPopUp.js"></script>