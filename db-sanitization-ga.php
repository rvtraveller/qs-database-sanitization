<?php

// Don't ever sanitize the database on the live environment. Doing so would
// destroy the canonical version of the data.
if (defined('PANTHEON_ENVIRONMENT') && (PANTHEON_ENVIRONMENT !== 'live')) {
  // Bootstrap Drupal using the same technique as is in index.php.
  define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT']);

  if (isset($_ENV['FRAMEWORK']) && $_ENV['FRAMEWORK'] == 'drupal') {
    require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
    if (db_table_exists('variable_store')) {
      db_update('variable_store')
        ->fields(array(
          'value' => 'UA-45061304-2'
        ))
        ->condition('name', 'googleanalytics_account')
        ->execute();    
    }
    else {
      db_update('variable')
        ->fields(array(
          'value' => 'UA-45061304-2'
        ))
        ->condition('name', 'googleanalytics_account')
        ->execute();
    }
  }
  
}
