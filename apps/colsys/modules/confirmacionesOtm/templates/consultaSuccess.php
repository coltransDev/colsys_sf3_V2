<?
use_helper("ExtCalendar");

$inoClientes = $sf_data->getRaw("inoClientes");
$titulo = "Módulo de Avisos de OTM";
$textos = $sf_data->getRaw("textos");
?>
<script language="javascript" type="text/javascript">
    function validarFormConfirmacion(tipomsg) {
    <?
        $oids = array();
        foreach ($inoClientes as $inoCliente) {
            $oids[] = $inoCliente->getOid();
        }
        ?>
        var oids = <?= json_encode($oids); ?>;
        for (i in oids) {
            if (typeof (oids[i]) == "number") {
                var checkbox = document.getElementById("checkbox_" + oids[i]);
                if (checkbox.checked) {
                    var numchecked = 0;
                    var divfijos = document.getElementById("divfijos_" + oids[i]);
                    if (divfijos && typeof (divfijos) != "undefined") {
                        var elements = divfijos.getElementsByTagName("input");
                        for (var j = 0; j < elements.length; j++) {
                            if (elements[j].type == "checkbox" && elements[j].checked) {
                                numchecked++;
                            }
                        }
                    }

                    var consolidar_comunicaciones = document.getElementById("consolidar_comunicaciones_" + oids[i]).value;
                    if (numchecked == 0 && !consolidar_comunicaciones) {
                        alert("Debe seleccionar al menos un contacto fijo para el cliente: " + document.getElementById("nombre_cliente_" + oids[i]).value);
                        document.location.href = "#oid_" + oids[i];
                        return false;
                    }

                    valor = $(".tipostatus:checked").val();
                }
            }
        }
    
        for (i in oids) {
            if (typeof (oids[i]) == "number") {
                var checkbox = document.getElementById("checkbox_" + oids[i]);
                var fchrecibo = document.getElementById("fchrecibido_" + oids[i]);
                var horarecibo = document.getElementById("horarecibido_" + oids[i]);
                var now = new Date();
                var currentDate = formatDate(now);
                var currentHours = formatHours(now);
                if (checkbox.checked) {
                    if (document.getElementById("divmessage_" + oids[i]).innerHTML == "" && document.getElementById("mensaje_" + oids[i]).value == "") {
                        alert("Por favor coloque un mensaje para el status");
                        document.getElementById("mensaje_" + oids[i]).focus();
                        return false;
                    }
                    if (fchrecibo.value == "") {
                        alert("Por favor coloque la FECHA de recibo del Status");
                        fchrecibo.focus();
                        return false;
                    }
                    if (horarecibo.value == "") {
                        alert("Por favor coloque la HORA de recibo del Status");
                        horarecibo.focus();
                        return false;
                    }
                    if (fchrecibo.value > currentDate) {
                        alert("La fecha recibo status es mayor a la fecha actual");
                        fchrecibo.focus();
                        return false;
                    } else if (horarecibo.value > currentHours) {
                        alert("La hora de recibo status es mayor a la hora actual");
                        horarecibo.focus();
                        return false;
                    }
                }
            }
        }
        document.getElementById("form1").submit();
    }

    function modFcharribo() {
        campo = $('#mod_fcharribo');
        objeto = $('#mod_fcharribo_id');
        if (campo) {
            if (campo.attr("checked")) {
                objeto.show();
            } else {
                objeto.hide();
            }
        }
    }

    function habilitar(oid) {
        objeto = document.getElementById('tb_' + oid);
        campo = document.getElementById('checkbox_' + oid);        
        if (campo.checked) {
            $('#tb_' + oid).show();
        } else {            
            $('#tb_' + oid).hide();
        }
    }

    function mostrarFchllegada(oid) {
        eval('var tipo = document.form1.tipo_' + oid);
        var value = '';
        for (i = 0; i < tipo.length; i++) {
            if (tipo[i].checked) {
                value = tipo[i].value;
            }
        }

        var objeto_1 = document.getElementById('divfchllegada_' + oid);
        if (value == "IMCOL") {
            document.getElementById('divmodfchllegada_' + oid).style.display = 'none';
        } else {
            document.getElementById('divmodfchllegada_' + oid).style.display = 'inline';
        }

        if (document.getElementById('modfchllegada_' + oid).checked || value == "IMCOL") {
            objeto_1.style.display = 'inline';
        } else {
            objeto_1.style.display = 'none';
        }
    }
    
    function mostrar(value, oid) {
        
        var objeto_2 = document.getElementById('divbodega_' + oid);
        var objeto_5 = document.getElementById('divfchplanilla_' + oid);
        
        switch (value){
            <?
            foreach ($etapas as $etapa) {
                ?>
                case '<?= $etapa->getCaIdetapa() ?>':                    
                    $("#divmessage_"+oid).html('<?= $etapa->getCaMessage() ?>');
                    break;
                <?
            }
            ?>
            default:
                $("#divmessage_"+oid).html("");;
                break;
        }

        switch (value){
            <?
            foreach ($etapas as $etapa) {
                ?>
                case '<?= $etapa->getCaIdetapa() ?>':
                    var val = '<?= str_replace("\n", "<br />", $etapa->getCaMessageDefault()) ?>';                    
                    var texto = val.split("<br />").join("\n");
                    $("#mensaje_"+oid).html(texto);                    
                    break;
                <?
            }
            ?>
            case '99999':
                $("#mensaje_"+oid).html('<?= str_replace("\n", "<br>", $textos['mensajeCierreOTM']) ?>');
                break;
            default:
                $("#mensaje_"+oid).html("");
                break;
        }

        mostrarFchllegada(oid);
        
        if (value == "IMCOL") {
            objeto_2.style.display = 'inline';
        } else {
            objeto_2.style.display = 'none';
        }
        if (value == "99999") {
            objeto_5.style.display = 'inline';
        } else {
            objeto_5.style.display = 'none';
        }
    }

    function cambiarTextosOTM(value) {
        <?
        foreach ($inoClientes as $inoCliente) {
            ?>
            if (value == "Fact") {
                if ($("#mensaje_<?= $inoCliente->getOid() ?>"))
                    document.getElementById('mensaje_<?= $inoCliente->getOid() ?>').value = "";
            } else {
                if ($("#mensaje_<?= $inoCliente->getOid() ?>"))
                    document.getElementById('mensaje_<?= $inoCliente->getOid() ?>').value = document.getElementById('mensajeOTM_<?= $inoCliente->getOid() ?>').value;
            }
            <?
        }
        ?>
    }

    function formatDate(date) {

        var fullDate = date;
        var twoDigitMonth = fullDate.getMonth() + 1 + '';
        if (twoDigitMonth.length == 1)
            twoDigitMonth = '0' + twoDigitMonth;
        var twoDigitDate = fullDate.getDate() + '';
        if (twoDigitDate.length == 1)
            twoDigitDate = '0' + twoDigitDate;
        var currentDate = fullDate.getFullYear() + '-' + twoDigitMonth + '-' + twoDigitDate;
        return currentDate;
    }

    function formatHours(date) {

        var fullDate = date;
        var twoDigitHours = fullDate.getHours();
        if (twoDigitHours.length == 1)
            twoDigitHours = "0" + twoDigitHours;
        var twoDigitMinutes = fullDate.getMinutes();
        if (twoDigitMinutes.length == 1)
            twoDigitMinutes = "0" + twoDigitMinutes;
        var currentHour = twoDigitHours + ":" + twoDigitMinutes;
        return currentHour;
    }
</script>

<div align="center">
    <form action='<?= url_for("confirmacionesOtm/crearStatus") ?>' method="post" enctype='multipart/form-data' name='form1' id="form1" onsubmit='return false;'>
        <input type="hidden" name="referencia" value="<?= $referencia->getCaReferencia() ?>" />
        <input type="hidden" name="idmaster" value="<?= $referencia->getCaIdmaster() ?>" />
        <table cellspacing="1" class="tableList" width="90%" >
            <tr>
                <th class="partir" colspan="5">
            <div align="center" style="font-size: 11px; text-align: center; font-weight:bold;">COLTRANS S.A.<br /><?= $titulo ?></div></th>
            </tr>
            <tr>

                <th width="20%" rowspan="2" style="text-align: left; vertical-align:top;" >Referencia</th>
                <td width="40%" style="font-size: 11px; font-weight:bold;" colspan="2"><?= $referencia->getCaReferencia() ?></td>
                <th width="20%" class="partir">Fecha de Registro :</th>
                <td width="20%" class="" style='font-size: 11px; text-align: center;'><span class="listar" style="font-size: 11px; font-weight:bold;"><?= $referencia->getCaFchreferencia() ?></span></td>
            </tr>
            <tr>

                
                <th class="partir" style="font-size: 11px; text-align: center;" colspan="2">Ciudad de Origen</th>
                <th class="partir" style="font-size: 11px; text-align: center;" colspan="2">Ciudad de Destino</th>
            </tr>
            <tr>

                <th class="" style="text-align: left; vertical-align:top;">OTM-DTA<br />&nbsp;<br />&nbsp;</th>
                <td width="" class="listar" style="font-size: 11px; text-align: center; font-weight:bold;"><?= $origen->getCaCiudad() ?></td>
                <td width="" class="listar" style="font-size: 11px; text-align: center; font-weight:bold;"><?= $origen->getTrafico() ?></td>
                <td class="listar" style="font-size: 11px; text-align: center; font-weight:bold;"><?= $destino->getCaCiudad() ?></td>
                <td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?= $destino->getTrafico() ?></td>
            </tr>           
            <tr>

                <th class="partir">Transportador</th>
                <td class="listar" colspan="2"><?= $linea->getIds()->getCaNombre() . " " . $linea->getCaSigla() ?></td>
                <td class="listar" colspan="2">&nbsp;</td>
            </tr>
            <tr>

                <th class="partir" rowspan="1" style="vertical-align:top;">Modalidad: <?= $referencia->getCaModalidad() != "DIRECTO" ? $referencia->getCaModalidad() : "FCL" ?></th>
                <td class="listar"><b>Motonave:</b><br /><?= $referencia->getCaMotonave() ?></td>                
                <th class="partir" ><b>Observaciones:</b></th>
                <td class="listar" colspan="2"><?= Utils::replace($referencia->getCaObservaciones()) ?></td>                
            </tr>
            <?
            $inoEquipos = $referencia->getInoEquipo();
            if (count($inoEquipos) > 0) {
                ?>
                <tr>
                    <td colspan="4" class="listar">

                            <table cellspacing="0" style='letter-spacing:-1px;' width="100%">
                                <tr>
                                    <th>Concepto</th>
                                    <th>Cantidad</th>
                                    <th>Id Equipo</th>
                                    <th colspan="3">Entrega de Comodato</th>                                
                                </tr>
                                <?
                                
                                $intro_body_desc = "\n\n";
                                foreach ($inoEquipos as $inoEquipo) {
                                    $intro_body_desc.= "Equipo : " . $inoEquipo->getConcepto()->getCaConcepto() . "\n";
                                    $intro_body_desc.= "Id Equipo : " . $inoEquipo->getCaIdequipo() . "\n";
                                    ?>
                                    <tr>
                                        <td  class="listar"><?= $inoEquipo->getConcepto()->getCaConcepto() ?></td>
                                        <td  class="listar"><?= $inoEquipo->getCaCantidad() ?></td>
                                        <td  class="listar"><?= $inoEquipo->getCaIdequipo() ?></td>
                                    </tr>
                                    <?
                                }
                                ?>
                            </table>
                    </td>
                </tr>
                <?
            }
            ?>
            <tr>
                <th class="partir">Tránsito&nbsp;</th>
                <th class="listar" style='font-weight:bold;'>Fecha Estimada de Salida:</th>
                <td style="font-size: 11px; text-align: center; font-weight:bold;"><?= $referencia->getCaFchsalida() ?></td>
                <th class="listar" style='font-weight:bold;'>Fecha Estimada de Arribo:</th>
                <td style="font-size: 11px; text-align: center; font-weight:bold;"><?= $referencia->getCaFchllegada() ?></td>
            </tr>
            <tr>
                <th class="partir">Adjuntar archivo para toda la referencia:</th>
                <td class="mostrar" colspan="4"><input type='file' id='attachment' name='attachment' size="120" /></td>
            </tr>
            <tr>
                <td class="" colspan="5">&nbsp;</td>
            </tr>
            <?
            if (isset($confirmaciones) && $confirmaciones) {
                ?>
                <tr>
                    <td class="listar" colspan="5">
                        <b>Otras Comunicaciones</b>
                        <table width="100%" border="0" class="tableList">
                            <tr>
                                <th width="18%" >Fecha</th>							
                                <th width="60%" >Asunto</th>
                                <th width="22%" >Ver email</th>
                            </tr>
                            <?
                            foreach ($confirmaciones as $confirmacion) {
                                ?>
                                <tr>
                                    <td><?= Utils::fechaMes($confirmacion->getCaFchenvio()) ?></td>
                                    <td><?= $confirmacion->getCaSubject() ?></td>
                                    <td>
                                        <?
                                        if ($confirmacion->getCaIdemail()) {
                                            echo "<a href='#' onClick=window.open('" . url_for("email/verEmail?id=" . $confirmacion->getCaIdemail()) . "')>" . image_tag("22x22/email.gif") . "</a>";
                                        } else {
                                            echo "&nbsp;";
                                        }
                                        ?>
                                    </td>							
                                </tr>
                                <?
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <?
            }
            if ($modo != "puerto")
                include_component("confirmacionesOtm", "notClientes", array("numRef" => $referencia->getCaReferencia(), "inoClientes" => $inoClientes, "modo" => $modo, "etapas" => $etapas, "coordinadores" => $coordinadores, "textos" => $textos, $bodegas = "bodegas"));
            ?>
            <tr height="5">
                <td class="invertir" colspan="5">&nbsp;</td>
            </tr>            
        </table><br />
        <table cellspacing="10">
            <tr>
                <th><input class="submit" type='button' name='accion' value='Enviar Correo' onClick="javascript:validarFormConfirmacion(this.planillachecked)" /></th>
                <th><input class="button" type='button' name='boton' value=' Regresar ' onclick="javascript:document.location.href = '<?= url_for("confirmacionesOtm/index") ?>'" /></th>
            </tr>
        </table>        
    </form>
    <table width="850" border="0" class="tableList" id="upload_tbl">
        <?
        include_component("confirmacionesOtm", "uploadClientes", array("inoClientes" => $inoClientes, "modo" => "otm"));
        ?>
    </table><br />
</div>

<script language="javascript" type="text/javascript">
<?
foreach ($inoClientes as $inoCliente) {
    ?>
        mostrar('<?= $inoCliente->getOid() ?>');
        habilitar('<?= $inoCliente->getOid() ?>');
    <?
}
?>
    modFcharribo();
</script>