<?php

// Don't ever sanitize the database on the live environment. Doing so would
// destroy the canonical version of the data.
if (defined('PANTHEON_ENVIRONMENT') && (PANTHEON_ENVIRONMENT !== 'live')) {
  // Bootstrap Drupal using the same technique as is in index.php.
  define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT']);
  require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
  drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
  if (file_exists($_ENV['HOME'] . "/code/dev-admin-pass.txt")) {
  	$secret = file_get_contents($_ENV['HOME'] . '/code/dev-admin-pass.txt');
  } 
  else {
  	$secret = $_ENV['PANTHEON_SITE'];
  }
  $hashthepass = 'Password1!-' . $secret;
  require_once DRUPAL_ROOT . '/' . variable_get('password_inc', 'includes/password.inc');
  $hashthepass = user_hash_password(trim($hashthepass));
  // Abort if the hashing failed and returned FALSE.
  if (!$hashthepass) {
    return FALSE;
  }
  else {
    db_update('users')
      ->fields(array(
        'pass' => $hashthepass
      ))
      ->condition('uid', '1')
      ->execute();
  }
}
