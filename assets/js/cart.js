let timer_for_checking_voucher;
var global_voucher_code = ''; // use this for checkout
var global_discount_value = '';
var global_discount_type = '';


function addToCart(event, product_id, url) {
    event.preventDefault();
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.send('product_id=' + product_id);

}

function removeFromCart(event, cart_id, url) {
    event.preventDefault();
    
    const cart_item = document.getElementById('cart-'+cart_id);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.send('cart_id=' + cart_id);
    
    cart_item.remove();

}

function updateQuantity(event, cart_id, action, url) {
    event.preventDefault();
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.send('cart_id=' + cart_id + '&action=' + action);
        
    const quantity_text = document.getElementById('quantity-'+cart_id);
    var quantity = quantity_text.innerHTML.replace('Quantity: ','');
    
    const price_text = document.getElementById('price-'+cart_id);
    const price = price_text.innerHTML.replace('Price: ₱ ','');
    
    const total_text = document.getElementById('total-'+cart_id);
    var total = total_text.innerHTML.replace('Total: ₱ ','');
    
    
        
    if(action == 'increase'){
        quantity++;
    } else{
        quantity--;
        if(quantity == 0){
            const cart_item = document.getElementById('cart-'+cart_id);
            cart_item.remove();
        }
    }
    
    quantity_text.innerHTML = 'Quantity: ' + quantity;
    
    total = price * quantity;
    total = total.toFixed(2);

    total_text.innerHTML = 'Total: ₱ ' + total;

    updateCheckoutSummary();
    
}

function selectAllItemsInCart(b){
    
    const cartItems = document.querySelectorAll('div[id^="cart-"]');
    cartItems.forEach(cartItem => {
        cartItem.querySelector('input[type="checkbox"]').checked = b;
    });
    
    updateCheckoutSummary();

}

function checkVoucher(base_url){
    clearTimeout(timer_for_checking_voucher);
    const voucher_error_text = document.getElementById('voucher-error');
    const voucher_text = document.getElementById('checkout-voucher');
    voucher_error_text.innerHTML = '';
    voucher_text.innerHTML = 'Voucher: ';

    global_discount_type = '';
    global_discount_value = '';
    global_voucher_code = '';

    updateCheckoutSummary();

    timer_for_checking_voucher = setTimeout(() => {
        const voucher_code = document.getElementById('voucher_input_code').value;

        if(voucher_code === "") {
            return;
        };
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', base_url + 'cart/checkVoucher/' + voucher_code, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                const response = xhr.responseText
                var [result, message, discount_value, discount_type] = response.split("|");
    
                if(result == 'valid'){
                    voucher_error_text.style.color = 'green';
                    voucher_error_text.innerHTML = message;
                    
                    global_voucher_code = voucher_code;
                    global_discount_type = discount_type;
                    global_discount_value = discount_value;                    
                    
                    if(discount_type == 'percentage'){
                        voucher_text.innerHTML = 'Voucher: ' + discount_value + '% OFF';
                    }else{
                        voucher_text.innerHTML = 'Voucher: ₱ ' + discount_value + ' LESS';
                    }
                    
                    updateCheckoutSummary();

                }else{
                    voucher_error_text.style.color = 'red';
                    voucher_error_text.innerHTML = message;
                }
                
            } 
        };
    
        xhr.send(`voucher_code=${voucher_code}`);

    }, 2000); // 2 secs

}

function updateCheckoutSummary(){
    let sub_total = 0;
    let total = 0;

    
    const cartItems = document.querySelectorAll('div[id^="cart-"]');
    
    cartItems.forEach(cartItem => {
        const checkbox = cartItem.querySelector('input[type="checkbox"]');
        if (checkbox.checked) {
            const priceText = cartItem.querySelector('h4[id^="total-"]');
            const totalPrice = parseFloat(priceText.innerHTML.replace('Total: ₱ ', '').replace(',', ''));
            sub_total += totalPrice;
        }
    });

    total = sub_total;
    
    document.getElementById('checkout-subtotal').innerHTML = 'Subtotal: ₱ ' + sub_total.toFixed(2);

    if(global_discount_value != ''){
        if(global_discount_type == 'fixed'){
            total = total - parseFloat(global_discount_value);
        } else{
            total = total * (parseFloat(global_discount_value) * 0.01);
        }
    }
    
    document.getElementById('checkout-total').innerHTML = 'Total: ₱ ' + total.toFixed(2);

}
