<?php

// 1) Mot de passe « maintenance mode »
define('MAINTENANCE_PASSWORD', 'OpenRanch');

define('DB_DSN',      'mysql:host=mysql-openranch.alwaysdata.net;dbname=openranch_openranch;charset=utf8mb4');
define('DB_USER',     'openranch');
define('DB_PASS',     'Bilal1302!');
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
]);

// ————————————————
// Expéditeur des emails
// ————————————————
define('MAIL_FROM', 'openranch@alwaysdata.net');
define('ADMIN_EMAIL', 'elhaimeurbilal@gmail.com');