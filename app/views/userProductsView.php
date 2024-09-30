<?php
$is_self = $data['is_self'];
?>

<?php include 'app/views/navbarView.php'; ?>


<h2><?=$data['searched_user']['artist_display_name'] ?> Product Page</h2>

<?php if(count($data['searched_user_products']) <= 0):?>
    <p>No products available.</p>
<?php else:?>
    <?php foreach($data['searched_user_products'] as $product):?>
        <div>
            <div><img
            style="height: auto; max-width: 250px; min-width: 250px;"
            src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>"
            alt=""></div>
            <h3>Title: <?= $product['title']?></h3>
            <h4>Category: <?= $product['product_category_name'] ?></h4>
            <?php if (!$is_self): ?>
            <button onclick="addToCart(event,<?=$product['product_id']?>,'<?php echo BASEURL; ?>cart/addToCart')">Add to cart</button>
            <?php endif;?>
        </div><br>
    <?php endforeach; ?>
<?php endif;?>

<?php if ($is_self && $data['searched_user']['is_artist'] == "true"): ?>
    <button onclick="window.location='<?php echo BASEURL; ?>products/upload'">Upload new Product</button>
<?php endif; ?>

<?php if (!$is_self): ?>
<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>
<?php endif;?>
