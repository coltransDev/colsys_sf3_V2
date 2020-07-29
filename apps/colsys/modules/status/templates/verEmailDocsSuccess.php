<?php
use_helper("MimeType");
$files=  $sf_data->getRaw("files");

//echo count($files);
?>

<div align="center" class="content" style="width: 80%">
    <div id="emailForm"  >
        <form name="form1" id="form1" method="post" action="<?= url_for("/status/enviarEmailDocs" ) ?>">
            <table border="0" cellspacing="0" cellpadding="0" class="tableList">
                <tr><td>
                        <?php
                        
                        
                        $message = "Señores\n\n\n\n\n";
                        $hora = date("G");
                        if ($hora < 12) {
                            $message .= "Buenos dias,";
                        } elseif ($hora < 19) {
                            $message .= "Buenas tardes,";
                        } else {
                            $message .= "Buenas noches,";
                        }
                        
                        $message .= "\n\nNotificamos que se encuentran los siguientes archivo en la referencia:";
                        
                        foreach ($files as $file) {                            
                            //$filename = $file->getCaNombre();
                            $message .= "\n\nTipo:  ".$file->getTipoDocumental()->getCaDocumento()."     Archivo: ".$file->getCaRef1()."/".$file->getCaRef2()."/".$file->getCaNombre();
                        }
                        //echo "23";
                        //$message .= "\n\nRemitimos  documento en asunto.";
                        //$message .= "\n\nQuedamos a  su  entera  disposición  para  atender  cualquier inquietud adicional.";
                        //$message .= "\n\nReciban un cordial saludo,\n\n";
                        //$message .= $usuario->getFirma();

                        include_component("email", "formEmail", array("subject" => $asunto, "message" => $message, "contacts" => $contactos));
                        ?>
                    </td></tr>

                <tr>
                    <td><b>Adjuntar documentos</b><br/>
                        <?php
                        
                        /*
                        //$referencia = $reporte->getNumReferencia();
                        
                        //echo "<b>Ref.: ".$referencia."</b>";

                        foreach ($files as $file) {
                            $tipodoc = $file->getTipoDocumental();
                            $iddoc = 0;
                            
                            $datos = json_decode($file->getCaDatos());                                        
                            $idarchivo = $file->getCaIdarchivo();
                            $documento = $tipodoc->getCaDocumento();
                            $filename = $file->getCaNombre();
                            ?>
                            <input type="checkbox" name="attachments[]" value="<?= $idarchivo ?>" class="imgS" idarchivo="<?=$idarchivo?>" documento="<?=$documento?>" />
                            <?php
                            //https://172.16.1.13/gestDocumental/verArchivo?id_archivo=1121653&condicion=pdf
                            echo mime_type_icon(basename($filename)) . " " . link_to(basename($filename), url_for("gestDocumental/verArchivo?id_archivo=" . $idarchivo . "&gestDoc=true")) . "<br />";
                            
                        }
                          */  
                        
                        ?>

                    </td>
                </tr>
                
            </table><br />
            <div align="center"><input class="submit" type='submit' value="Enviar" onClick="/*javascript:enviarFormulario()*/" /></div>
        </form>
    </div>    
</div>