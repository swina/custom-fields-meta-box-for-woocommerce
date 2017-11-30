<style>
  .product_custom_field p label { display:block!important;width:100%;font-weight:bold; }

</style>
<div class="product_custom_field">'
<?php
//display fields
global $woocommerce, $post;
wp_enqueue_script ('../assets/bootstrap/js/bootstrap.min.js');

$options = get_option('mg_wc_cfmb');
$settings = array(
  'quicktags' => array('buttons' => 'em,strong,link',),
  'quicktags' => true,
  'tinymce' => true,
  'textarea_rows' => 5,
);
if ( $options ){
  $au_meta = get_post_meta(get_the_ID());
  $aFieldsAdd = [];
  ?>
  <div class="custom_fields">
  <?php
  foreach ( $options AS $key=>$value ){

  if ( !$value['custom_tab'] ){
    $field = $value['name'];
    $content = '';
    if ( $au_meta['_cf_'.$field] ){
      $meta = $au_meta['_cf_'.$field];
      $content = $meta[0];
    }

    if ( $content != '' ){ ?>
      <div class="custom_field_saved_<?php echo $value['name'];?>">
        <h3><?php echo $value['label'];?></h3>
        <textarea style="width:100%;" id="_cf_<?php echo $value['name'];?>_textarea" name="_cf_<?php echo $value['name']?>"><?php echo $content;?></textarea>
        <span class="btn-editor btn-cf" data-field="_cf_<?php echo $value['name'];?>" data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><span class="dashicons dashicons-edit"></span> Editor</span>
        <span class="btn-field-remove-saved btn-cf" data-field="<?php echo $value['name'];?>" style="cursor:pointer;">
        <span class="dashicons dashicons-trash"></span>
        Remove</span>
        <span class="btn-custom-field-preview btn-cf" data-field="<?php echo $value['name'];?>" style="cursor:pointer" data-toggle="modal" data-target="cf_preview_modal"><span class="dashicons dashicons-visibility"></span> Preview</span>
      </div>
    <?php
    } else {
      $a = array (
        'name' => $value['name'],
        'label' => $value['label']
      );
      array_push($aFieldsAdd,$a);
    }
  }
  }
  ?>
  </div>
  <div class="form-field" style="margin-top:20px;margin-bottom:20px;padding:10px;border-top:1px solid #eaeaea;border-bottom:1px solid #eaeaea;width:100%;display:block;font-size:1.3em;">

  Add Custom Field <select class="select_cfmb">
    <option value=""></option>
    <?php
      foreach ( $aFieldsAdd AS $key=>$value ){
        if ( !$value['custom_tab'] ){
          ?>
          <option value="<?php echo $value['name'];?>">
            <?php echo $value['label'];?>
          </option>
        <?php
        }
      }
     ?>
  </select>
  </div>
  <?php
}
?>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Custom Field Editor</h4>
    </div>

    <div class="modal-body">
    <?php
      wp_editor( htmlspecialchars_decode($content) , '_cf_editor',$settings );
    ?>
    </div>
    <div class="modal-footer"><button class="button button-default" type="button" data-dismiss="modal">Close</button>
      <button class="button button-primary btn-save-cfmb" type="button">Save changes</button></div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="cf_preview_modal" class="modal fade" tabindex="-1">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Custom Field Preview</h4>
    </div>

    <div class="modal-body">
      <p class="modal-body-cf_preview">
      </p>

    </div>
    <div class="modal-footer"><button class="button button-default" type="button" data-dismiss="modal">Close</button>
      <button class="button button-primary btn-save-cfmb" type="button">Save changes</button></div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
