document.addEventListener('DOMContentLoaded', () => {
  const burger     = document.querySelector('.burger');
  const navOverlay = document.querySelector('.nav-overlay');
  const closeBtn   = document.querySelector('.menu-close');

  if (!burger || !navOverlay || !closeBtn) return;

  // Ouvrir l'overlay
  burger.addEventListener('click', () => {
    navOverlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  });

  // Fermer via × 
  closeBtn.addEventListener('click', () => {
    navOverlay.classList.remove('open');
    document.body.style.overflow = '';
  });

  // Fermer aussi quand on clique sur un lien
  navOverlay.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navOverlay.classList.remove('open');
      document.body.style.overflow = '';
    });
  });
});
