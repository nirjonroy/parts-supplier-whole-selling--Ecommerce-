//Navbar Button
var toggleOpen = document.getElementById('toggleOpen');
var toggleClose = document.getElementById('toggleClose');
var collapseMenu = document.getElementById('collapseMenu');

function handleClick() {
  if (collapseMenu.style.display === 'block') {
    collapseMenu.style.display = 'none';
  } else {
    collapseMenu.style.display = 'block';
  }
}

toggleOpen.addEventListener('click', handleClick);
toggleClose.addEventListener('click', handleClick);

//Hero Section Slider 
const slides = document.querySelectorAll('#slider > div');
const dots = document.querySelectorAll('#slider-dots .dot');
let currentIndex = 0;
const totalSlides = slides.length;
const slideInterval = 3000;

function updateSlider() {
  // Update slide position
  document.getElementById('slider').style.transform = `translateX(-${currentIndex * 100}%)`;

  // Update active dot
  dots.forEach((dot, index) => {
    dot.classList.toggle('bg-gray-400', index !== currentIndex);
    dot.classList.toggle('bg-blue-500', index === currentIndex);
  });
}

function showNextSlide() {
  currentIndex = (currentIndex + 1) % totalSlides;
  updateSlider();
}

// Auto-play the slider
let slideTimer = setInterval(showNextSlide, slideInterval);

// Dot navigation
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    currentIndex = index;
    updateSlider();

    // Reset the timer
    clearInterval(slideTimer);
    slideTimer = setInterval(showNextSlide, slideInterval);
  });
});

//Owl Carousel 
$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    items: 4, 
    margin: 10,
    responsive: {
      0: {
        items: 2,
      },
      768: {
        items: 4,
      },
      1068: {
        items: 5,
      },
      1268: {
        items: 6,
      },
    },
    loop: true, 
    autoplayTimeout: 3000,
    autoplayHoverPause: true, 
  });
});
     //Product Details Animation
      const mainImage = document.getElementById("mainImage");
          
     
      const thumbnails = document.querySelectorAll(".thumbnail");
    
      
      thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener("click", () => {
         
          mainImage.classList.add("opacity-0");
    
          
          setTimeout(() => {
            mainImage.src = thumbnail.src;
            mainImage.classList.remove("opacity-0");
          }, 300); 
        });
      });
      //Thank you Modal
      function showThankYouModal() {
        // Get modal element
        const modal = document.getElementById('thankYouModal');
        
        // Show the modal by setting display to flex
        modal.style.display = 'flex';
        
        // Automatically hide the modal after 2 seconds
        setTimeout(() => {
          modal.style.display = 'none';
        }, 2000);
      }
      
    