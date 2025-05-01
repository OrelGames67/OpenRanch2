// assets/js/legal-nav.js
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.legal-nav a');
  const sections = document.querySelectorAll('.legal-content section');

  function updateActive() {
    let idx = sections.length;
    while (--idx && window.scrollY + 100 < sections[idx].offsetTop) {}
    links.forEach(link => link.classList.remove('active'));
    links[idx].classList.add('active');
  }

  // Initial highlight
  updateActive();
  // Update on scroll
  window.addEventListener('scroll', updateActive);
});
