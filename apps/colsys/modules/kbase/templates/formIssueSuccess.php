<!-- Skin CSS file -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/assets/skins/sam/skin.css">
<!-- Utility Dependencies -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/element/element-min.js"></script>
<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
<script src="http://yui.yahooapis.com/2.8.1/build/container/container_core-min.js"></script>
<script src="http://yui.yahooapis.com/2.8.1/build/menu/menu-min.js"></script>
<script src="http://yui.yahooapis.com/2.8.1/build/button/button-min.js"></script>
<!-- Source file for Rich Text Editor-->
<script src="http://yui.yahooapis.com/2.8.1/build/editor/editor-min.js"></script>
<script src="http://yui.yahooapis.com/2.8.1/build/connection/connection-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/logger/logger-min.js"></script>


<script src="/js/yui-image-uploader26.js"></script>



<?
$issue = $sf_data->getRaw("issue");

$info = str_replace("\"", "'",str_replace("\n", "<br />",str_replace("\r\n", "<br />", $issue->getCaInfo())));
$info = str_replace("<b>", "<strong>", $info);
$info = str_replace("</b>", "</strong>", $info);

?>
<div class="content" align="center">

    <h1>Administraci&oacute;n de la base de datos de conocimiento</h1>

    <br />

       <?
       if( $message ){
           echo "<span class='rojo'>".$message."</span><br /><br />";
       }
       ?>
        <form action="<?=url_for("kbase/formIssue")?>" method="post">
            <input type="hidden" name="id" value="<?=$issue->getCaIdissue()?>"/>
            <input type="hidden" name="idcategory" value="<?=$idcategory?$idcategory:$issue->getCaIdcategory()?>"/>
            <table class="tableList" width="80%">
                <tr>
                    <td>
                        <b>Titulo:</b><br />
                        <input type="text" name="title" value="<?=$issue->getCaTitle()?>" size="113" maxlength="255" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Resumen:</b><br />
                        <textarea name="summary" cols="110" rows="2"><?=$issue->getCaSummary()?></textarea>

                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="yui-skin-sam">
                            <textarea id="info" name="info" rows="20" cols="75"><?=$info?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center"><input type="submit" value="Guardar" class="button"/></div>
                    </td>
                </tr>
            </table>
    </form>
</div>





<script type="text/javascript">
YAHOO.widget.Logger.enableBrowserConsole();
var myEditor = new YAHOO.widget.Editor('info', {
	    height: '300px',
	    width: '522px',
        handleSubmit: true,

	    dompath: true,
	    animate: true
	});
yuiImgUploader(myEditor, 'info', '<?=url_for("gestDocumental/uploadImage?folder=KBase&idissue=".$issue->getCaIdissue())?>','image');
	myEditor.render();
    
</script>






