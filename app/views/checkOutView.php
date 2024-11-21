<?php $selected_carts = $data['selected_carts']?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>assets\img\LOGO.png" />
    <title>DoIndie</title>

    <!-- CSS FILE LINK -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\checkout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <style>
        .b {
            background-color: #423329;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .b:hover ,.b-small:hover {
            color: #ff7200;
            background-color: #2f1a09; 
        }
    

        .b-small{
            font-size: 18px;
            background-color: #423329;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            height: 25px;
            width: 25px;
        }
    
        
        .item-new{
            position: relative;
            width: 750px;
            margin-bottom: 30px;
            padding: 0 10px;
            box-shadow: 0 10px 20px #5555;
            border-radius: 20px;
        }
        
        .delete {
            background-color: transparent;
            border: none;
            color: #423329 ;
            font-size: 20px;
            cursor: pointer;
            position: absolute; 
            top: 10px; 
            right: 20px;
        }
        
        .delete:hover {
            color: red; /* Optional hover effect */
        }
        
        .container-new{
            width: 100%;
            margin: auto;
            max-width: 90%;
            transition: transform 1s;
            display: flex;
            flex-direction: column; 
            align-items: center;
        }
            
    </style>

</head>

<body>
    
<?php include 'app/views/navbarView.php'; ?>

    <!-- PRODUCT LIST START -->
    <div class="container-new" style="margin-top: 80px; margin-bottom: 160px; align-items: center;">
    
    <h3>CHECKOUT</h3><br>

    <p id="error-message" style="color: red;"></p>

    <p><b>Username: </b><?= $data['user_info']['username']?></p>
    <p><b>Email: </b><?= $data['user_info']['email']?></p>
    <?php if($data['user_info']['is_verified_email'] == 'false'):?>
    <p style="color: red;">IMPORTANT: Verify your email on the profile page to make a purchase.</p>
    <?php endif; ?>
    
    <?php if(empty(preg_replace('/\s+/', '', str_replace(',','', $data['address'])))):?>
    <p><b>Address: </b>No address.</p>
    <p style="color: red;">IMPORTANT: Add or complete an address on the profile page to make a purchase.</p>
    <?php else:; ?>
    <p><b>Address: </b><?= $data['address']?></p>
    <?php endif; ?><br><br>

            <?php foreach($selected_carts as $product):?>
                <div class="item-new" id="cart-<?=$product['cart_id']?>">
                    <table style="padding: 20px; width: 100%;">
                        <tbody>
                            <tr>
                                <td style="max-width: 100px; min-width: 100px;">
                                    <img style="width: auto; max-height: 100px; min-height: 100px;" src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>" alt="">
                                </td>
                                <td style="width: 100%; padding-left: 10px;">
                                    <table style="width: 100%; text-align: left;">
                                        <tbody>
                                            <tr><td style="text-align: left;">Title: <?= $product['title']?></td></tr>
                                            <tr><td style="text-align: left; font-size: smaller;">Artist: <?=$product['username']?> aka <?=$product['artist_display_name']?></tr>
                                            <tr><td style="text-align: left; font-size: smaller;" id="price-<?=$product['cart_id']?>">Price: ₱ <?= number_format((float)$product['price'], 2, '.', '') ?></td></tr>
                                            <tr><td style="text-align: left; font-size: smaller;" id="quantity-<?=$product['cart_id']?>">Quantity: <?= $product['quantity']?></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td >
                                    <h4 style="width: 100px; font-size: 18px;" id="total-<?=$product['cart_id']?>">₱ <?= number_format((int)$product['quantity'] * (float)$product['price'], 2, '.', '') ;?></h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
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
        
        <p><b>TOTAL: </b>₱ <?= $data['total']?></p><br>

        <?php if($data['user_info']['is_verified_email'] == 'false' || empty(preg_replace('/\s+/', '', str_replace(',','', $data['address'])))):?>
            <button class="b" disabled>CONFIRM</button>
        <?php else: ?>
            <button class="b" onclick="window.location='<?php echo BASEURL; ?>checkOut/confirmOrder'">CONFIRM</button>
        <?php endif; ?>
        
        <button class="b" onclick="window.location='<?php echo BASEURL; ?>cart'">GO BACK TO CART</button>

        
    </div>
    <!-- PRODUCT LIST END -->

    <!-- FOOTER START -->
    <div class="footer">
        <ul class="row-list center">
            <li><a class="rowItem">Home</a></li>
            <li><a class="rowItem">Products</a></li>
            <li><a class="rowItem">Shopping Cart</a></li>
            <li><a class="rowItem">Profile</a></li>
            <li><a class="rowItem">About Us</a></li>
        </ul>
        <ul class="row-list center">
            <a href="https://www.facebook.com" class="fa fa-facebook" style="font-size: 40px;" target="_blank"></a>
            <a href="https://www.youtube.com" class="fa fa-youtube" style="font-size: 40px;" target="_blank"></a>
            <a href="https://www.twitter.com" class="fa fa-twitter" style="font-size: 40px;" target="_blank"></a>
            <a href="https://www.instagram.com" class="fa fa-instagram" style="font-size: 40px;" target="_blank"></a>
            <a href="https://www.tumblr.com" class="fa fa-tumblr" style="font-size: 40px;" target="_blank"></a>
        </ul>
        <p style="color: #f4e9dc">&copy; 2024 DoIndie. All rights reserved.</p>
    </div>
    </div>
    <!-- FOOTER END -->

    <!-- JS FILE LINK -->
    <script src="http://localhost:8000/DoIndie/assets/js/sendForm.js" id="sendFormScript"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>

</body>

</html>