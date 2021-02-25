<?
use_helper("MimeType");
?>
<script language="javascript" type="text/javascript">

    var enviarFormulario = function () {

        var idg = $("#idg").attr('checked');
        var destinatarios = $("#destinatario").val();

        if (destinatarios.length == 0) {
            Ext.Msg.alert('Error', "Debe seleccionar al menos un destinatario");            
            $("#destinatario").focus();
            return false;
        } else {
            if (idg) {                
                $('.imgS').each(function (i, obj) {
                    if (obj.checked) {
                        if (obj.getAttribute('idarchivo') > 0) {                            
                            var observaciones = $("#observaciones");
                            var exclusiones = $("#exclusiones");                 
                            var idcomprobante = obj.getAttribute('idcomprobante');
                            var row = new Object();
                            var files = [];
                            var justificaciones = "";

                            row.idhouse = "<?=$idhouse?>";
                            row.idarchivo = obj.getAttribute('idarchivo');
                            row.idcomprobante = obj.getAttribute('idcomprobante');
                            row.documento = obj.getAttribute('documento');
                            files.push(row);
                            
                            justificaciones+= '"'+observaciones.val()+'"';

                            var parametros = {
                                "strFiles": JSON.stringify(files)
                            };

                            Ext.Ajax.request({                        
                                waitMsg: 'Enviando...',
                                url: '/status/idgConfirmacion',
                                params: {
                                    idhouses: "["+<?=$idhouse?>+"]",                            
                                    justificaciones: "["+justificaciones+"]",
                                    exclusiones: "["+exclusiones.val()+"]",
                                    datosArchivos: parametros.strFiles,
                                    modo: 'ffletes',
                                    tipofactura: 'ffletes'                            
                                },
                                failure: function (response, options) {
                                    alert(response.responseText);
                                    Ext.Msg.hide();
                                    alert("Surgio un problema al tratar de calcular el tiempo de oportunidad.")
                                },
                                success: function (response, options) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    var error = 0;
                                    var mensaje = "";
                                    
                                    if(res.data != null){
                                        $.each(res.data, function (key, objIdg) {                                           
                                            if (objIdg["cumplio"] == "No") {
                                                mensaje+= objIdg["mensaje"];
                                                
                                                if(objIdg["exclusiones"]){
                                                    $('.idgC').show();
                                                    observaciones.attr("required", "true");
                                                    $('.idgC').focus();
                                                }                                                
                                                error++;
                                            }                              
                                        });
                                    }
                                    
                                    if (error === 0){
                                        $("#form1").submit();                                        
                                        Ext.getCmp('window-envio-factura-'+idcomprobante).close();
                                        Ext.Msg.alert('Información', "El correo se ha enviado correctamente");
                                    }else
                                        Ext.Msg.alert('Error', "Status con Errores! Por favor revisar: <br/>"+mensaje);
                                }
                            });
                        }else{
                            Ext.Msg.alert('Error', "Por favor seleccione al menos una factura registrada en Gestión Documental");
                        }
                    }else{
                        Ext.Msg.alert('Error', "Por favor seleccione al menos una factura registrada en Gestión Documental");
                    }
                })                
            } else {
                $("#form1").submit();
            }
        }
    }
</script>
<div align="center" class="content" style="width: 80%">
    <div id="emailForm"  >
        <form name="form1" id="form1" method="post" action="<?= url_for("/status/enviarEmailTerceros?id=" . $reporte->getCaIdreporte()) ?>">
            <table border="0" cellspacing="0" cellpadding="0" class="tableList">
                <tr><td>
                        <?
                        $message = "Señores\n\n" . $ids->getCaNombre() . "\n\n\n";
                        $hora = date("G");
                        if ($hora < 12) {
                            $message .= "Buenos dias,";
                        } elseif ($hora < 19) {
                            $message .= "Buenas tardes,";
                        } else {
                            $message .= "Buenas noches,";
                        }
                        $message .= "\n\nRemitimos  documento en asunto.";
                        $message .= "\n\nQuedamos a  su  entera  disposición  para  atender  cualquier inquietud adicional.";
                        $message .= "\n\nReciban un cordial saludo,\n\n";
                        $message .= $usuario->getFirma();

                        include_component("email", "formEmail", array("subject" => $asunto, "message" => $message, "contacts" => $contactos));
                        ?>
                    </td></tr>

                <tr>
                    <td><b>Adjuntar documentos</b><br/>
                        <?
                        $referencia = $reporte->getNumReferencia();
                        if ($referencia) {
                            echo "<b>Ref.: ".$referencia."</b><br/>";
                            echo "<b>Doc. Transporte</b>: ".$reporte->getDoctransporte();
                            $archivos = $reporte->getFilesGestDoc();
                            if (count($archivos)) {
                                foreach ($archivos as $file) {
                                    $tipodoc = $file->getTipoDocumental();
                                    $iddoc = 0;
                                    if (strpos($tipodoc->getCaDocumento(), "Factura") !== false) {
                                        $datos = json_decode($file->getCaDatos());                                        
                                        $idarchivo = $file->getCaIdarchivo();
                                        $documento = $tipodoc->getCaDocumento();
                                        $idcomprobante = $idcomprobantes[$file->getCaIdarchivo()];
                                    }
                                    $filename = $file->getCaNombre();
                                    ?>
                                    <input type="checkbox" name="attachments[]" value="<?= $reporte->getCaIdreporte() . "_" . base64_encode(basename($filename)) ?>" class="imgS" idarchivo="<?=$idarchivo?>" documento="<?=$documento?>" idcomprobante="<?=$idcomprobante?>"/>
                                    <?
                                    echo mime_type_icon(basename($filename)) . " " . link_to(basename($filename), url_for("traficos/fileViewer?idreporte=" . $reporte->getCaIdreporte() . "&gestDoc=true&file=" . base64_encode(basename($filename)))) . "<br />";
                                }
                            }
                        }else{
                            echo "<b>Ref.: No se encuentra referencia asociada a este documento</b>";
                        }
                        ?>

                    </td>
                </tr>
                <tr><td><input type="checkbox" name="idg" id="idg" checked="checked"/><b>&nbsp;Requiere Idg</b></td></tr>
                <tr class="idgC" style="display: none;"><td><b>Exclusiones:</b><br/>
                        <select id="exclusiones">
                            <?
                            foreach($exclusiones as $key => $exclusion){
                                ?>
                                <option value="<?=$key?>"><?=$exclusion?></option>
                                <?                                
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr class="idgC" style="display: none;"><td><b>Observaciones</b><br/><input id="observaciones" type="text" name="observaciones" size="100"></td></tr>
            </table><br />
            <div align="center"><input class="submit" type='button' value="Enviar" onClick="javascript:enviarFormulario()" /></div>
        </form>
    </div>    
</div>