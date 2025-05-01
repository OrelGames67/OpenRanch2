<?php
// Attendus : $firstName (string), $confirmLink (string)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="color-scheme" content="light only">
  <meta name="supported-color-schemes" content="light">
  <title>Confirmation d'inscription – Open Ranch</title>
  <style>
    /* Corps de mail centré et limité en largeur */
    body {
      margin: 0;
      padding: 0;
      background-color: #F7F3E9;
      font-family: 'Lora', serif;
      color: #333;
    }
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    /* === EN-TÊTE AVEC BANDEAU COLORÉ === */
    .email-header {
      background-color: #1E1C44;        /* Bleu foncé du site */
      padding: 20px;
      text-align: center;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    .email-header img {
      max-width: 180px;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    /* Titre */
    .email-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      color: #1E1C44;
      text-align: center;
      margin: 1rem 0;
    }

    /* Corps du message */
    .email-body {
      padding: 0 40px;
    }
    .email-body p {
      margin: 1rem 0;
      line-height: 1.6;
      color: #1E1C44;
    }

    /* Bouton CTA */
    .btn {
      display: inline-block;
      margin: 1.5rem 0;
      padding: 0.75rem 1.5rem;
      background: #55AD32;
      color: #fff !important;
      text-decoration: none;
      border-radius: 4px;
      font-weight: bold;
      text-align: center;
    }

    /* Lien brut de secours */
    .email-body a.link {
      color: #55AD32;
      word-break: break-all;
    }

    /* Pied de mail */
    .email-footer {
      font-size: 0.85rem;
      color: #777;
      text-align: center;
      margin: 2rem 40px 1.5rem;
      border-top: 1px solid #ddd;
      padding-top: 1rem;
    }
    .email-footer a {
      color: #777;
      text-decoration: none;
      margin: 0 0.5rem;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <!-- En-tête avec bandeau coloré et logo -->
    <div class="email-header">
      <img
        src="https://openranch.alwaysdata.net/assets/images/OpenRanch2.png"
        alt="Logo Open Ranch"
      >
    </div>

    <!-- Titre principal -->
    <h1 class="email-title">Confirmez votre inscription</h1>

    <!-- Corps du message -->
    <div class="email-body">
      <p>
        Bonjour <strong><?= htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') ?></strong>,
      </p>
      <p>
        Merci de vous être inscrit(e) sur <strong>Open Ranch</strong> !  
        Pour finaliser votre compte, cliquez sur le bouton ci-dessous :
      </p>
      <p style="text-align:center;">
        <a href="<?= $confirmLink ?>" class="btn">Confirmer mon compte</a>
      </p>
      <p>
        Si le bouton ne fonctionne pas, copiez-collez ce lien dans votre navigateur :<br>
        <a href="<?= $confirmLink ?>" class="link"><?= $confirmLink ?></a>
      </p>
    </div>

    <!-- Pied de mail -->
    <div class="email-footer">
      <p>Open Ranch — Parc Régional des Vosges du Nord</p>
      <p>
        <a href="https://openranch.alwaysdata.net">Visiter notre site</a> |
        <a href="mailto:openranch@alwaysdata.net">Nous contacter</a>
      </p>
      <p style="font-size:0.75rem;color:#aaa;">
        Si vous n’avez pas demandé cette inscription, ignorez simplement cet e-mail.
      </p>
    </div>
  </div>
</body>
</html>
