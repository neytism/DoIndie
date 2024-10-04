document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper(".swiper", {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
