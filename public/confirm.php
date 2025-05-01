<?php
require_once __DIR__ . '/../includes/config.php'; // DB_DSN, DB_USER, DB_PASS, DB_OPTIONS

// Connexion à la base
try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} catch (Exception $e) {
    die('Erreur de connexion à la base : ' . htmlspecialchars($e->getMessage()));
}

$token   = $_GET['token'] ?? '';
$success = false;
$message = '';

// Si un token est fourni
if ($token) {
    // Récupération de l’utilisateur, de son statut et de la date d’expiration
    $stmt = $pdo->prepare('
        SELECT id, is_confirmed, confirm_expires
        FROM users
        WHERE confirm_token = ?
    ');
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // 1) Aucun compte avec ce token
        $message = 'Ce lien est invalide.';
    } elseif ($user['is_confirmed']) {
        // 2) Compte déjà activé
        $success = true;
        $message = 'Votre compte a déjà été validé. Vous pouvez vous connecter.';
    } else {
        // 3) Vérification de l’expiration
        $now = new DateTime();
        $expiry = new DateTime($user['confirm_expires']);
        if ($now > $expiry) {
            $message = 'Ce lien a expiré. Merci de vous réinscrire.';
        } else {
            // 4) Tout est OK → activation du compte
            $upd = $pdo->prepare('
                UPDATE users
                SET is_confirmed    = 1,
                    confirm_token   = NULL,
                    confirm_expires = NULL
                WHERE id = ?
            ');
            $upd->execute([$user['id']]);

            if ($upd->rowCount()) {
                $success = true;
                $message = 'Votre compte a bien été confirmé ! Vous pouvez maintenant vous connecter.';
            } else {
                $message = 'Une erreur est survenue lors de la confirmation.';
            }
        }
    }
} else {
    // Pas de token fourni
    $message = 'Aucun jeton de confirmation fourni.';
}

// Inclusion du header
require __DIR__ . '/../includes/header.php';
?>

<main class="auth-page">
  <section class="auth-form">
    <?php if ($success): ?>
      <h1>Confirmation</h1>
      <p><?= htmlspecialchars($message) ?></p>
      <p>
        <a href="/login.php" class="btn-cta">Accéder à la connexion</a>
      </p>
    <?php else: ?>
      <h1>Confirmation impossible</h1>
      <p><?= htmlspecialchars($message) ?></p>
      <p>
        <a href="/register.php" class="btn-cta">Réessayer l’inscription</a>
      </p>
    <?php endif; ?>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
