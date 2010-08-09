<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use_helper("ExtCalendar");

$folder = "ColNovedad";
$novedad = $sf_data->getRaw("novedad");

$info = str_replace("\"", "'",str_replace("\n", "<br />",str_replace("\r\n", "<br />", $novedad->getCaDetalle())));
$info = str_replace("<b>", "<strong>", $info);
$info = str_replace("</b>", "</strong>", $info);
?>

<div class="content" align="center">

    <h1>Administraci&oacute;n de Novedades</h1>

    <br />

       
        <form action="<?=url_for("homepage/guardarNovedad")?>" method="post">
            <input type="hidden" name="idnovedad" value="<?=$idnovedad?>"/>
            
            <table class="tableList" width="50%">
                <tr>
                    <td colspan="2">
                        <b >Titulo:</b><br />
                        <input type="text" name="title" value="<?=$novedad->getCaAsunto()?>" size="113" maxlength="255" />
                    </td>
                </tr>                
                <tr>
                    <td>
                        <b>Publíquese desde:</b>
                            <?
                                //$tarea = $ticket->getTareaSeguimiento();
                                echo extDatePicker("fchpublicacion", ($novedad?$novedad->getCaFchpublicacion("Y-m-d"):date("Y-m-d")));
                            ?>
                    </td>
                    <td align="left">
                         <b>Hasta</b>
			<?
                            //$tarea = $ticket->getTareaSeguimiento();
                            echo extDatePicker("fcharchivar", ($novedad?$novedad->getCaFcharchivar("Y-m-d"):date("Y-m-d")));
                        ?>
                    </td>
		</tr>
                <tr>
                    <td colspan="2">
                        <div class="yui-skin-sam">
                            <textarea id="info" name="info" rows="20" cols="75"><?=$info?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="center"><input type="submit" value="Guardar" class="button"/></div>
                    </td>
                </tr>
            </table>
                
               
    </form>
</div>


<input type="button" value="Prueba" onClick="alert(document.getElementById('fchpublicacion').value)">

<script type="text/javascript">
YAHOO.widget.Logger.enableBrowserConsole();
var myEditor = new YAHOO.widget.Editor('info', {
	    height: '300px',
	    width: '800px',
        handleSubmit: true,

	    dompath: true,
	    animate: true
	});
    yuiImgUploader(myEditor, 'info', '<?=url_for("gestDocumental/uploadImage?folder=".$folder)?>','image');
	myEditor.render();         


</script>