<?php
  // pages/mentions-legales.php

  // Titre de la page
  $pageTitle = 'Mentions légales';

  // Inclut le header (doctype, <head> avec tes <link> CSS, ouverture <body>, nav, etc.)
  require __DIR__ . '/../includes/header.php';
?>

<main class="legal-page">

  <!-- Navigation ancrée (desktop) -->
  <nav class="legal-nav">
    <ul>
      <li><a href="#editor">Éditeur</a></li>
      <li><a href="#host">Hébergeur</a></li>
      <li><a href="#ip">Propriété intellectuelle</a></li>
      <li><a href="#data">Données personnelles</a></li>
      <li><a href="#cookies">Cookies</a></li>
    </ul>
  </nav>

  <!-- Contenu principal -->
  <div class="legal-content">

    <section id="editor" class="legal-card">
      <h2>Éditeur du site</h2>
      <p><strong>Nom :</strong> OPEN RANCH (SARL au capital de X €)</p>
      <p><strong>Siège social :</strong> 123 rue de la Promenade, 67000 Strasbourg</p>
      <p><strong>RCS :</strong> Strasbourg B 123 456 789</p>
      <p><strong>TVA intracommunautaire :</strong> FR12 345678912</p>
      <p><strong>Responsable de publication :</strong> Mme Giulia Grussi</p>
      <p><strong>Contact :</strong> <a href="mailto:contact@openranch.fr">contact@openranch.fr</a> — Tél. 06 00 00 00 00</p>
    </section>

    <section id="host" class="legal-card">
      <h2>Hébergeur</h2>
      <p><strong>Nom :</strong> AlwaysData</p>
      <p><strong>Adresse :</strong> 14 rue Carrée, 75002 Paris</p>
      <p><strong>Tél. :</strong> +33 1 23 45 67 89</p>
      <p><strong>Site Web :</strong> <a href="https://www.alwaysdata.com" target="_blank" rel="noopener">alwaysdata.com</a></p>
    </section>

    <section id="ip" class="legal-card">
      <h2>Propriété intellectuelle</h2>
      <p>Tous les contenus (textes, images, logos, vidéos, graphismes, etc.) présents sur ce site sont la propriété exclusive de OPEN RANCH ou de ses partenaires. Toute reproduction, distribution ou représentation, totale ou partielle, est interdite sans autorisation écrite préalable.</p>
    </section>

    <section id="data" class="legal-card">
      <h2>Données personnelles</h2>
      <p>Les informations recueillies sur ce site sont enregistrées dans un fichier informatisé par OPEN RANCH pour gérer les demandes de contact et de réservation. Elles sont conservées pendant 3 ans et sont destinées exclusivement à l’usage de OPEN RANCH. Conformément à la loi « Informatique et Libertés », vous pouvez exercer vos droits en contactant <a href="mailto:contact@openranch.fr">contact@openranch.fr</a>.</p>
    </section>

    <section id="cookies" class="legal-card">
      <h2>Cookies</h2>
      <p>Ce site utilise des cookies pour améliorer votre expérience de navigation. Vous pouvez désactiver les cookies via les paramètres de votre navigateur. Pour en savoir plus, consultez notre <a href="/politique-cookies.php">Politique Cookies</a>.</p>
    </section>

  </div><!-- .legal-content -->

</main>

<?php
  // Inclut le footer (fermeture </body></html>, tes <script> JS, etc.)
  require __DIR__ . '/../includes/footer.php';
?>
