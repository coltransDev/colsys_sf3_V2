<?
use_helper( "MimeType");
?>

<div align="center" class="content" style="width: 80%">
    <div id="emailForm"  >
            <form name="form1" id="form1" method="post" action="<?=url_for("pm/enviarSolicitudEmail?id=".$ticket->getCaIdticket())?>">
            <?					 
            include_component("email", "formEmail", array("subject"=>$asunto,"message"=>"","contacts"=>""));
            ?>
            <br />            
            <?
            $files = $ticket->getFiles();
                if( count($files) ){			
                    ?>
                    <tr>
                        <td colspan="6"  > 
                            <div align="left"><b>Adjuntar documento :</b><br />
                                <?			
                                foreach( $files as $file ){
                                    //$fileIdx = $user->addFile( $file );                                    
                                    ?>
                                    <input type="checkbox" name="attachments[]" value="<?=$ticket->getCaIdticket()."_".base64_encode(basename($file))?>" />
                                    <?
                                    echo mime_type_icon( basename($file) )." ".link_to(basename( $file ), url_for("traficos/fileViewer?idreporte=".$ticket->getCaIdticket()."&file=".base64_encode(basename($file)) ) )."<br />";				
                                }                                
                                ?>
                            </div>
                        </td>
                    </tr>
                <?
                }
            ?>
            <div align="center"><input type="submit" name="commit" value="Enviar" class="button" /></div><br /><br />
        </form>
    </div>
    <iframe src="<?=url_for("pm/generarTarifasPDF?idticket=".$ticket->getCaIdticket()."&tipo=externo")?>" width="700" height="500"></iframe>
</div>