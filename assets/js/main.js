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
const pagination = document.querySelector('.pagination');

let currentIndex = 0;
const slideWidth = cards[0].offsetWidth;
const totalSlides = cards.length;

// Create pagination dots
for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement('span');
    dot.classList.add('dot');
    dot.setAttribute('data-index', i);
    dot.addEventListener('click', function() {
        currentIndex = i;
        updateSlidePosition();
        updatePagination();
    });
    pagination.appendChild(dot);
}

const dots = document.querySelectorAll('.dot');

function nextSlide() {
    currentIndex++;
    if (currentIndex >= totalSlides) {
        currentIndex = 0;
    }
    updateSlidePosition();
    updatePagination();
}

function updateSlidePosition() {
    const newPosition = -currentIndex * slideWidth;
    slides.style.transform = `translateX(${newPosition}px)`;
}

function updatePagination() {
    dots.forEach((dot, index) => {
        if (index === currentIndex) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

// Don't need to rotate it automatically, so remove this line:
// setInterval(nextSlide, 3000); // Change slide every 3 seconds

updatePagination(); // Update pagination initially
