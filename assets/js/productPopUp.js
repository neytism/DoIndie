
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

function openProductPopUp(event, base_url, product_id, image_name, title, artist, description, is_logged_in) {
    event.preventDefault();
    if (document.getElementById('product-container')) {
        closeProductPopUp();
    } else{

        if(is_logged_in){
            var add_to_cart_button = `<button onclick="addToCart(event,`+product_id+`,'`+base_url+`cart/addToCart'); event.stopPropagation();">Add to cart</button><br><br>`; 
        } else{
            var add_to_cart_button = `<button onclick="window.location='`+base_url+`logIn'; event.stopPropagation();">Add to cart</button><br><br>`; 
        }

        const login_popup_template = `
        <div style="position: fixed; background-color: #00000050 ; width: 100%; height: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;"
            id="product-container" onclick="closeProductPopUp();">
            <div style="background-color: white;  max-width: fit-content;" onclick="event.stopPropagation();">
                <div>
                    <img style="height: auto; max-width: 250px; min-width: 250px;"
                        src="`+base_url+`uploads/images/product_pictures/`+image_name+`">
                </div>
                
                <h2>Title: `+title+` </h2>
                <h3>Artist: `+artist+`</h3>
                <h4>Description: </h4>
                <p>`+description+`</p>
                `+add_to_cart_button+`
                <button onclick="closeProductPopUp(); event.stopPropagation();">Close</button>
            </div>

        </div>`;
        
        document.body.insertAdjacentHTML('beforebegin', login_popup_template);
    
    }
   
}

function closeProductPopUp() {
    const loginContainer = document.getElementById('product-container');
    if (loginContainer) {
        loginContainer.remove();
        
        // Optionally remove the script if no longer needed
        const script = document.getElementById('sendFormScript');
        if (script) {
            script.remove();
        }
    }
}
