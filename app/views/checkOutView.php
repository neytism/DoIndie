<?php $selected_carts = $data['selected_carts']?>

<h3>Checkout</h3>

<p id="error-message" style="color: red;"></p>

<p><b>Username: </b><?= $data['user_info']['username']?></p>
<p><b>Email: </b><?= $data['user_info']['email']?></p>
<?php if($data['user_info']['is_verified_email'] == 'false'):?>
<p style="color: red;">IMPORTANT: Verify your email on the profile page to make a purchase.</p>
<?php endif; ?>

<p><b>Address: </b><?= $data['user_info']['address']?></p>
<?php if(empty($data['user_info']['address'])):?>
<p style="color: red;">IMPORTANT: Add an address on the profile page to make a purchase.</p>
<?php endif; ?>

<p>==========================================</p>

<h4>Items: </h4>
<?php foreach($selected_carts as $product):?>

    <img
    style="width: auto; max-height: 80px; min-height: 80px;"
    src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?=$product['product_picture_path']?>"
    alt=""><br>
    <p>Title: <?=$product['title']?></p>
    <p>Artist: <?=$product['username']?> aka <?=$product['artist_display_name']?></p>
    <p>Price: ₱ <?=number_format($product['price'], 2, '.', ',')?> x <?=$product['quantity']?></p>
    <p>==========================================</p>

<?php endforeach; ?>

<h4>Payment Summary</h4>
<p><b>Payment Method: </b><?= $data['mode_of_payment']?></p>
<p><b>Subtotal: </b>₱ <?= $data['subtotal']?></p>
<?php if($data['voucher_code'] == 'None'):?>
    <p><b>Voucher: </b><?= $data['voucher_code']?></p>
<?php else: ?>
    <p><b>Voucher: </b><?= $data['voucher_code']?></p>
    <p><b>Discount: </b><?= $data['voucher_desc']?></p>
<?php endif; ?>

<p><b>TOTAL: </b>₱ <?= $data['total']?></p>

<br>
<?php if($data['user_info']['is_verified_email'] == 'false' || empty($data['user_info']['address'])):?>
    <button disabled>CONFIRM</button>
<?php else: ?>
    <button onclick="window.location='<?php echo BASEURL; ?>checkOut/confirmOrder'">CONFIRM</button>
<?php endif; ?>

<button onclick="window.location='<?php echo BASEURL; ?>cart'">GO BACK TO CART</button>

<script src="http://localhost:8000/DoIndie/assets/js/sendForm.js" id="sendFormScript"></script>