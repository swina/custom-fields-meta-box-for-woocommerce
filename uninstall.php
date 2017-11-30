<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

if ( isset($_POST['mg_wc_cfmb_cleandb']) ){
  global $wpdb;

  $query = $wpdb->query("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE '_cf_%'");
  print_r($query);
}
?>
<h1>Custom Fields Meta Box for Woocommerce</h1>

<form method="POST">
  <input type="checkbox" name="mg_wc_cfmb_cleandb"> Remove all data from products database <small>We suggest to make a copy of your database</small>
<div>
  <?php submit_button(); ?>
</div>

$option_name = 'mg_wc_cfmb';

delete_option($option_name);

// for site options in Multisite
delete_site_option($option_name);
