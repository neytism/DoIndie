<h2>Add new Product</h2>

<p id="error-message" style="color: red;"></p>

<form id="add-product-form" method="POST" enctype="multipart/form-data">
    <div><img style="height: auto; max-width: 250px" src="<?php echo BASEURL; ?>uploads/images/product_pictures/default_product_picture.png" alt=""></div><br>
    <label for="image">Image:</label><br>
    <input type="file" name="image" id="image" accept="image/*" required><br><br>
    
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="product_description">Description:</label><br>
    <textarea id="product_description" name="product_description"></textarea><br><br>
    
    <label for="price">Price:</label><br>
    <input type="number" id="price" min="0.1" step="any" name="price" required><br><br>
    
    <label for="product_category_id">Category:</label><br>
    <select name="product_category_id" id="product_category_id">
        <option value="">Please choose an option</option>
        <?php foreach ($data['product_categories'] as $category): ?>
            <option value="<?= htmlspecialchars($category['product_category_id']) ?>">
                <?= htmlspecialchars($category['product_category_name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    
    <label for="tags">Tags:</label><br>
    <input type="text" id="tags" name="tags" required><br><br>
    
    <input type="submit" value="Upload" onclick="sendForm(event,'add-product-form','error-message','<?php echo BASEURL; ?>addProduct/checkProduct')">
    
    <input type="button" value="Back" onclick="history.back()">
</form>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/sendForm.js"></script>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/updateUploadImage.js"></script>
