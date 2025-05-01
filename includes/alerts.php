<?php
if (isset($success) && $success): ?>
  <div class="alert alert-success">
    Un e-mail de confirmation vient de vous être envoyé.
  </div>
<?php else: ?>
  <?php if (!empty($errors)): ?>
    <ul class="alert alert-danger">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
<?php endif; ?>
