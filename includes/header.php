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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Lora&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/about.css">
  <!-- JS -->
  <script defer src="/assets/js/menu.js"></script>
  <script defer src="/assets/js/fade.js"></script>
  <script defer src="/assets/js/slider.js"></script>
  <script defer src="/assets/js/about.js"></script>
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
        <div class="nav-overlay"></div>
        <button class="menu-close" aria-label="Fermer le menu">×</button>
          <ul class="nav-links">
            <li><a href="https://openranch.alwaysdata.net/index.php">Accueil</a></li>
            <li><a href="https://openranch.alwaysdata.net/about.php">À propos de nous</a></li>
            <li><a href="https://openranch.alwaysdata.net/about.php">Prestations</a></li>
            <li><a href="https://openranch.alwaysdata.net/actualites.php">Galeries Photos</a></li>
            <li><a href="https://openranch.alwaysdata.net/reservation.php">Gîtes</a></li>
          </ul>

        <!-- Menu Burger -->
        <button class="burger" aria-label="Ouvrir le menu">
          <span class="line1"></span>
          <span class="line2"></span>
          <span class="line3"></span>
        </button>
      </nav>
    </div>
  </header>
<main>
