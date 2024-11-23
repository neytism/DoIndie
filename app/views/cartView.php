<?php 
$user_info = $data['user_info'];
$user_address = $data['user_address'];
?>
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
            
    </style>

</head>

<body>
    
<?php include 'app/views/navbarView.php'; ?>

    <!-- PRODUCT LIST START -->
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="checkoutLayout">

            
            <div class="returnCart">
                <a href="<?php echo BASEURL; ?>products" style="text-align: left; font-weight: normal;">← keep shopping</a>
                <h1>List Product in Cart</h1>
                <div class="list">

                    <?php if(count($data['cart_items']) <= 0):?>
                        <div class="item-new">
                            <div>
                                <h2>No items in cart.</h2>
                            </div>
                        </div>
                    <?php else:?>
                        <button class="b" onclick="selectAllItemsInCart(true)">Select All</button>
                        <button class="b" onclick="selectAllItemsInCart(false)">Unselect All</button><br><br>
                        <?php foreach($data['cart_items'] as $product):?>
                            <div class="item-new" id="cart-<?=$product['cart_id']?>">
                                <button class="delete" onclick="removeFromCart(event,<?=$product['cart_id']?>,'<?php echo BASEURL; ?>cart/removeFromCart')">x</button>
                                <table style="padding: 20px; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td id="cart-<?=$product['cart_id']?>"><input type="checkbox" onchange="updateCheckoutSummary()" style="margin: 10px;"></td>
                                            <td style="max-width: 100px; min-width: 100px;">
                                                <img style="width: auto; max-height: 100px; min-height: 100px;" src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>" alt="">
                                            </td>
                                            <td style="width: 100%; padding-left: 10px;">
                                                <table style="width: 100%; text-align: left;">
                                                    <tbody>
                                                        <tr><td style="text-align: left;">Title: <?= $product['title']?></td></tr>
                                                        <tr><td style="text-align: left; font-size: smaller;" id="price-<?=$product['cart_id']?>">Price: ₱ <?= number_format((float)$product['price'], 2, '.', '') ?></td></tr>
                                                        <tr><td style="text-align: left; font-size: smaller;" id="quantity-<?=$product['cart_id']?>">Quantity: <?= $product['quantity']?></td></tr>
                                                        <tr><td style="text-align: left; font-size: smaller;">
                                                            <button class="b-small" onclick="updateQuantity(event,<?=$product['cart_id']?>, 'decrease','<?php echo BASEURL; ?>cart/updateQuantity')">-</button>
                                                            <button class="b-small" onclick="updateQuantity(event,<?=$product['cart_id']?>, 'increase','<?php echo BASEURL; ?>cart/updateQuantity')">+</button>
                                                            </td>
                                                        </tr>
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
                    <?php endif;?>

                </div>
            </div>


            <div class="right">
                <h1 style="text-align: center; font-weight: bolder; text-decoration: underline; color: #f4e9dc;">CHECKOUT
                </h1><br>
                
                <form id="checkout-form" class="form">
                     
                    <div class="group full-width">
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" value='<?= $user_info['full_name'] ?>' required>
                    </div>

                    <div class="group full-width">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" id="phone_number" name="phone_number" value='<?= $user_info['phone_number'] ?>' required>
                    </div>

                    <div class="group">
                        <label for="region_id">Region</label>
                        <select name="region_id" id="region_id" onchange="checkRegion(this)" required>
                            <option></option>
                            <?php foreach ($data['regions'] as $region): ?>
                                <option value="<?= htmlspecialchars($region['regCode'])?>" <?php if( $region['id'] == $user_address['region_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($region['regDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group">
                        <label for="province_id">Province</label>
                        <select name="province_id" id="province_id" value="<?=$user_address['province_id']?>" onchange="checkProvince(this)" required>
                            <option></option>
                            <?php foreach ($data['provinces'] as $province): ?>
                                <option value="<?= htmlspecialchars($province['provCode'])?>" <?php if($province['id'] == $user_address['province_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($province['provDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group">
                        <label for="city_id">City</label>
                        <select  name="city_id" id="city_id" value="<?=$user_address['city_id']?>" onchange="checkCity(this)" required>
                            <option></option>
                            <?php foreach ($data['cities'] as $city): ?>
                                <option value="<?= htmlspecialchars($city['citymunCode'])?>" <?php if($city['id'] == $user_address['city_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($city['citymunDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group">
                        <label for="brgy_id">Barangay</label>
                        <select name="brgy_id" id="brgy_id" value="<?=$user_address['brgy_id']?>" onchange="" required>
                            <option></option>
                            <?php foreach ($data['brgys'] as $brgy): ?>
                                <option value="<?= htmlspecialchars($brgy['brgyCode'])?>" <?php if($brgy['id'] == $user_address['brgy_id']) echo 'selected'?>>
                                    <?= htmlspecialchars($brgy['brgyDesc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="group full-width">
                        <label for="detailed_address">Street, Building, and Number</label>
                        <input type="detailed_address" id="detailed_address" name="detailed_address" value='<?= $user_address['detailed_info'] ?>' required>
                    </div>

                    <div class="group full-width">
                        <label for="landmark">Landmark</label>
                        <input type="landmark" id="landmark" name="landmark" value='<?= $user_address['landmark'] ?>' required>
                    </div>

                    <div class="group full-width">
                        <label id="checkout-voucher" for="name">Voucher:</label>
                        <input type="text" id="voucher_input_code" name="voucher_input_code" placeholder="Enter voucher code." oninput ="checkVoucher('<?php echo BASEURL; ?>')">
                        <p id="voucher-error"></p>
                    </div>

                    <div class="group full-width">
                        <label for="mop">Mode of Payment</label>
                        <select name="mop" id="mop">
                            <option value="cod">Cash on Delivery</option>
                            <option value="gcash">Gcash</option>
                        </select>
                    </div>
                
                    
                </form>
                
                <div class="return">
                    <div class="row">
                        <div style="color: #f4e9dc">Subtotal</div>
                        <div id="checkout-subtotal" class="totalQuantity" style="color: #f4e9dc">₱ 0.00</div>
                    </div>
                    <div class="row">
                        <div style="color: #f4e9dc">Total Price</div>
                        <div id="checkout-total"  class="totalPrice" style="color: #f4e9dc">₱ 0.00</div>
                    </div>
                </div>
                
                <button form="checkout-form" type="submit" class="buttonCheckout" onclick="sendForm(event,'checkout-form','','<?php echo BASEURL; ?>profile/updateOnCheckout') ; proceedToCheckOutPage('checkout-form','<?php echo BASEURL; ?>')">CHECKOUT</button>
            </div>
        </div>
    </div>
    <!-- PRODUCT LIST END  -->
    
    <?php include 'app/views/footerView.php';?>

    <!-- JS FILE LINK -->
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/address.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>

</body>

</html>