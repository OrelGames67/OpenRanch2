<?php
session_start();
require_once __DIR__ . '/config.php';

// --- Gestion du mode maintenance ---
if (isset($_POST['maintenance_pwd'])) {
    if ($_POST['maintenance_pwd'] === MAINTENANCE_PASSWORD) {
        $_SESSION['site_unlocked'] = true;
    } else {
        $maintenance_error = "Mot de passe incorrect.";
    }
}

if (empty($_SESSION['site_unlocked'])):
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Site en construction</title>
  <link href="https://fonts.googleapis.com/css2?family=Lora&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body>
  <div class="maintenance-overlay">
    <div class="maintenance-card">
      <h2>Site en construction</h2>
      <p>Entrez le mot de passe pour accéder au site :</p>
      <?php if (!empty($maintenance_error)): ?>
        <div class="maintenance-error"><?= htmlspecialchars($maintenance_error) ?></div>
      <?php endif; ?>
      <form method="post">
      <button type="button" class="toggle-password" aria-label="Afficher / masquer le mot de passe">
            <i class="fas fa-eye"></i>
          </button>
        <input type="password" name="maintenance_pwd" placeholder="Mot de passe" required>
        <button type="submit">Valider</button>
      </form>
    </div>
  </div>
</body>
</html>
<?php
exit;
endif;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Open Ranch</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Lora&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/global.css">
  <!-- JS -->
  <script defer src="/assets/js/menu.js"></script>
  <script defer src="/assets/js/fade.js"></script>
  <script defer src="/assets/js/slider.js"></script>
  <script defer src="/assets/js/legal-nav.js"></script>
  <script defer src="/assets/js/register.js"></script>
  <!-- Font Awesome : place-le AVANT tes propres CSS -->
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
/>
</head>
<body>
  <header class="site-header">
    <div class="container">
      <!-- Logo -->
      <div class="logo-container">
        <a href="/public/index.php">
          <img src="/assets/images/OpenRanch2.png" alt="Open Ranch" class="logo">
        </a>
      </div>
      
      <!-- Navigation -->
      <nav class="main-nav">
        <div class="nav-overlay"></div>
          <ul class="nav-links">
            <li><a href="https://openranch.alwaysdata.net/index.php">Accueil</a></li>
            <li><a href="https://openranch.alwaysdata.net/about.php">À propos de nous </a></li>
            <li><a href="https://openranch.alwaysdata.net/prestations.php">Prestations</a></li>
            <li><a href="https://openranch.alwaysdata.net/albums.php">Galeries Photos</a></li>
            <li><a href="https://openranch.alwaysdata.net/reservation.php">Réservation Gite</a></li>
            <li><a href="https://openranch.alwaysdata.net/register.php" class="btn-nav">Inscription</a></li>
            <li><a href="https://openranch.alwaysdata.net/login.php" class="btn-nav">Connexion</a></li>
          </ul>

        <!-- Menu Burger -->
        <button class="burger" aria-label="Ouvrir le menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </button>
      </nav>
    </div>
  </header>
<main>
