
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>assets\img\LOGO.png" />
    <title>Add Product</title>
    
    <!-- CSS FILE LINK -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\checkout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    

</head>

<body>
    
    <div class="container" style="width: 100%; max-width: 100%">
        <div class="checkoutLayout" style="display: flex; align-items: center; justify-content: center;">
            
            <div class="right" style="max-width: 50%; margin: 50px 0;">
                <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc;">ADD NEW PRODUCT
                </h1><br>           
                
                <form id="add-product-form" class="form">

                    <div class="group" style="padding: 20px;">
                        <img style="height: auto; min-width: 100%; max-width: 100%; border-radius: 10px; object-fit: contain;" src="<?php echo BASEURL; ?>uploads/images/product_pictures/default_product_picture.png" alt="">
                    </div>
                    
                    <div class="group" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" accept="image/*"><br>
                    </div>

                    <div class="group full-width">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="group full-width">
                        <label for="product_description">Description:</label><br>
                        <textarea id="product_description" name="product_description"></textarea>
                    </div>

                    <div class="group full-width">
                        <label for="tags">Tags:</label><br>
                        <input type="text" id="tags" name="tags" required>
                    </div>
                    
                    <div class="group full-width">
                        <label for="product_category_id">Product Category</label>
                        <select name="product_category_id" id="product_category_id" required>
                            <option value="">Please choose an option</option>
                            <?php foreach ($data['product_categories'] as $category): ?>
                                <option value="<?= htmlspecialchars($category['product_category_id']) ?>">
                                    <?= htmlspecialchars($category['product_category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="group full-width">
                        <label for="price">Price:</label><br>
                        <input type="number" id="price" min="0.1" step="any" name="price" required>
                    </div>

                    <p class="full-width" id="error-message" style="color: #760f14;"></p>
                    
                    <button form="add-product-form" class="buttonCheckout full-width" type="submit"  onclick="sendForm(event,'add-product-form','error-message','<?php echo BASEURL; ?>addProduct/checkProduct')">Upload</button>

                    <button class="buttonCheckout full-width" type="button"  onclick="history.back()">Back</button>
                    
                </form>
                
            </div>
        </div>
    
    </div>
    
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/address.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/updateUploadImage.js"></script>

</body>

</html>

