// slider.js

document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelector('.slideshow__slides');
    const slide = document.querySelectorAll('.slideshow__slide');
    const prev = document.querySelector('.slideshow__button--prev');
    const next = document.querySelector('.slideshow__button--next');

    let currentIndex = 0;

    function showSlide(index) {
        slides.style.transform = `translateX(${-index * 100}%)`;
    }

    prev.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = slide.length - 1;
        }
        showSlide(currentIndex);
    });

    next.addEventListener('click', function() {
        if (currentIndex < slide.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        showSlide(currentIndex);
    });

    showSlide(currentIndex); // Initialize with the first slide shown
});
