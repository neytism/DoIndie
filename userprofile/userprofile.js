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