<?php

?>

<script type="text/javascript">            
WidgetUploadImagesTRD = function( config ){
    
        swfu = new SWFUpload({
            
            upload_url: "<?=url_for('gestDocumental/subirArchivoTRD')?>",
            post_params: config.post_params,            
            file_size_limit : (config.file_size_limit)?config.file_size_limit:"10 MB",
            file_types : (config.file_size_limit)?config.file_size_limit:"*.JPG;*.jpg;*.png;*.gif",
            file_types_description : (config.file_types_description)?config.file_types_description:"JPG Images; PNG Image;GIF Images",
            file_upload_limit : 0,
            
            swfupload_preload_handler : preLoad,
            swfupload_load_failed_handler : loadFailed,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,

            button_image_url : "/js/swfupload/images/SmallSpyGlassWithTransperancy_17x18.png",
            button_placeholder_id : config.button_placeholder_id,
            button_width: 180,
            button_height: 18,
            button_text : '<span class="button">Buscar Imagenes <span class="buttonSmall">(2 MB Max)</span></span>',
            button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
            button_text_top_padding: 0,
            button_text_left_padding: 18,
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor: SWFUpload.CURSOR.HAND,

            flash_url : "<?=$baseUrl?>/swfupload.swf",
            flash9_url : "<?=$baseUrl?>/swfupload_fp9.swf",

            custom_settings : {
                upload_target : config.upload_target,
                thumbnail_height: 400,
                thumbnail_width: 400,
                thumbnail_quality: 100
            },
            debug: false
        });  
    
};

Ext.extend(WidgetUploadImagesTRD, SWFUpload, {
    

});
</script>
