<div style="z-index: 1000; position: fixed; background-color: #00000050 ; width: 100%; height: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;"
    id="product-container" onclick="closeProductPopUp();">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\checkout.css">
    <div class="checkoutLayout" style="display: flex; align-items: center; justify-content: center;">
        
        <div class="right" style="min-width: 60% ; max-width: 90%; margin: 50px 0; " onclick="event.stopPropagation();">
            
            <form id="add-product-form" class="form">
                
                <div class="group" style="padding: 20px;">
                    <img style="height: auto; min-width: 100%; max-width: 100%; border-radius: 10px; object-fit: contain;" src="<?php echo BASEURL; ?>uploads/images/product_pictures/default_product_picture.png" alt="">
                </div>
                
                <div class="group" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <h2 style="text-align: left; width: 100%;">Title: </h2>
                    <h3 style="text-align: left; width: 100%;">Artist: </h3>
                    <h4 style="text-align: left; width: 100%;">Description: </h4>
                    <p style="text-align: left; width: 100%; font-size: smaller; padding-top: 10px;">This is the description. </p>
                    <p style="text-align: left; width: 100%; font-size: smaller; padding-top: 10px;">Views: </p>
                    
                    <?php if ($is_logged_in): ?>
                        <button class="buttonCheckout full-width" onclick="addToCart(event,<?= $product['product_id'] ?>,'<?php echo BASEURL; ?>cart/addToCart'); event.stopPropagation();">Add to cart</button>
                    <?php else: ?>
                        <button class="buttonCheckout full-width" onclick="window.location='<?php echo BASEURL; ?>logIn'; event.stopPropagation();">Add to cart</button>
                    <?php endif; ?>
                    <button class="buttonCheckout full-width" onclick="closeProductPopUp(); event.stopPropagation();">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>