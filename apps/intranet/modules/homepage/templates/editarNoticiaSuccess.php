<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use_helper("ExtCalendar");

$folder = "Noticia";
$noticia = $sf_data->getRaw("noticia");

$info = str_replace("\"", "'",str_replace("\n", "<br />",str_replace("\r\n", "<br />", $noticia->getCaDetalle())));
$info = str_replace("<b>", "<strong>", $info);
$info = str_replace("</b>", "</strong>", $info);
?>

<div class="content" align="center">

    <h1>Administraci&oacute;n de noticias</h1>

    <br />

       
        <form action="<?=url_for("homepage/guardarNoticia")?>" method="post">
            <input type="hidden" name="idnoticia" value="<?=$idnoticia?>"/>
            
            <table class="tableList">
                <tr>
                    <td colspan="3">
                        <b >Titulo:</b><br />
                        <input type="text" name="title" value="<?=$noticia->getCaAsunto()?>" size ="98" maxlength="255" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b >Categoría:</b><br />
                        <select name="categoria" id="categoria">
                            <option value="General" <?=$noticia->getCaCategoria()=="General"?'selected="selected"':''?>>General</option>
                            <option value="Medellin" <?=$noticia->getCaCategoria()=="General"?'selected="selected"':''?>>Medellín</option>
                            <option value="Cali" <?=$noticia->getCaCategoria()=="Cali"?'selected="selected"':''?>>Cali</option>
                         </select>

                    </td>
                    <td>
                        <b>Publíquese desde:</b>
                            <?
                                //$tarea = $ticket->getTareaSeguimiento();
                                echo extDatePicker("fchpublicacion", ($noticia?$noticia->getCaFchpublicacion("Y-m-d"):date("Y-m-d")));
                            ?>
                    </td>
                    <td align="left">
                         <b>Hasta</b>
			<?
                            //$tarea = $ticket->getTareaSeguimiento();
                            echo extDatePicker("fcharchivar", ($noticia?$noticia->getCaFcharchivar("Y-m-d"):date("Y-m-d")));
                        ?>
                    </td>
		</tr>
                <tr>
                    <td colspan="3">
                        <div class="yui-skin-sam">
                            <textarea id="info" name="info" rows="20" cols="75"><?=$info?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="3" size ="80">
                         <b>Icono</b>
                    <input type="text" name="icon" value="<?=$noticia->getCaIcon()?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
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
	    width: '700px',
        handleSubmit: true,

	    dompath: true,
	    animate: true
	});
    yuiImgUploader(myEditor, 'info', '<?=url_for("gestDocumental/uploadImage?folder=".$folder)?>','image');
	myEditor.render();         


</script>