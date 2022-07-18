// Samuel Mereau 2022
document.addEventListener('DOMContentLoaded', (ev) => {
    // Instantiate a new swiper
    const swiper = new Swiper('.swiper', {
        loop: true, // Slides loop over when reaching the end
        speed: 1000, // The speed of the transition (e.g 1sec)
        pagination: {
            el: '.swiper-pagination', // The class to apply to pagination buttons
            clickable: true, // Pagination buttons are clickable
        },
        autoplay: {
            delay: 5000, // The delay until slide automatically transitions (e.g 5sec)
            pauseOnMouseEnter: true, // Slideshow pauses when mouse enters slideshow
            disableOnInteraction: false, // Ensure the slideshow won't permanently stop when hovered over or click on
        },
    });
})