document.addEventListener('DOMContentLoaded', () => {
    const sliderContainer = document.querySelector('.slider-container');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
  
    // Navigation manuelle avec les flèches
    prevButton.addEventListener('click', () => {
      sliderContainer.scrollBy({
        left: -300, // ajuste si besoin
        behavior: 'smooth'
      });
    });
  
    nextButton.addEventListener('click', () => {
      sliderContainer.scrollBy({
        left: 300, // ajuste si besoin
        behavior: 'smooth'
      });
    });
  
  });
  