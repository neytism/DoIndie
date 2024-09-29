<h2>Add new Product</h2>

<p id="error-message" style="color: red;"></p>

<form id="add-product-form" method="POST">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>
    
    <label for="price">Price:</label><br>
    <input type="number" id="price" min="0.1" step="any" name="price" required><br><br>
    
    <label for="product_category_id">Category:</label><br>
    <select name="product_category_id" id="product_category_id">
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
