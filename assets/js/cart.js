console.log('loaded cart.js script');

function addToCart(event, product_id, url) {
    event.preventDefault();
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.send('product_id=' + product_id);

}

function removeFromCart(event, product_id, url) {
    event.preventDefault();
    
    const cart_item = document.getElementById('cart-'+product_id);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.send('product_id=' + product_id);
    
    cart_item.remove();

}

function updateQuantity(event, product_id, action, url) {
    event.preventDefault();
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.send('product_id=' + product_id + '&action=' + action);
        
    const quantity_text = document.getElementById('quantity-'+product_id);
    var quantity = quantity_text.innerHTML.replace('Quantity: ','');
    
    const price_text = document.getElementById('price-'+product_id);
    const price = price_text.innerHTML.replace('Price: ₱ ','');
    
    const total_text = document.getElementById('total-'+product_id);
    var total = total_text.innerHTML.replace('Total: ₱ ','');
    
    
        
    if(action == 'increase'){
        quantity++;
    } else{
        quantity--;
        if(quantity == 0){
            const cart_item = document.getElementById('cart-'+product_id);
            cart_item.remove();
        }
    }
    
    quantity_text.innerHTML = 'Quantity: ' + quantity;
    
    total = price * quantity;
    total = total.toFixed(2);

    total_text.innerHTML = 'Total: ₱ ' + total;

    updateCheckoutTotal();
    
}

function updateCheckoutTotal(){
    let total = 0;

    const cartItems = document.querySelectorAll('div[id^="cart-"]');

    cartItems.forEach(cartItem => {
        const checkbox = cartItem.querySelector('input[type="checkbox"]');
        if (checkbox.checked) {
            const priceText = cartItem.querySelector('h4[id^="total-"]');
            const totalPrice = parseFloat(priceText.innerHTML.replace('Total: ₱ ', '').replace(',', ''));
            total += totalPrice;
        }
    });

    document.getElementById('checkout-total').innerHTML = 'Checkout: ₱ ' + total.toFixed(2);

}
