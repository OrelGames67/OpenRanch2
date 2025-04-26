// Animation fade-in au scroll
document.addEventListener('DOMContentLoaded', () => {
    const faders = document.querySelectorAll('.fade-in');
  
    const appearOnScroll = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target); // Pour ne pas relancer l’animation à chaque scroll
        }
      });
    }, {
      threshold: 0.2
    });
  
    faders.forEach(fader => {
      appearOnScroll.observe(fader);
    });
  });
  