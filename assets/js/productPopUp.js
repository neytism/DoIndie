
// function openLoginPopUp(event, url, baseUrl) {
    
//     event.preventDefault();
   
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', url, true);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             //modify on where to put the login form
//             document.body.insertAdjacentHTML('beforeend', xhr.responseText);
            
//             if (!document.getElementById('sendFormScript')) {
//                 const script = document.createElement('script');
//                 script.src = baseUrl+'assets/js/sendForm.js';
//                 script.id = 'sendFormScript';
//                 document.body.appendChild(script);
//             }
            
//             // Optional: scroll to the newly added login form
//             //document.getElementById('login-form').scrollIntoView();
//         }
//     };
//     xhr.send();
// }

let timer_for_view_increase;

function openProductPopUp(event, base_url, product_id, image_name, title, artist, description, view_count, is_logged_in, is_self) {
    event.preventDefault();
    if (document.getElementById('product-container')) {
        closeProductPopUp();
    } else{
        
        if(is_logged_in){
            if(is_self == 'true'){
                var add_to_cart_button = `<button style="cursor: pointer;" class="buttonCheckout full-width" onclick="addToCart(event,`+product_id+`,'`+base_url+`cart/addToCart'); event.stopPropagation();">Add to cart</button>`; 
            } else{
                var add_to_cart_button = `<button style="cursor: pointer;" class="buttonCheckout full-width faded">Add to cart</button>`; 
            }
        } else{
            var add_to_cart_button = `<button style="cursor: pointer;" class="buttonCheckout full-width" onclick="window.location='`+base_url+`logIn'; event.stopPropagation();">Add to cart</button>`; 
        }
        
        if(is_self == 'true'){
            var edit_button = `<button style="cursor: pointer;" class="buttonCheckout full-width" onclick="window.location='`+base_url+`products/edit/`+product_id+`'; event.stopPropagation();">Edit Product</button>`; 
        } else{
            var edit_button = ``; 
        }
        
        const login_popup_template = `
            <div style="z-index: 1000; position: fixed; background-color: #00000050 ; width: 100%; height: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;"
                id="product-container" onclick="closeProductPopUp();">
                <link rel="stylesheet" type="text/css" href="`+base_url+`assets/css/checkout.css">
                <div class="checkoutLayout" style="display: flex; align-items: center; justify-content: center; max-height: 50vh;">
                    
                    <div class="right" style="min-width: 60% ; max-width: 90%; margin: 50px 0; " onclick="event.stopPropagation();">
                        
                        <form id="add-product-form" class="form">
                            
                            <div class="group" style="padding: 20px;">
                                <img style="height: auto; min-width: 500px; max-width: 500px; border-radius: 10px; object-fit: contain;" src="`+base_url+`uploads/images/product_pictures/`+image_name+`" alt="`+title+`">
                            </div>
                            
                            <div class="group" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                <h2 style="text-align: left; width: 100%;">Title: `+title+`</h2>
                                <h3 style="text-align: left; width: 100%;">Artist: `+artist+`</h3>
                                <h4 style="text-align: left; width: 100%;">Description: </h4>
                                <p style="text-align: left; width: 100%; font-size: smaller; padding-top: 10px;">`+description+`</p>
                                <p style="text-align: left; width: 100%; font-size: smaller; padding-top: 10px;">View/s: `+ view_count +`</p>
                                
                                `+ add_to_cart_button + edit_button +`
                                <button class="buttonCheckout full-width" style="cursor: pointer;" onclick="closeProductPopUp(); event.stopPropagation();">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            `;
        
        document.body.insertAdjacentHTML('beforebegin', login_popup_template);

        timer_for_view_increase = setTimeout(() => {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', `${base_url}products/increaseViewCount`, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(`product_id=${product_id}`);
        }, 1500); // 1.5 secs
            
    }
   
}

function closeProductPopUp() {
    const loginContainer = document.getElementById('product-container');
    if (loginContainer) {
        loginContainer.remove();

        clearTimeout(timer_for_view_increase);
        
        // Optionally remove the script if no longer needed
        const script = document.getElementById('sendFormScript');
        if (script) {
            script.remove();
        }
    }
}
