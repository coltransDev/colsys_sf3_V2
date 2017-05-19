<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
sfContext::getInstance()->getResponse()->removeStylesheet("/js/ext4/resources/css/ext-all-neptune.css");
sfContext::getInstance()->getResponse()->removeJavascript("ext4/ext-all.js");
sfContext::getInstance()->getResponse()->removeJavascript("ext4/ux/multiupload/swfobject.js");
use_stylesheet('ext/css/ext-all.css');
use_javascript('ext/adapter/ext/ext-base.js');
use_javascript('ext/ext-all.js');
use_javascript('ext/src/locale/ext-lang-es.js');

use_helper("ExtCalendar");


$noticia = $sf_data->getRaw("noticia");

$info = str_replace("\"", "'",str_replace("\n", "<br />",str_replace("\r\n", "<br />", $noticia->getCaDetalle())));
$info = str_replace("<b>", "<strong>", $info);
$info = str_replace("</b>", "</strong>", $info);
?>

<div class="content" align="center">

    <h1>Administraci&oacute;n de noticias</h1>

    <br />

       
        <form action="<?=url_for("noticias/formNoticia")?>" method="post">
            <?
            echo $form['idnoticia']->renderError();
            $form->setDefault('idnoticia', $noticia->getCaIdnoticia() );
            echo $form['idnoticia']->render();
            ?>
            <table class="tableList" width="100%">
                <tr>
                    <td colspan="3">
                        <b >Titulo:</b><br />
                        
                        <?
                        echo $form['title']->renderError();
                        $form->setDefault('title', $noticia->getCaAsunto() );
                        echo $form['title']->render();
                        ?>                        
                       
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Publíquese desde:</b>
                        <?
                        echo $form['fchpublicacion']->renderError();
                        $form->setDefault('fchpublicacion', $noticia&&$noticia->getCaFchpublicacion()?$noticia->getCaFchpublicacion("Y-m-d"):date("Y-m-d") );
                        echo $form['fchpublicacion']->render();
                        ?>                         

                    </td>
                    <td>
                       <b>Hasta</b>                       
                        <?
                        echo $form['fcharchivar']->renderError();
                        $form->setDefault('fcharchivar', $noticia&&$noticia->getCaFcharchivar()?$noticia->getCaFcharchivar():date("Y-m-d", time()+86400*8) );
                        echo $form['fcharchivar']->render();
                        ?> 
                    </td>
                    <td align="left">
                         
                    </td>
		</tr>
                <tr>
                    <td colspan="3">
                        <b >Sucursal:</b><br />
                        <div align="left">
                            <?
                            echo $form['idsucursal']->renderError();
                            $form->setDefault('idsucursal', $noticia->getCaIdsucursal() );
                            echo $form['idsucursal']->render();  
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="yui-skin-sam">
                            
                            <?
                            echo $form['info']->renderError();
                            $form->setDefault('info', $info );
                            echo $form['info']->render();
                            ?>                             
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="3" size ="80">
                    <b>Icono</b>
                    <?
                    echo $form['icon']->renderError();
                    $form->setDefault('icon', $noticia->getCaIcon() );
                    echo $form['icon']->render();
                    ?>
                    
                    <?
                    $url = "noticias/agregarIcono";
                    if( $noticia->getCaIdnoticia() ){ 
                        $url .= "?idnoticia=".$noticia->getCaIdnoticia();
                    }
                    
                    echo link_to("Agregar iconos", $url, array("confirm"=>"Asegurese de guardar antes de ir a esta opción o perdera los cambios"));
                    ?>                    
                    
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
    /*yuiImgUploader(myEditor, 'info', '<? //url_for("gestDocumental/uploadImage?folder=".$folder.DIRECTORY_SEPARATOR."Imagenes")?>','image');*/
	myEditor.render();         


</script>