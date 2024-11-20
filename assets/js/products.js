const swiper = new Swiper('.swiper', {
    loop: true, 
    spaceBetween: 10, 
    slidesPerView: 5, 
    centeredSlides: false,
	
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev', 
    },
});

let cart = [];

        function toggleCart() {
            const cartSidebar = document.querySelector('.cart-sidebar');
            const overlay = document.getElementById('overlay');

            if (cart.length > 0) {
                cartSidebar.classList.add('active');
                overlay.style.display = 'block'; // Show overlay
            } else {
                cartSidebar.classList.remove("active");
                overlay.style.display = 'none'; // Hide overlay
            }
        }

        document.getElementById('overlay').addEventListener('click', () => {
            const cartSidebar = document.querySelector('.cart-sidebar');
            const overlay = document.getElementById('overlay');

            cartSidebar.classList.remove("active");
            overlay.style.display = 'none';
        });

        function updateCartLink() {
            const cartLink = document.querySelector('.cart-link');
            const itemCount = cart.length;
            cartLink.textContent = `CART(${itemCount})`;
        }

        function renderCart() {
            const cartItems = document.querySelector('.cart-item');
            const cartSidebar = document.querySelector('.cart-sidebar');
            const overlay = document.getElementById('overlay'); // Assuming you added the overlay                
            cartItems.innerHTML = ''; // Clear existing items

            let totalPrice = 0;

            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');

                cartItem.innerHTML = `
                    <p>${item.name} (${item.quantity})</p>
                    <p>$${(item.price * item.quantity).toFixed(2)}</p>
                    <p class="remove-item" data-id="${item.id}">Remove</p>
                `;

                cartItems.appendChild(cartItem);
                totalPrice += item.price * item.quantity;
            });

            document.getElementById('total-price').textContent = `Total: $${totalPrice.toFixed(2)}`;

            // Add event listeners to remove buttons
            document.querySelectorAll(".remove-item").forEach(button => {
                button.addEventListener("click", function () {
                    const productId = this.getAttribute("data-id");
                    cart = cart.filter(item => item.id !== productId); // Remove the item
                    renderCart(); // Re-render the cart
                });
            });

            // Check if the cart is empty
            if (cart.length === 0) {
                cartSidebar.classList.remove("active"); // Hide the cart sidebar
                if (overlay) overlay.style.display = 'none'; // Hide overlay if added
            }
            updateCartLink();
        }

        // Add event listener when CART link was click
        document.querySelector('.cart-link').addEventListener('click', toggleCart);

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                event.preventDefault(); // Prevent the default behavior of the <a> tag

                const productId = button.getAttribute('data-id');
                const productName = button.getAttribute('data-name');   
                const productPrice = parseFloat(button.getAttribute('data-price'));
                const existingItem = cart.find(item => item.id === productId);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    });
                }
                renderCart();
            });
        });