<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;?>

<h1>Custom Fields Meta Box for Woocommerce</h1>
<form method="POST" id="cfmb_form">
<table class="wp-list-table widefat fixed striped tags ui-sortable">
  <tr>
    <td colspan="6">
      <div class="aler alert-warning" style="width:100%;background:#ffc377;padding:10px;border:2px solid #db7e0a;display:none">You settings are changed. Save your changes</div>
    </td>
  </tr>
  <tr>
    <th colspan="6">
      <h3>Custom Fields</h3>
    </th>
  </tr>
  <tr class="table-options-row">
    <th>Field Label</th>
    <th>Slug</th>
    <th>Enabled</th>
    <th>Product Page Meta</th>
    <th></th>
    <th></th>
  </tr>
  <tbody class="ui-sortable field_rows">

    <input type="hidden" name="mg_wc_cfmb_save" value="1">
<?php


    foreach ( $value AS $key=>$v ){
      if ( isset($v['name']) ){
        ?>
        <tr id="row_<?php echo $v['name'];?>" class="field_row">
          <td>
            <input type="hidden" name="name_<?php echo $v['name'];?>" value="<?php echo $v['name'];?>">
            <input type="hidden" name="label_<?php echo $v['name'];?>" value="<?php echo $v['label'];?>">
            <strong><?php echo $v['label'];?></strong>
          </td>
          <td>
            <?php echo $v['name'];?>
          </td>
          <td>
            <input type="checkbox" name="active_<?php echo $v['name']?>"  <?php echo esc_attr( $v['active'] ) == '1' ? 'checked="checked"' : ''; ?>>
          </td>
          <td>
            <input type="checkbox" name="meta_<?php echo $v['name']?>"  <?php echo esc_attr( $v['meta'] ) == '1' ? 'checked="checked"' : ''; ?>>
          </td>
          <td>
            <a href="#" class="btn_delete" data-field="<?php echo $v['name'];?>">Delete</a>
          </td>
          <td class="column-handle ui-sortable-handle"></td>
        </tr>
      <?php
      }
      if ( isset($v['custom_tab']) ){
        $custom_tab = $v['custom_tab'];
      }
    }
    ?>
  </tbody>
    <tr>
      <td colspan="6">
        <h4>Add new field
        <input type="text" name="cfmb_new_field" placeholder="new field label"> <?php submit_button('Add'); ?></h4>
      </td>
    </tr>
    <tr>
      <td colspan="6">
        <h3>Custom Fields Position</h3>
      </td>
    </tr>

    <tr>
      <td colspan="6" class="left">
        <strong>Tab name</strong>
        <input type="text" placeholder="description" name="custom_tab_name" value="<?php echo $custom_tab['tab_name']; ?>" size="50" /> <small>Assign a new name to the description tab or to the new tab</small>
      </td>
    </tr>
    <tr>
      <td colspan="6" class="left">
        <input type="checkbox" name="custom_tab_description" <?php echo  esc_attr($custom_tab['active']) == '1' ? 'checked="checked"' : '';?>> <strong>Add to description tab</strong>
      </td>
    </tr>
    <tr>
      <td colspan="6">
        <div class="aler alert-warning" style="width:100%;background:#ffc377;padding:10px;border:2px solid #db7e0a;display:none">Your settings are changed. Save your changes</div>
      </td>
    </tr>
</table>

<div>
    <?php submit_button(); ?>
</div>

<script>
jQuery(document).ready(function(){
  jQuery( "table tbody" ).sortable( {
	update: function( event, ui ) {
    jQuery('.alert-warning').css('display','');
    jQuery(this).children().each(function(index) {
			jQuery(this).find('td').last().attr('ordine',index + 1)
    });
  }
  });
  jQuery('.btn_delete').on('click',function(){
    jQuery('.alert-warning').css('display','');
    var f = jQuery(this).data('field');
    jQuery('#row_' + f).remove();
  })
})
</script>
