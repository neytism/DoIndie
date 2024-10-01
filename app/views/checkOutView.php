<h3>Checkout</h3>

<p id="error-message" style="color: red;"></p>
<?php $selected_carts = $data['selected_carts']?>
<?= print_r($selected_carts) ?>
<?php foreach($selected_carts as $product):?>
<?= $product['title'] ?>
<?php endforeach; ?>

<p><b>Username: </b>asdf</p>
<p><b>Email: </b>asdf</p>
<p style="color: red;">IMPORTANT: Verify your email to make purchases.</p>
    
<label for="address">Address:</label><br>
<textarea type="text" id="address" name="address" placeholder="asdf if exist" required></textarea><br><br>

<h4>Items: </h4>
<img
style="width: auto; max-height: 80px; min-height: 80px;"
src="<?php echo BASEURL; ?>uploads/images/product_pictures/default_product_picture.png"
alt=""><br>
<p>Title: </p>
<p>Artist: </p>
<p>Quantity: </p>
<p>Price: </p>

<h4>Payment Summary</h4>
<p><b>Payment Method: </b>asdf</p>
<p><b>Subtotal: </b>asdf</p>
<p><b>Voucher: </b>asdf</p>
<p><b>TOTAL: </b>asdf</p>

<button onclick="">CONFIRM</button>

<script src="http://localhost:8000/DoIndie/assets/js/sendForm.js" id="sendFormScript"></script>