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

// CART PORTION
let cartLink = document.querySelector('.cart-link'); // Select the cart link
let cart = document.querySelector('.cart');
let close = document.querySelector('.close');

cartLink.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    if (cart.style.right == '-100%') {
        cart.style.right = '0';
    } else {
        cart.style.right = '-100%';
    }
});

close.addEventListener('click', function() {
    cart.style.right = '-100%';
});