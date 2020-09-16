<?
include_component("gestDocumental", "widgetUploadButton");
use_helper("MimeType");
$grupo = $ticket->getHdeskGroup();
$proyecto = $ticket->getHdeskProject();

$ticket = $sf_data->getRaw("ticket");
$i = 1;
?>

<script language="javascript">
    function comentar(  ) {
        document.getElementById("coment_status_txt").style.display = "inline";
        document.getElementById("coment_status").style.display = "none";
    }

    function cancelar_comentar(  ) {
        document.getElementById("coment_status").style.display = "inline";
        document.getElementById("coment_status_txt").style.display = "none";
    }

    function guardar_comentario(idticket) {
        cancelar_comentar();

        var txt = document.getElementById("coment_status_field").value;
        document.getElementById("coment_status_field").value = "";
        Ext.Ajax.request(
                {
                    waitMsg: 'Guardando...',
                    url: '<?= url_for("helpdesk/guardarRespuestaTicket") ?>',
                    params: {
                        idticket: idticket,
                        comentario: txt
                    },
                    callback: function (options, success, response) {
                        document.getElementById("coments").innerHTML = response.responseText;
                    }
                }
        );
    }
</script>


<div align="left" style="margin-left:30px;margin-right:30px;">


    <h1>Ticket # <?= $ticket->getCaIdticket() ?></h1>
    <br>

    <table width="100%"  border="0" class="tableList">
        <tr>
            <th colspan="2" scope="col">&nbsp;<b><?= Utils::replace($ticket->getCaTitle()) ?></b></th>
        </tr>
        <tr>
            <td width="50%" class="listar"><b>Reportado por:</b> <?= $ticket->getUsuario() ? $ticket->getUsuario()->getCaNombre() : $ticket->getCaLogin() ?></td>
            <td width="50%" class="listar"><b>Abierto </b> <?= Utils::fechaMes($ticket->getCaOpened()) ?> </td>
        </tr>
        <tr>
            <td width="50%" class="listar"><b>Contacto:</b> <?= $ticket->getUsuario() ? $ticket->getUsuario()->getSucursal()->getCaNombre() . " " . $ticket->getUsuario()->getCaExtension() : "&nbsp;" ?></td>
            <td width="50%" class="listar">&nbsp; </td>
        </tr>
        <tr>
            <td class="listar"><b>Departamento:</b>
                <?
                if ($grupo) {
                    $departamento = $grupo->getDepartamento();
                    echo Utils::replace($departamento->getCaNombre());
                }
                ?>
            </td>
            <td class="listar"><b>Area: </b>  
                <?
                if ($grupo) {
                    echo Utils::replace($grupo->getCaName());
                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="listar"><b>Proyecto: </b>
                <?
                if ($proyecto) {
                    echo Utils::replace($proyecto->getCaName());
                }
                ?>
            </td>
            <td class="listar">&nbsp;</td>
        </tr>
        <tr>
            <td class="listar"><b>Prioridad: </b><?= $ticket->getCaPriority() ?></td>
            <td class="listar"><b>Asignado a:</b> 
                <?
                if ($ticket->getCaAssignedto()) {
                    $asignado = $ticket->getAssignedUser();
                    if ($asignado) {
                        echo $asignado->getCaNombre() . "&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                } else {
                    echo "Por asignar&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="listar"><b>Tipo: </b><?= $ticket->getCaType() ?></td>
            <td class="listar">
                <b>Estado: 	</b>		
                <?= $ticket->getCaAction() ?> 
            </td>
        </tr>
        <tr>
            <td class="listar" colspan="2"><b>Descripci&oacute;n</b></td>
        </tr>
        <tr>
            <td colspan="2" class="listar">
                <div class="boxText"><?= $ticket->getCaText() ?></div>
            </td>
        </tr>
        <tr>
            <td class="listar" colspan="2"><b>Otros usuarios:</b></td>
        </tr>
        <tr>
            <td colspan="2" class="listar">
                <div class="boxText">
                    <?
                    foreach ($usuarios as $usuario) {
                        echo image_tag("16x16/user_male.gif") . " " . $usuario->getCaNombre() . " ";
                        echo "<br />";
                    }
                    ?>
                </div>
            </td>
        </tr>
    </table><br/>    
    <table class="tableList alignCenter"  id="archivos" width='40%'>
        <?
        if($ticket->getCaAction() != "Cerrado"){
            ?>
            <tr>
                <th colspan="2">
                    Adjuntos
                </th>
                <td>
                    <div id="button" name="button" align="center" ></div>
                </td>
            </tr>
            <?
        }
        foreach ($filenames as $file) {
            $id_tr = "tr_$i";
            ?>
            <tr id="<?= $id_tr ?>" >
                <td colspan="2">
                    <div id="hbl_defs">
                        <b><?= $i++ ?>.</b>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= link_to("Archivo " . basename($folder . "/" . $file["file"]), "gestDocumental/verArchivo?idarchivo=" . base64_encode($folder . "/" . $file["file"])) ?>
                    </div>
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <?
        }
        ?>
    </table><br/>
    <table width="100%"  border="0" class="tableList">
        <tr>
            <th  scope="col"><b> Respuestas</b></th>
        </tr>
        <tr>
            <td width="86%" class="listar">
                <div class="boxText">
                    <div id="coments">
                        <?
                        include_component("pm", "listaRespuestasTicket", array("idticket" => $ticket->getCaIdticket(), "format" => "email"));
                        ?>			  
                    </div>
                    <?
                    if ($ticket->getCaAction() == "Abierto") {
                        ?>
                        <div class="story_coment" id="coment_status_txt" style="display:none" >
                            <textarea rows="1" cols="120" id="coment_status_field" onkeyup="autoGrow(this)" onfocus="autoGrow(this)"></textarea><br />
                            <b><a onclick="guardar_comentario(<?= $ticket->getCaIdticket() ?>)"><?= image_tag("16x16/button_ok.gif") ?> Guardar</b></a> <b><a onclick="cancelar_comentar()"> <?= image_tag("16x16/button_cancel.gif") ?> Cancelar</a></b>
                        </div>				
                        <div class="story_coment" id="coment_status" onclick="comentar()">
                            <b> <?= image_tag("16x16/edit_add.gif") ?> Respuesta</b>
                        </div>	
                        <?
                    }
                    ?> 
                </div>
            </td>
        </tr> 
    </table><br>
</div>
<script>
<? if ($app != "intranet") { ?>
        button = 0;

        var uploadButton = new WidgetUploadButton({
            text: "Agregar Archivo",
            iconCls: 'arrow_up',
            folder: "<?= base64_encode($folder) ?>",
            filePrefix: "",
            confirm: true,
            callback: "actualizar"
        });
        uploadButton.render("button");

        function actualizar(file) {

            $("#archivos").append("<tr><td ><b>" + (button++) + ".</b>&nbsp;&nbsp;&nbsp;&nbsp;<div id='hbl_defs'><a href='<?= url_for("gestDocumental/verArchivo?idarchivo=") ?>" + Base64.encode("<?= $folder ?>/" + file) + "'>Archivo " + file + "</a></div></td><td>&nbsp;</td></tr>");
        }

        button =<?= $i ?>;
<? } else { ?>
        Ext.onReady(function () {

            Ext.create('Ext.form.Panel', {
                title: 'File Uploader',
                width: 400,
                bodyPadding: 10,
                frame: true,
                renderTo: 'button',
                items: [{
                        xtype: 'filefield',
                        name: 'file',
                        fieldLabel: 'File',
                        labelWidth: 50,
                        msgTarget: 'side',
                        allowBlank: false,
                        anchor: '100%',
                        buttonText: 'Select a File...'
                    }],
                buttons: [{
                        text: 'Upload',
                        handler: function () {
                            var form = this.up('form').getForm();
                            if (form.isValid()) {
                                form.submit({
                                    url: '<?= url_for("gestDocumental/subirArchivo") ?>',
                                    waitMsg: 'Uploading your file...',
                                    params: {
                                        folder: "<?= base64_encode($folder) ?>",
                                    },
                                    success: function (fp, o) {
                                        Ext.Msg.alert('Enviado', 'El archivo se ha subido correctamente');
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    }]
            });
        });
<? } ?>
</script>