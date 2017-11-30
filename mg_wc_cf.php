<?php
/**
* Plugin Name: Moodgiver Products Custom Fields MetaBox for Woocommerce
* Plugin URI: http://www.moodgiver.com/
* Description: Add custom rich text fields to Woocommerce products using a practical metabox. Edit your custom fields with the wysiwys editor (inserting media). This is a beta version you should test in a development environment before to use. Custom Fields MetaBox for Woocommerce is free to use 
* Version: beta 1.0.0
* Author: Antonio Nardone
* Author URI: http://www.antonionardone.com/
* License: GPL3
* Date: november 2017
*/



// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


if ( is_admin() ) {
  //load adminpage
  include_once('include/admin-page.php');


  function plugin_mg_wc_cfmb_activation(){
    update_option('mg_wc_cfmb','');
  }

  register_activation_hook( __FILE__, 'plugin_mg_wc_cfmb_activation' );
  register_deactivation_hook( __FILE__, 'plugin_mg_wc_cfmb_deactivation' );
}




/*--------------------- Product Custom Fields MetaBox --------------------*/

//load boostrap and plugin js (css only modal)
if ( ! function_exists( 'my_assets' ) )
{
  function my_assets() {
    wp_register_script ( 'modaljs' , plugin_dir_url( __FILE__ ) . 'assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '1', true );
    wp_register_style ( 'modalcss' , plugin_dir_url( __FILE__ ) . 'assets/bootstrap/css/bootstrap.css', '' , '', 'all' );

    wp_register_script ( 'pluginjs' , plugin_dir_url( __FILE__ ) . 'assets/js/cfmb.js', array( 'jquery' ), '1', true );
      wp_register_style ( 'plugincss' , plugin_dir_url( __FILE__ ) . 'assets/css/cfmb.css', '' , '', 'all' );


    wp_enqueue_script( 'modaljs' );
    wp_enqueue_script( 'pluginjs' );
    wp_enqueue_style( 'modalcss' );
    wp_enqueue_style( 'plugincss' );
  }
}


//create metabox
add_action( 'add_meta_boxes', 'mg_add_meta_boxes' );

//load boostrap and plugin jss / css
add_action('admin_enqueue_scripts', 'my_assets');


if ( ! function_exists( 'mg_add_meta_boxes' ) )
{
    function mg_add_meta_boxes()
    {
        add_meta_box( 'mg_custom_fields', __('Custom Fields MetaBox','woocommerce'), 'woocommerce_product_custom_fields', 'product', 'advanced', 'core' );

    }


}



function register_mg_wc_cfmb_plugin_settings($terms){
  $options = [];
  foreach ( $terms AS $term ){
    $a = array (
      'name'  => $term->attribute_name,
      'label' => $term->attribute_label,
      'active' => 1,
      'meta'  => 0
    );
    array_push($options,$a);
  }
  $a = array (
    'custom_tab' => array (
        'active' => 0,
        'tab_name'  => 'Information'
    )
  );
  array_push($options,$a);
  //register_setting( 'mg_wc_cfmb','mg_wc_cfmb');
  add_option('mg_wc_cfmb',$options);
}


// Adding Meta field in the meta container admin product pages
if ( ! function_exists( 'mg_add_other_fields_to_product' ) )
{
    function mg_add_other_fields_to_product()
    {
        global $post;

        $meta_field_data = get_post_meta( $post->ID, '_my_field_slug', true ) ? get_post_meta( $post->ID, '_my_field_slug', true ) : '';

        echo '<input type="hidden" name="mv_other_meta_field_nonce" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
            <input type="text" style="width:250px;";" name="my_field_name" placeholder="' . $meta_field_data . '" value="' . $meta_field_data . '"></p>';

    }
}

// Display Fields
//add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');

// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');



//create edit/save custom fields form
function woocommerce_product_custom_fields()
{
  include_once('include/cfmb_product_edit.php');
}


//save custom fields values
function woocommerce_product_custom_fields_save($post_id)
{
    //get attributes
    $terms = wc_get_attribute_taxonomies();
    $options = get_option('mg_wc_cfmb');
    foreach ( $options AS $key=>$value ){
      if ( !$value['custom_tab'] ){
        if ( isset($_POST['_cf_'.$value['name']]) ){
          $woocommerce_custom_product_textarea = $_POST['_cf_'.$value['name']];
          if (!empty($woocommerce_custom_product_textarea)){
            update_post_meta($post_id, '_cf_'.$value['name'], esc_html($woocommerce_custom_product_textarea));
          } else {
            delete_post_meta($post_id,'_cf_'.$value['name']);
          }
        }
      }
    }
    /*
    foreach ( $terms AS $attribute ){
      // Save Custom Product Textarea Field
      $woocommerce_custom_product_textarea = $_POST['_cf_'.$attribute->attribute_name];
      //if not empty field save custom field
      if (!empty($woocommerce_custom_product_textarea))
        update_post_meta($post_id, '_cf_'.$attribute->attribute_name, esc_html($woocommerce_custom_product_textarea));
    }
    */

}




/*--------------- FRONT END ----------------------*/
//frontend display custom fields (meta)
//add_action('woocommerce_product_meta_end' , 'wc_aacf_meta' , 60);
add_action('woocommerce_product_meta_end' , 'wc_cfmb_meta' , 60);

//frontend display custom fields (tab)
add_filter( 'woocommerce_product_tabs', 'wpb_new_product_tab' );

$options = get_option('mg_wc_cfmb');
if ( $options ){
foreach ( $options AS $k=>$v ) {
  if ( $v['custom_tab'] ){
    if ( !$v['custom_tab']['active'] == 0 ){
      add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
    }
  }
}
}

//remove tab description (if enabled)
function woo_remove_product_tabs($tabs){
    unset( $tabs['description'] );      	// Remove the description tab
    return $tabs;
}

//create new tab
function wpb_new_product_tab( $tabs ) {
    // Add the new tab
    //$title = get_option('mg_aacf_tab_name');
    //$options = get_option('mg_wc_cfmb');
    //$title = $options['custom_tab']['tab_name'];
    $opts = get_option('mg_wc_cfmb');
    if ( $opts ){
    foreach ( $opts AS $k=>$o ){
      if ( $o['custom_tab'] ){
        $tab_name = $o['custom_tab']['tab_name'];
      }
    }
    $tabs['custom_fields'] = array(
        'title'       => __( $tab_name , 'text-domain' ),
        'priority'    => 0,
        'callback'    => 'wpb_new_product_tab_content'
    );
    return $tabs;
  } else {
    return false;
  }
}


//output to tab
function wpb_new_product_tab_content() {
  $options = get_option('mg_wc_cfmb');
  if ( $options ){
  foreach ( $options AS $key=>$option ) {
    if ( $option['custom_tab'] ){
      if ( $option['custom_tab']['active'] ){
        ?><p><?php echo the_content();?></p>
        <?php
      }
    }
  }
  ?>
  <table class="shop_attributes">
    <tbody>
    <?php
      $au_meta = get_post_meta(get_the_ID());

      foreach ( $options AS $key=>$value ){

        if ( !$value['custom_tab'] ){
          //echo $value['name'].'<br>';
          if ( $value['active'] ){
            $field = '_cf_'.$value['name'];
            $label = $value['label'];
            if ( $au_meta[$field] ){
              $meta = $au_meta[$field];
              if ( esc_attr($meta[0]) != '' ){
                ?><tr><th><?php echo $label;?></th>
                  <td>
                    <?php
                    echo htmlspecialchars_decode($meta[0]);
                    ?></td></tr>
              <?php
              }
            }
          }
        }
      }
      ?>
    </tbody>
  </table>
  <?php
  }
}


//meta output (single product)
function wc_cfmb_meta(){
  $options = get_option('mg_wc_cfmb');
  $id = get_the_ID();
  if ( $options ){
  foreach ( $options AS $key=>$value ){
    if ( !$value['custom_tab'] ){
      if ( $value['meta'] == 1 ){
        $label = $value['label'];
        $meta = get_post_meta($id,$key='_cf_'.$value['name']);
        ?>
        <span class=""><?php echo $label;?>: <span><?php echo $meta[0];?></span></span>
        <?php
      }
    }
  }
  }
}
