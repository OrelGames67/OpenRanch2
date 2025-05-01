document.querySelector('form').addEventListener('submit', e => {
    const pwd = document.querySelector('#password').value;
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!pattern.test(pwd)) {
      e.preventDefault();
      alert('Le mot de passe doit faire au moins 8 caractères, inclure une majuscule, une minuscule, un chiffre et un caractère spécials.');
    }
  });

  // bascule mot de passe / texte
document.querySelectorAll('.toggle-password').forEach(btn => {
  btn.addEventListener('click', () => {
    const input = document.getElementById(btn.dataset.target);
    const isPwd = input.type === 'password';
    input.type = isPwd ? 'text' : 'password';
    btn.innerHTML = isPwd
      ? '<i class="fas fa-eye-slash"></i>'
      : '<i class="fas fa-eye"></i>';
  });
});

const strengthBar  = document.querySelector('.password-strength .strength-bar');
const strengthText = document.querySelector('.strength-text');
const pwdInput     = document.getElementById('password');

pwdInput.addEventListener('input', () => {
  const val = pwdInput.value;
  let score = 0;

  if (val.length >= 8)        score += 1;
  if (/[A-Z]/.test(val))      score += 1;
  if (/[a-z]/.test(val))      score += 1;
  if (/\d/.test(val))         score += 1;
  if (/[\W_]/.test(val))      score += 1;

  const pct = (score / 5) * 100;
  strengthBar.style.width = pct + '%';

  let label, color;
  if (pct === 0) {
    label = '';
    color = '#eee';
  } else if (pct <= 40) {
    label = 'Faible';
    color = '#e74c3c';
  } else if (pct <= 80) {
    label = 'Moyen';
    color = '#f1c40f';
  } else {
    label = 'Fort';
    color = '#2ecc71';
  }

  strengthBar.style.background = color;

  // Met à jour le texte
  if (label) {
    strengthText.textContent = label;
    strengthText.classList.add('visible');
  } else {
    strengthText.textContent = '';
    strengthText.classList.remove('visible');
  }
});
