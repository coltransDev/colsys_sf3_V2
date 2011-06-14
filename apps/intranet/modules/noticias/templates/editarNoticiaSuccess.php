<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use_helper("ExtCalendar");


$noticia = $sf_data->getRaw("noticia");

$info = str_replace("\"", "'",str_replace("\n", "<br />",str_replace("\r\n", "<br />", $noticia->getCaDetalle())));
$info = str_replace("<b>", "<strong>", $info);
$info = str_replace("</b>", "</strong>", $info);
?>

<div class="content" align="center">

    <h1>Administraci&oacute;n de noticias</h1>

    <br />

       
        <form action="<?=url_for("noticias/guardarNoticia")?>" method="post">
            <input type="hidden" name="idnoticia" value="<?=$idnoticia?>"/>
            
            <table class="tableList" width="100%">
                <tr>
                    <td colspan="3">
                        <b >Titulo:</b><br />
                        <input type="text" name="title" value="<?=$noticia->getCaAsunto()?>" size ="70" maxlength="255" />
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
                    <select name="icon">
                        
                        <?
                        foreach ($archivos as $archivo) {
                            $ext = strtolower(substr($archivo, -3, 3));
                            if ($ext != "jpg" && $ext != "png" && $ext != "gif") {
                                continue;
                            }                        
                            
                            $url = url_for("gestDocumental/verArchivo?folder=" . base64_encode($folder.DIRECTORY_SEPARATOR."Iconos") . "&idarchivo=" . base64_encode(basename($archivo)));
                        ?>                        
                        <option value="<?=$url ?>" <?=($noticia&&$noticia->getCaIcon()==$url)?"selected='selected'":"" ?> >
                            <?=basename($archivo)?> 
                        </option>                        
                        <?
                        }
                        ?>
                    </select>
                    
                    
                    <a href="<?=url_for("noticias/agregarIcono?idnoticia=5")?>">Agregar iconos</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div align="center">
                            <input type="submit" value="Guardar" class="button"/> &nbsp;
                            <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("homepage")?>'"/>
                        </div>
                    </td>
                </tr>
            </table>
                
               
    </form>
</div>




<script type="text/javascript">
YAHOO.widget.Logger.enableBrowserConsole();
var myEditor = new YAHOO.widget.Editor('info', {
	    height: '300px',
	    width: '100%',
        handleSubmit: true,

	    dompath: true,
	    animate: true
	});
    yuiImgUploader(myEditor, 'info', '<?=url_for("gestDocumental/uploadImage?folder=".$folder.DIRECTORY_SEPARATOR."Imagenes")?>','image');
	myEditor.render();         


</script>