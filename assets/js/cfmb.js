jQuery(document).ready(function(){
  //jQuery('.wp-editor-wrap').css('display','none');
  jQuery('.btn-editor').on('click',function(){
    var editor = jQuery(this).data('field')+'-wrap';
    var field = jQuery(this).data('field');
    console.log(jQuery('#' + field + '_textarea' ).val());
    jQuery('.btn-save-cfmb').attr('data-field',field);
    console.log ( jQuery('#_cf_editor').html() );
    var editor = tinymce.get('_cf_editor');
    // use your own editor id here
    editor.setContent(jQuery('#' + field + '_textarea' ).val());
  })

  jQuery('.btn-save-cfmb').on('click',function(){
    var editor = tinymce.get('_cf_editor');
    jQuery('#' + jQuery(this).data('field') + '_textarea').val ( editor.getContent());
    jQuery('#myModal').modal('hide');
  })

  jQuery('.btn-field-remove-saved').on('click',function(){
    var obj = jQuery(this);
    var target = jQuery('.custom_field_saved_' + obj.data('field') );
    var txt_to_clear = jQuery('#_cf_' + obj.data('field') + '_textarea');
    target.css('display','none');
    jQuery('#_cf_' + obj.data('field') + '_textarea').val('');
  })

  jQuery('.select_cfmb').on('change',function(){
    var obj = jQuery(this);
    var txt = jQuery('.select_cfmb :selected').text();
    if ( obj.val() != '' ){
      console.log ( obj.val() );
      jQuery('.custom_fields').append(
        '\
        <div class="custom_field_'+obj.val()+'"><h3>' + txt + '</h3>\
        <textarea id="_cf_' + obj.val() + '_textarea" name="_cf_' + obj.val() + '" style="width:100%;"></textarea>\
        <span class="btn-editor" data-field="_cf_' + obj.val() + '" data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><span class="dashicons dashicons-edit"></span> Editor</span> \
        <span class="btn-field-remove" data-field="' + obj.val() + '" style="cursor:pointer;">\
        <span class="dashicons dashicons-trash"></span> \
        Remove</span></div>'
      )
      jQuery('option:selected',this).remove();
    }
  })

  jQuery(document).delegate('.btn-field-remove','click',function(){
    var obj = jQuery(this);
    var id = obj.data('field');
    jQuery('.custom_field_' + id).remove();
  })

  jQuery(document).delegate('.btn-custom-field-preview','click',function(){
    var obj = jQuery(this);
    var id = obj.data('field');
    var txt = jQuery('#_cf_' + id + '_textarea').val();
    console.log ( txt );
    jQuery('.modal-body-cf_preview').html(txt);
    jQuery('#cf_preview_modal').modal('show');
  })

})
