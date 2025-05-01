document.addEventListener('DOMContentLoaded', () => {
  const body      = document.body;
  const burger    = document.querySelector('.burger');
  const navLinks  = document.querySelector('.main-nav .nav-links');
  const overlay   = document.querySelector('.main-nav .nav-overlay');
  const linkItems = document.querySelectorAll('.main-nav .nav-links li');

  if (!burger || !navLinks || !overlay) {
    console.warn('Élément manquant pour le menu burger');
    return;
  }

  function toggleMenu() {
    const isOpening = !navLinks.classList.contains('nav-active');

    // 1. Slide-in / slide-out du menu
    navLinks.classList.toggle('nav-active', isOpening);
    // 2. Overlay visible / masqué
    overlay.classList.toggle('overlay-active', isOpening);
    // 3. Burger ↔ Croix
    burger.classList.toggle('toggle', isOpening);
    // 4. Bloquer / débloquer le scroll
    body.classList.toggle('no-scroll', isOpening);

    // 5. Animation en cascade des liens
    linkItems.forEach((li, idx) => {
      if (isOpening) {
        li.style.animation = `navLinkFade 0.5s ease forwards ${idx * 0.1 + 0.3}s`;
      } else {
        li.style.animation = '';
      }
    });
  }

  // Ouvrir/fermer au clic sur le burger
  burger.addEventListener('click', toggleMenu);
  // Fermer au clic sur l’overlay
  overlay.addEventListener('click', () => {
    if (navLinks.classList.contains('nav-active')) toggleMenu();
  });
  // Fermer au clic sur un lien
  linkItems.forEach(li => {
    li.addEventListener('click', () => {
      if (navLinks.classList.contains('nav-active')) toggleMenu();
    });
  });
  // Fermer à la touche Échap
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && navLinks.classList.contains('nav-active')) {
      toggleMenu();
    }
  });
});
