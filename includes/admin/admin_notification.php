<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="color-scheme" content="light only">
  <meta name="supported-color-schemes" content="light">
  <title>Nouvelle inscription – Open Ranch</title>
  <style>
    body { margin:0; padding:0; background:#F7F3E9; font-family:'Lora', serif; }
    .email-container {
      max-width:600px; margin:0 auto; background:#fff; border-radius:8px; overflow:hidden;
    }
    .email-header {
      background:#1E1C44; padding:20px; text-align:center;
    }
    .email-header img {
      max-width:180px; height:auto; display:block; margin:0 auto;
    }
    .email-title {
      font-family:'Playfair Display', serif;
      font-size:1.8rem; color:#1E1C44; text-align:center; margin:1rem 0;
    }
    .email-body { padding:0 40px; color:#1E1C44; line-height:1.6; }
    .email-body p { margin:1rem 0; }
    .email-body .data { font-weight:bold; }
    .email-footer {
      font-size:0.85rem; color:#777; text-align:center;
      margin:2rem 40px 1.5rem; border-top:1px solid #ddd; padding-top:1rem;
    }
    .email-footer a { color:#777; text-decoration:none; margin:0 0.5rem; }
  </style>
</head>
<body>
  <div class="email-container">
    <!-- En-tête -->
    <div class="email-header">
      <img src="https://openranch.alwaysdata.net/assets/images/OpenRanch2.png"
           alt="Logo Open Ranch">
    </div>

    <!-- Titre -->
    <h1 class="email-title">Nouvelle inscription</h1>

    <!-- Contenu -->
    <div class="email-body">
      <p>Un nouvel utilisateur vient de s’inscrire sur <strong>Open Ranch</strong> :</p>
      <p>Prénom : <span class="data"><?= htmlspecialchars($firstName) ?></span></p>
      <p>Nom : <span class="data"><?= htmlspecialchars($lastName) ?></span></p>
      <p>Email : <span class="data"><?= htmlspecialchars($email) ?></span></p>
      <p>Date : <span class="data"><?= htmlspecialchars($createdAt) ?></span></p>
    </div>

    <!-- Pied de page -->
    <div class="email-footer">
      <p>Open Ranch — Parc Régional des Vosges du Nord</p>
      <p>
        <a href="https://openranch.alwaysdata.net">Visiter le site</a> |
        <a href="mailto:contact@openranch.fr">Nous contacter</a>
      </p>
    </div>
  </div>
</body>
</html>
