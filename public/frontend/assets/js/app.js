// Initialize slick carousel for '.single-item-rtl' class
$(document).ready(function () {
  $('.single-item-rtl').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
  });
});

// Function to display the message when "Add to cart" button is clicked
const click = () => {
  $('#addToCartModal').modal('show');
}

// Initialize slick carousel for '.responsive' class with responsive settings
$('.responsive').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

// Increment and decrement quantity
document.addEventListener("DOMContentLoaded", function () {
  const decrementBtn = document.querySelector(".card-quanitiy span:nth-child(1)");
  const incrementBtn = document.querySelector(".card-quanitiy span:nth-child(3)");
  const addToCartBtn = document.querySelector(".card-quanitiy span:nth-child(4)"); // Corrected selector

  let quantity = 0;

  decrementBtn.addEventListener("click", function () {
    if (quantity > 0) {
      quantity--;
      updateQuantity();
    }
  });

  incrementBtn.addEventListener("click", function () {
    quantity++;
    updateQuantity();
  });

  // Event listener for "Add to cart" button
  addToCartBtn.addEventListener("click", function () {
    // Call the click function to display the message
    click();
  });

  function updateQuantity() {
    document.querySelector(".card-quanitiy span:nth-child(2)").textContent = quantity;
  }
});
