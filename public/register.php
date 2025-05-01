<?php
require_once __DIR__ . '/../includes/config.php';  // DB_DSN, DB_USER, DB_PASS, DB_OPTIONS, MAIL_FROM, ADMIN_EMAIL

// 1. Redirection si déjà connecté
//if (!empty($_SESSION['user_id'])) {
//    header('Location: /');
//    exit;
//}

$errors     = [];
$success    = false;
$firstName  = '';
$lastName   = '';
$email      = '';

// 2. Traitement POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère et nettoie
    $firstName       = trim($_POST['first_name']       ?? '');
    $lastName        = trim($_POST['last_name']        ?? '');
    $email           = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password        = $_POST['password']              ?? '';
    $confirmPassword = $_POST['confirm_password']      ?? '';

    // Validation
    if (!$firstName)            $errors[] = 'Le prénom est requis.';
    if (!$lastName)             $errors[] = 'Le nom est requis.';
    if (!$email)                $errors[] = 'Email invalide.';
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
      $errors[] = 'Le mot de passe doit faire au moins 8 caractères, inclure une majuscule, une minuscule, un chiffre et un caractère spécial.';
    }
    if ($password !== $confirmPassword) $errors[] = 'Les mots de passe ne correspondent pas.';

    if (empty($errors)) {
        try {
            // Connexion BDD
            $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);

            // Vérification unicité email
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = 'Cet email est déjà utilisé.';
            } else {
                // Insertion utilisateur
                $hash  = password_hash($password, PASSWORD_DEFAULT);
                $token = bin2hex(random_bytes(16));
                $dt    = new DateTime('+1 hour');
                $expires   = $dt->format('Y-m-d H:i:s');  // pour la BDD
                $expiresFR = $dt->format('d-m-Y H:i:s');  // pour l’affichage

                $stmt = $pdo->prepare(
                  'INSERT INTO users 
                     (first_name, last_name, email, password, confirm_token, confirm_expires, is_confirmed, created_at)
                   VALUES
                     (?, ?, ?, ?, ?, ?, 0, NOW())'
                );
                $stmt->execute([
                  $firstName,    // Prénom
                  $lastName,     // Nom
                  $email,        // E-mail
                  $hash,         // Mot de passe hashé
                  $token,        // Token de confirmation
                  $expires       // Date/heure d’expiration du token
                ]);

                // Prépare le lien de confirmation
                $confirmLink = 'https://' . $_SERVER['HTTP_HOST'] . '/confirm.php?token=' . urlencode($token);

                // 3. Envoi du mail à l’utilisateur
                ob_start();
                include __DIR__ . '/confirm_email.php';  // attend $firstName, $confirmLink
                $emailHtml = ob_get_clean();

                $headers = implode("\r\n", [
                    "MIME-Version: 1.0",
                    "Content-Type: text/html; charset=UTF-8",
                    "From: " . MAIL_FROM,
                ]);
                mail($email,
                     "Confirmez votre inscription – Open Ranch",
                     $emailHtml,
                     $headers
                );

                // === NOUVEAU : Envoi de la notification à l’administrateur ===
                $createdAt = (new DateTime())->format('d/m/Y H:i:s');
                ob_start();
                include __DIR__ . '/../includes/admin/admin_notification.php';  // attend $firstName, $lastName, $email, $createdAt
                $adminHtml = ob_get_clean();

                $adminHeaders = implode("\r\n", [
                    "MIME-Version: 1.0",
                    "Content-Type: text/html; charset=UTF-8",
                    "From: " . MAIL_FROM,
                ]);
                mail(
                    ADMIN_EMAIL,
                    "Nouvelle inscription – Open Ranch",
                    $adminHtml,
                    $adminHeaders
                );
                // =================================================================

                $success = true;
            }
        } catch (PDOException $e) {
            $errors[] = "Erreur base de données : " . $e->getMessage();
        }
    }
}

// 5. Affichage
require __DIR__ . '/../includes/header.php';
?>

<main class="auth-page">
  <section class="auth-form">
    <h1>Inscription</h1>

    <?php
    // Affichage des messages (success ou erreurs)
    include __DIR__ . '/../includes/alerts.php';
    ?>

    <?php if (!$success): ?>
      <form method="post" novalidate>
        <div class="form-group">
          <label for="first_name">Prénom</label>
          <input type="text" id="first_name" name="first_name"
                 value="<?= htmlspecialchars($firstName) ?>" required>
        </div>

        <div class="form-group">
          <label for="last_name">Nom</label>
          <input type="text" id="last_name" name="last_name"
                 value="<?= htmlspecialchars($lastName) ?>" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email"
                 value="<?= htmlspecialchars($email) ?>" required>
        </div>

        <div class="form-group password-group">
  <label for="password">Mot de passe</label>
  <div class="password-wrapper">
    <input
      id="password"
      name="password"
      type="password"
      placeholder="Votre mot de passe"
      required
      aria-describedby="pwd-strength"
    >
    <button type="button"
            class="toggle-password"
            data-target="password"
            aria-label="Afficher/masquer le mot de passe">
      <i class="fas fa-eye"></i>
    </button>
  </div>

  <!-- 1️⃣ Label de force au-dessus -->
  <span class="strength-text" aria-live="polite"></span>

  <!-- 2️⃣ Jauge de force -->
  <div id="pwd-strength" class="password-strength">
    <div class="strength-bar"></div>
  </div>
</div>


<div class="form-group password-group">
  <label for="confirm_password">Confirmer le mot de passe</label>
  <div class="password-wrapper">
    <input
      id="confirm_password"
      name="confirm_password"
      type="password"
      required
    >
    <button type="button"
            class="toggle-password"
            data-target="confirm_password"
            aria-label="Afficher/masquer le mot de passe">
      <i class="fas fa-eye"></i>
    </button>
  </div>
</div>


<button type="submit" class="btn-cta">S’inscrire</button>
</form>
<div class="alt-action">
<p>Déjà inscrit ? <a href="/login.php">Connectez-vous</a></p>
</div>
<?php endif; ?>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
