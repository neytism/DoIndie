const swiper = new Swiper('.swiper', {

    loop: true, 
    spaceBetween: 10, 
    slidesPerView: 5, 
    centeredSlides: false, 

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev', 
    },

    // Responsive 
    breakpoints: {
        640: {
            slidesPerView: 2, 
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3, 
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 40,
        },
    },
});
