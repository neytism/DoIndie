<?php include 'app/views/navbarView.php'; ?>

<h2>DoIndie Cart Page</h2>

<h2 id="checkout-total">Checkout: ₱ 0.00</h2>

<?php if(count($data['cart_items']) <= 0):?>
    <p>No items in cart.</p>
<?php else:?>
    <?php foreach($data['cart_items'] as $product):?>
        <div style="background-color: #dbdbdb; padding: 10px; border-radius: 5px;" id="cart-<?=$product['product_id']?>"> <?php // bruh is should just use the cart_id?>
            <input type="checkbox" onchange="updateCheckoutTotal()">
            <div>
                <img
                style="width: auto; max-height: 80px; min-height: 80px;"
                src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>"
                alt="">
            </div>
            <h3>Title: <?= $product['title']?></h3>
            <h4 id="price-<?=$product['product_id']?>">Price: ₱ <?= number_format((float)$product['price'], 2, '.', '') ?></h4>
            <h4 id="quantity-<?=$product['product_id']?>">Quantity: <?= $product['quantity']?></h4>
            <button onclick="updateQuantity(event,<?=$product['product_id']?>, 'decrease','<?php echo BASEURL; ?>cart/updateQuantity')">-</button>
            <button onclick="updateQuantity(event,<?=$product['product_id']?>, 'increase','<?php echo BASEURL; ?>cart/updateQuantity')">+</button>
            <h4 id="total-<?=$product['product_id']?>">Total: ₱ <?= number_format((int)$product['quantity'] * (float)$product['price'], 2, '.', '') ;?></h4>
            <button onclick="removeFromCart(event,<?=$product['product_id']?>,'<?php echo BASEURL; ?>cart/removeFromCart')">Remove</button>
        </div><br>
    <?php endforeach; ?>
<?php endif;?>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>