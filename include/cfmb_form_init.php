<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;?>
<h1>Custom Fields Meta Box</h1>
<table class="wp-list-table widefat fixed striped tags">
  <tr>
    <td colspan="3">
      <h3>Custom Fields</h3>
    </td>
  </tr>
  <tr class="table-options-row">
    <th>Field Label</th>
    <th>Enabled</th>
    <th>Product Page Meta</th>
  </tr>
  <form method="POST">
  <input type="hidden" name="mg_wc_cfmb_save" value="1">
  <input type="hidden" name="custom_tab_desription_init" value="on">
  <input type="hidden" name="custom_tab_name_init" value="Description">
  <tr>
    <td colspan="3">
      <small style="color:red">No custom fields defined</small>
      <h4>Add new field</h4>
      <input type="text" name="cfmb_new_field" placeholder="new field label">
    </td>
  </tr>
</table>
<div>
  <?php submit_button(); ?>
</div>
