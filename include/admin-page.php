<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


//add admin menu
function mg_wc_cfmb_menu(){
  add_menu_page(
    'Products Custom Fields MetaBox',
    'Products Custom Fields MetaBox',
    'manage_options',
    'mg_wc_cfmbmenu',
    'mg_wc_cfmb_edit' ,
    'dashicons-welcome-widgets-menus' );

  add_submenu_page(
    'mg_wc_cfmbmenu',
    'DB Optimization',
    'DB Optimization',
    'manage_options',
    'mg_wc_cfmb_submenu',
    'mg_wc_cfmb_optimize'
  );

  add_submenu_page(
    'mg_wc_cfmbmenu',
    'Documentation',
    'Documentation',
    'manage_options',
    'mg_wc_cfmb_submenu_2',
    'mg_wc_cfmb_documentation'
  );
}
add_action('admin_menu', 'mg_wc_cfmb_menu');

function mg_wc_cfmb_documentation(){
  include_once('cfmb_docs.php');
}

function mg_wc_cfmb_edit(){
  wp_enqueue_script( 'jquery-ui-sortable' );
  $value = get_option('mg_wc_cfmb');

    if (isset($_POST['mg_wc_cfmb_save'])) {
      $options = [];

      foreach (array_keys($_POST) as $field){
        echo $field;

          if ( strpos($field,'name_') > -1 ){
            $name = str_replace('name_','',$field);
            $a = array (
              'name' => $name,
              'label' => $_POST['label_'.$name],
              'active' => esc_attr($_POST['active_'.$name]) == 'on' ? '1':'0',
              'meta'  => esc_attr($_POST['meta_'.$name]) == 'on' ? '1' : '0'
            );
            array_push($options,$a);
          }
        
      }
      if ( isset($_POST['custom_tab_description']) ){
        $a = array (
          'custom_tab' => array (
            'active' => isset($_POST['custom_tab_description']) ? '1' : '0',
            'tab_name'=> $_POST['custom_tab_name']
            )
        );
        array_push($options,$a);
        update_option('mg_wc_cfmb', $options);
        $value = $options;
      }
      if ( isset($_POST['cfmb_new_field']) && $_POST['cfmb_new_field'] != ''){
        $name = str_replace(' ','',strtolower($_POST['cfmb_new_field']));
        $a = array (
          'name'    => $name,
          'label'   => $_POST['cfmb_new_field'],
          'active'  => 1,
          'meta'    => 0
        );
        array_push($options,$a);
        update_option('mg_wc_cfmb', $options);
        $value = $options;
      }
      if ( isset($_POST['custom_tab_name_init']) ){
        $a = array (
          'custom_tab' => array (
            'active' => 1,
            'tab_name' => 'Description'
          )
        );
        array_push($options,$a);
        update_option('mg_wc_cfmb', $options);
        $value = $options;
      }
    }
  if ( $value ){
    include ( 'cfmb_form.php' );
  } else {
    include ( 'cfmb_form_init.php');
  }
  include ('cfmb_footer.php');
}

function mg_wc_cfmb_optimize(){
  global $wpdb;
  $optimized = false;
  if ( isset($_POST['mg_wc_cfmb_optimize']) && $_POST['mg_wc_cfmb_optimize'] == '1' ){
    $wpdb->query("DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE '_cf_%' AND meta_value = ''");
    $optimized = true;
  }
  $optimize = $wpdb->query("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE '_cf_%' AND meta_value = ''");
  $current = $wpdb->query("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE '_cf_%'");
  ?>
  <form method="POST">
    <input type="hidden" name="mg_wc_cfmb_optimize" value="1">
  <h1>Custom Fields Meta Box for Woocommerce</h1>
  <h3>Database optimization</h3>
  <p>This option checks if your products database has custom fields with any data. You can clean all the empty data in order improve your database performance</p>
  <p>
    You have <?php echo $current;?> custom fields.<br>
    You have <?php echo $optimize;?> records to optimize.
  </p>
  <?php if ( $optimized ) { ?> <h3>Database optimized!</h3> <?php }?>
  <?php if ( (int)$optimize > 0 ) {
    ?>
    <p style="color:red">WARNING !</p>
    <p>This operation will permanently delete record from your database. We suggest to make a copy before to proceed with the optimization</p>
    <div>
      <?php submit_button('Optimize'); ?>
    </div>
  <?php
  }
  include ('cfmb_footer.php');
}
