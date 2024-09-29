<?php include 'app/views/navbarView.php'; ?>

<h2>DoIndie Product Page</h2>

<?php if(count($data['all_products']) <= 0):?>
    <p>No products available.</p>
<?php else:?>
    <?php foreach($data['all_products'] as $product):?>
        <div style="background-color: #dbdbdb; padding: 10px; border-radius: 5px;">
            <div>
                <img
                style="height: auto; max-width: 250px; min-width: 250px;"
                src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>"
                alt="">
            </div>
            <h3>Title: <?= $product['title']?></h3>
            <h4><a href="<?php echo BASEURL; ?>profile/user/<?=$product['username']?>">Artist: <?= $product['artist_display_name']?></a></h4>
            <button onclick="addToCart(event,<?=$product['product_id']?>,'<?php echo BASEURL; ?>cart/addToCart')">Add to cart</button>
        </div><br>
    <?php endforeach; ?>
<?php endif;?>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>