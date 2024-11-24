<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\products.css">
    <title>Artists</title>
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>assets\img\LOGO.png">
    
    <!-- Swiper Stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        .swiper {
            height: 380px;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: #2f1a09;
        }
        
        .swiper-slide img {
            object-fit: cover;
            border-radius: 20px;
        }

        .swiper-slide h3 {
            padding-top: 10px;
        }
        
        .add-to-cart {
            background-color: #423329;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .faded {
            opacity: 0.5;
        }
        
        .add-to-cart:hover {
            color: #ff7200;
            background-color: #2f1a09; 
        }
            
    </style>
</head>

<body style="background-repeat: no-repeat center center fixed;">

    <?php include 'app/views/navbarView.php'; ?>

    <!-- PRODUCTS SECTION -->
    <div class="col-md-6">
        <h1 style="color: #423329; font-size: 120px; margin-bottom: 15px; text-align:right; margin-right: 0;">Artists
        </h1>
        <div class="products">
            <?php foreach ($data['artist_categories'] as $category): ?>
                <?php
                $hasProducts = false;

                // Check each product to see if it belongs to the current category
                foreach ($data['all_artists'] as $product) {
                    if ($product['artist_category_id'] == $category['artist_category_id']) {
                        $hasProducts = true;
                        break;
                    }
                }

                if ($hasProducts): ?>
                    <div class="product-item">
                        <a
                            href="#<?= htmlspecialchars($category['artist_category_name']) ?>-gallery"><?= htmlspecialchars($category['artist_category_name']) ?></a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div id="all-gallery" class="gallery-section" >
        <h2 >All</h2>
        <br><br>
        <div class="swiper">
            <div class="swiper-wrapper">
                
                <?php foreach ($data['all_artists'] as $product): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo BASEURL; ?>profile/user/<?=$product['username']?>">
                            <img src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $product['picture_path'] ?>"
                                width="240" height="240" alt="<?= htmlspecialchars($product['artist_display_name']) ?>"
                                title="<?= htmlspecialchars($product['artist_display_name']) ?>" />
                        </a>
                        <h3><?= htmlspecialchars($product['artist_display_name']) ?></h3>
                        <h4 style="font-size: smaller;"><?= htmlspecialchars($product['artist_category_name']) ?></h4>
                        <a href="<?php echo BASEURL; ?>profile/user/<?=$product['username']?>"><button class="add-to-cart">See Profile</button><br></a>
                        

                    </div>
                <?php endforeach; ?>

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
     
    <!-- show products per category -->
    <?php foreach ($data['artist_categories'] as $category): ?>
        <?php
        $hasProducts = false;
        $products = array();

        // Check each product to see if it belongs to the current category
        foreach ($data['all_artists'] as $product) {
            if ($product['artist_category_id'] == $category['artist_category_id']) {
                array_push($products, $product);
                $hasProducts = true;
            }
        }

        if ($hasProducts): ?>
            <div id="<?= htmlspecialchars($category['artist_category_name']) ?>-gallery" class="gallery-section" >
                <h2 ><?= htmlspecialchars($category['artist_category_name']) ?></h2>
                <br><br>
                <div class="swiper">
                    <div class="swiper-wrapper">
    
                        <?php foreach ($products as $product): ?>
                            <div class="swiper-slide">
                                <a href="CHANGE_LINK">
                                    <img src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $product['picture_path'] ?>"
                                        width="240" height="240" alt="<?= htmlspecialchars($product['artist_display_name']) ?>"
                                        title="<?= htmlspecialchars($product['artist_display_name']) ?>" />
                                </a>
                                <h3><?= htmlspecialchars($product['artist_display_name']) ?></h3>
                                <h4 style="font-size: smaller;"><?= htmlspecialchars($product['artist_category_name']) ?></h4>
                                <a href="<?php echo BASEURL; ?>profile/user/<?=$product['username']?>"><button class="add-to-cart">See Profile</button><br></a>
                            </div>
                        <?php endforeach; ?>
    
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <?php include 'app/views/footerView.php';?>
    
    <!-- CART PORTION -->
    <div class="cart">
        <h2>
            CART
        </h2>

        <div class="listCart">
            <div class="item">
                <!-- empty -->
            </div>


        </div>
        
        <div class="buttons">
            <div class="close">
                CLOSE
            </div>
            <div class="checkout">
                <a href="checkout.html">CHECKOUT</a>
            </div>
        </div>
    </div>
    <!-- END CART PORTION -->

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/cart.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/productPopUp.js"></script>

    <!-- External JS File -->
    <script src="<?php echo BASEURL; ?>assets\js\products.js"></script>
</body>

</html>