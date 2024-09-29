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
            <div style="height: auto; width: 100px"><img
            src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>"
            alt=""></div>
            <h3>Title: <?= $product['title']?></h3>
            <h4>Category: <?= $product['product_category_name'] ?></h4>
        </div><br>
    <?php endforeach; ?>
<?php endif;?>

<?php if ($is_self && $data['searched_user']['is_artist'] == "true"): ?>
    <button onclick="window.location='<?php echo BASEURL; ?>products/upload'">Upload new Product</button>
<?php endif; ?>
