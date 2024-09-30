<div style="position: fixed; background-color: #00000050 ; width: 100%; height: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;"
    id="product-container" onclick="closeProductPopUp();">
    <div style="background-color: white;  max-width: fit-content;" onclick="event.stopPropagation();">
        <div>
            <img style="height: auto; max-width: 250px; min-width: 250px;"
                src="<?php echo BASEURL; ?>uploads/images/product_pictures/default_product_picture.png">
        </div>
        
        <h2>Title: </h2>
        <h3>Artist: </h3>
        <h4>Description: </h4>
        <p></p>
        <?php if ($is_logged_in): ?>
            <button onclick="addToCart(event,<?=$product['product_id']?>,'<?php echo BASEURL; ?>cart/addToCart'); event.stopPropagation();">Add to cart</button><br><br>
        <?php else: ?>
            <button onclick="window.location='<?php echo BASEURL; ?>logIn'; event.stopPropagation();">Add to cart</button><br><br>
        <?php endif; ?>
        <button onclick="closeProductPopUp(); event.stopPropagation();">Close</button>
    </div>

</div>