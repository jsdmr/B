document.addEventListener('DOMContentLoaded', () => {
    if (typeof Swiper !== 'undefined') {
        new Swiper('.hero-slider', {
            loop: true,
            autoplay: { delay: 5000 },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
});
