<?php ob_start(); ?>
<h2>It's ordered!</h2>
<p>Hi <?= $user_info['username']?>, </p>
<p>Thanks for your order, we hope you enjoyed shopping with us.</p>
<hr>

<h4>Where...</h4>
<p><?= $user_info['address']?></p>

<h4>When...</h4>
<p>Standard Delivery</p>
<p>Delivered within 3 to 4 business days.</p>

<hr>

<h4>What you ordered:</h4>
<p>Order number: <?= $formatted_order_id ?></p>

<?php foreach($selected_carts as $cart):?>

<hr style="border: none; height:1px; background-color:#c7c7c7">

<p><b>Title: </b><?= $cart['title']?></p>
<p><b>Item ID: </b><?= str_pad($cart['product_id'], 4, '0', STR_PAD_LEFT)?></p>
<p><b>Artist: </b><?= $cart['artist_display_name']?> </p>
<p><b>Price: ₱ </b><?= number_format($cart['price'], 2, '.', ',')?> x <?= $cart['quantity']?></p>


<?php endforeach; ?>

<hr>

<h4>Payment Summary</h4>
<p><b>Payment Method:</b> <?= $checkout_data['mode_of_payment']?></p>
<p><b>Subtotal:</b> ₱ <?= number_format($checkout_data['subtotal'], 2, '.', ',')?></p>
<?php if($checkout_data['voucher_code'] == 'None'):?>
    <p><b>Voucher: </b><?= $checkout_data['voucher_code']?></p>
<?php else: ?>
    <p><b>Voucher: </b><?= $checkout_data['voucher_code']?></p>
    <p><b>Discount: </b><?= $checkout_data['voucher_desc']?></p>
<?php endif; ?>
<p><b>TOTAL:</b> ₱ <?= number_format($checkout_data['total'], 2, '.', ',')?></p>
<hr>

<p>Keep making awesome stuff!</p>
<p>Doindie</p>

<?php
$message = ob_get_clean();
return $message;