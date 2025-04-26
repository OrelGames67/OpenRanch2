// about-carousel.js
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.carousel-container');
    const prevBtn   = document.querySelector('.carousel-prev');
    const nextBtn   = document.querySelector('.carousel-next');
  
    // avancée de 1 slide à chaque clic (ajuste la valeur si tu veux)
    const scrollAmount = () => container.querySelector('.carousel-slide').offsetWidth + parseInt(getComputedStyle(container.querySelector('.carousel-slide')).marginRight);
  
    prevBtn.addEventListener('click', () => {
      container.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
    });
  
    nextBtn.addEventListener('click', () => {
      container.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
    });
  });
  