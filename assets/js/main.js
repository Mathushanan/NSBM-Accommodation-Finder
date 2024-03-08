/*=============== SWIPER JS ===============*/
let swiperCards = new Swiper(".card__content", {
  loop: true,
  spaceBetween: 32,
  grabCursor: true,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints:{
    600: {
      slidesPerView: 2,
    },
    968: {
      slidesPerView: 3,
    },
  },
});


const slider = document.querySelector('.slider');
const slides = document.querySelector('.slides');
const cards = document.querySelectorAll('.popular__card');

let currentIndex = 0;
const slideWidth = cards[0].offsetWidth;

function nextSlide() {
    currentIndex++;
    if (currentIndex >= cards.length) {
        currentIndex = 0;
    }
    updateSlidePosition();
}

function updateSlidePosition() {
    const newPosition = -currentIndex * slideWidth;
    slides.style.transform = `translateX(${newPosition}px)`;
}

setInterval(nextSlide, 3000); // Change slide every 3 seconds
