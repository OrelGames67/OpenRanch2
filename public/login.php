<?php
require_once __DIR__ . '/../includes/config.php';

$errors = [];
$flash  = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    // On cherche l’utilisateur (même non confirmé)
    $pdo  = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Pas d’utilisateur avec cet email
        $errors[] = 'Email ou mot de passe incorrect.';
    } else if (!$user['is_confirmed']) {
        // Compte créé mais pas validé
        $errors[] = 'Vous devez d’abord valider votre compte. Vérifiez votre boîte e-mail.';
    } else if (!password_verify($password, $user['password'])) {
        // Mot de passe incorrect
        $errors[] = 'Email ou mot de passe incorrect.';
    } else {
        // Tout est OK : on connecte
        $_SESSION['user_id'] = $user['id'];
        header('Location: /account.php');
        exit;
    }
}
?>
<?php require __DIR__ . '/../includes/header.php'; ?>

<main class="auth-page">
  <section class="auth-form">
    <h1>Connexion</h1>

    <?php if ($flash): ?>
      <div class="flash"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="errors">
        <?php foreach ($errors as $e): ?>
          <p><?= htmlspecialchars($e) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="email"
               required value="<?= htmlspecialchars($email ?? '') ?>">
      </div>

      <div class="form-group password-group">
        <label for="password">Mot de passe</label>
      <div class="password-wrapper">
        <input id="password" name="password" type="password" required>
        <button type="button"
            class="toggle-password"
            data-target="password"
            aria-label="Afficher/masquer le mot de passe">
      <i class="fas fa-eye"></i>
    </button>
      </div>

      <button type="submit" class="btn-cta">Se connecter</button>
    </form>

    <div class="alt-action">
      <p>Pas encore inscrit ? <a href="/register.php">Inscrivez-vous</a></p>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
