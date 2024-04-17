document.addEventListener("DOMContentLoaded", function() {
    // Select necessary elements
    const carouselContainer = document.querySelector(".carousel-container");
    const carouselItems = document.querySelector(".carousel-items");
    const carouselItemWidth = document.querySelector(".carousel-item").offsetWidth;

    // Define the slideCarousel function
    function slideCarousel() {
        // Slide the carousel to the left by carouselItemWidth
        carouselItems.style.transform = `translateX(-${carouselItemWidth}px)`;

        // Move the first carousel item to the end after a transition
        setTimeout(function() {
            carouselItems.appendChild(carouselItems.firstElementChild);
            carouselItems.style.transition = "";
            carouselItems.style.transform = "translateX(0)";
        }, 500); // Adjust the delay as needed
    }

    // Slide the carousel automatically every 3 seconds
    setInterval(slideCarousel, 3000); // Adjust the interval as needed

    // Get the previous and next buttons
    const prevButton = document.querySelector(".prev-button");
    const nextButton = document.querySelector(".next-button");

    // Add click event listeners to the buttons
    prevButton.addEventListener("click", function() {
        carouselItems.style.transition = "none";
        carouselItems.prepend(carouselItems.lastElementChild);
        carouselItems.style.transform = `translateX(-${carouselItemWidth}px)`;
        setTimeout(function() {
            carouselItems.style.transition = "";
            carouselItems.style.transform = "translateX(0)";
        }, 50);
    });

    nextButton.addEventListener("click", function() {
        slideCarousel();
    });
});
