<?
use_helper("ExtCalendar");

include_component("widgets", "widgetMuelles", array("ciudad" => $referencia->getCaDestino()));

$inoClientes = $sf_data->getRaw("inoClientes");
$confirmaciones = $sf_data->getRaw("confirmaciones");
$tickets = $sf_data->getRaw("tickets");

switch ($modo) {
    case "otm":
        $titulo = "Módulo de Avisos de OTM";
        break;
    case "puerto":
        $titulo = "Módulo de Notificaciones para Puerto";
        break;
    default:
        $titulo = "Módulo de Status y Confirmaciones de Llegada";
        $modo = "conf";
        break;
}
$textos = $sf_data->getRaw("textos");
?>
<script language="javascript" type="text/javascript">
    var modo = '<?= $modo ?>';    
    function validarFormConfirmacion(tipomsg){
        var now = new Date();
        var currentDate = formatDate(now);
        var currentHours = formatHours(now);
<?
        if ($modo != "puerto") {
            $oids = array();
            foreach ($inoClientes as $inoCliente) {
                $oids[] = $inoCliente->getOid();
            }
?>        
            var oids = <?= json_encode($oids); ?>;            
            for (i in oids){
                if (typeof (oids[i]) == "number"){
                    var checkbox = document.getElementById("checkbox_" + oids[i]);
                    if (checkbox.checked){
                        var numchecked = 0;
                        var divfijos = document.getElementById("divfijos_" + oids[i]);
                        if (divfijos && typeof (divfijos) != "undefined"){
                            var elements = divfijos.getElementsByTagName("input");
                            for (var j = 0; j < elements.length; j++){
                                if (elements[j].type == "checkbox" && elements[j].checked){
                                    numchecked++;
                                }
                            }
                        }

                        var consolidar_comunicaciones = document.getElementById("consolidar_comunicaciones_" + oids[i]).value;
                        if (numchecked == 0 && !consolidar_comunicaciones){
                            alert("Debe seleccionar al menos un contacto fijo para el cliente: " + document.getElementById("nombre_cliente_" + oids[i]).value);
                            document.location.href = "#oid_" + oids[i];
                            return false;
                        }

                        valor = $(".tipostatus:checked").val();
                        if (valor == "not_planilla"){
                            var divplanilla = document.getElementById("divplanilla_" + oids[i]);
                            if (!divplanilla){
                                alert("El cliente " + document.getElementById("nombre_cliente_" + oids[i]).value + " no tiene planilla reportada");
                                document.location.href = "#oid_" + oids[i];
                                return false;
                            }
                        }

                        if (valor == "Fact"){
                            var td_adjunto = document.getElementById("attachment_" + oids[i]);
                            obj = $("input:checkbox[name='files_" + oids[i] + "[]']:checked");
                            if (obj.length == 0){
                                if (td_adjunto.value == ""){
                                    alert("Debe adjuntar la factura para el cliente " + document.getElementById("nombre_cliente_" + oids[i]).value);
                                    document.location.href = "#oid_" + oids[i];
                                    return false;
                                }
                            }
                        }
                        
                        if(valor!="Conf" && valor!="Fact")
                        {
                            var fchrecibo = document.getElementById("fchrecibido_" + oids[i]);
                            var horarecibo = document.getElementById("horarecibido_" + oids[i]);
                            if (fchrecibo.value == ""){
                                alert("Por favor coloque la FECHA de recibo del Status");
                                fchrecibo.focus();
                                return false;
                            }
                            if (horarecibo.value == ""){
                                alert("Por favor coloque la HORA de recibo del Status");
                                horarecibo.focus();
                                return false;
                            }
                            if (fchrecibo.value > currentDate){
                                alert("La fecha recibo status es mayor a la fecha actual");
                                fchrecibo.focus();
                                return false;
                            } /*else if (horarecibo.value > currentHours){
                                alert("La hora de recibo status es mayor a la hora actual");
                                horarecibo.focus();
                                return false;
                            }*/
                        }
                        
                    }
                }
            }            
<?
        }
        if ($modo == "otm") {
?>
            for (i in oids){
                if (typeof (oids[i]) == "number"){
                    var checkbox = document.getElementById("checkbox_" + oids[i]);
                    var fchrecibo = document.getElementById("fchrecibido_" + oids[i]);
                    var horarecibo = document.getElementById("horarecibido_" + oids[i]);
                    
                    if (checkbox.checked){
                        if (document.getElementById("divmessage_" + oids[i]).innerHTML == "" && document.getElementById("mensaje_" + oids[i]).value == ""){
                            alert("Por favor coloque un mensaje para el status");
                            document.getElementById("mensaje_" + oids[i]).focus();
                            return false;
                        }
                        if (fchrecibo.value == ""){
                            alert("Por favor coloque la FECHA de recibo del Status");
                            fchrecibo.focus();
                            return false;
                        }
                        if (horarecibo.value == ""){
                            alert("Por favor coloque la HORA de recibo del Status");
                            horarecibo.focus();
                            return false;
                        }
                        if (fchrecibo.value > currentDate){
                            alert("La fecha recibo status es mayor a la fecha actual");
                            fchrecibo.focus();
                            return false;
                        } else if (horarecibo.value > currentHours){
                            alert("La hora de recibo status es mayor a la hora actual");
                            horarecibo.focus();
                            return false;
                        }
                    }
                }
            }
<?
        } else {
?>
            if (document.getElementById('confirmacion_tbl').style.display != 'none'){
                
                if (document.form1.fchconfirmacion.value == ''){
                    alert('Debe Especificar la Fecha de llegada de la Carga');
                    return false;
                }
                else if (document.form1.horaconfirmacion.value == ''){
                    alert('Debe Especificar la Hora exacta de llegada de la Carga');
                    return false;
                }
                else if (document.form1.registroadu.value == ''){
                    alert('Debe ingresar el Registro Aduanero');
                    return false;
                }
                else if (document.form1.registrocap.value == ''){
                    alert('Ingrese el Número de Registro de Capitania');
                    return false;
                }
                else if (document.form1.bandera.value == ''){
                    alert('Ingrese la Bandera del Buque');
                    return false;
                }
                else if (document.form1.mnllegada.value == ''){
                    alert('Ingrese el nombre de la Motonoave de Llegada');
                    return false;
                }
                //alert(177);
                this.validarIdg();      // Valida si se cumple el indicado de Oportunida en el envio de Confirmaciones
                return false;
            } else{
<?
                if ($modo != "puerto") {
?>
                    if ($("#tipo_msg").val() != "Conf"){
                        if (document.form1.status_body.value == ''){
                            alert('Debe incluir un mensaje de status!');
                            return false;
                        }
                    }
<?
                } else if ($modo == "puerto") {
?>
                    valor = $(".tipostatus:checked").val();
                    if (valor == "1207"){
                        var td_adjunto = document.getElementById("attachment");
                        //alert(td_adjunto.toSource());
                        if (td_adjunto.value == ""){
                            alert("Debe adjuntar el Formulario 1207");
                            document.location.href = "#attachment";
                            return false;
                        }
                    }
<?
                }
?>
            }
<?
        }        
?>
        
        document.getElementById("form1").submit();
    }

    function validarIdg(){
        if (document.getElementById('confirmacion_tbl').style.display != 'none'){
            if (modo != "puerto") {
                var theDate=$("#fchconfirmacion").val();
                var theTime=$("#horaconfirmacion").val();
                var theJust=$("#observaciones_idg").val();

                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: '/confirmaciones/idgConfirmacion',
                    params :	{
                        fecha: theDate,
                        hora: theTime,
                        justifica: theJust
                    },
                    failure:function(response,options){
                        alert( response.responseText );
                        Ext.Msg.hide();
                        alert("Surgio un problema al tratar de calcular el tiempo de oportunidad.")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                                               
                        //element = ("#observaciones_idg")// document.getElementById('observaciones_idg');
                        if( res.cumplio=="No" ){
                            $("#observaciones_idg").focus();
                            //element = document.getElementById('justify_tbl');
                            //element.style.display = "inline";
                            $("#justify_tbl").show();
                            alert("De acuerdo al IDG está fuera del tiempo de oportunidad, favor dilgenciar la casilla de justificación que se ha habilitado.");
                        }else{ 
                            if( res.cumplio=="Si" ){
                                //element = document.getElementById('observaciones_idg');
                                $("#observaciones_idg").val('');
                                //element = document.getElementById('justify_tbl');
                                $("#justify_tbl").hide();
                                //element.style.display = "none";
                            }
                            $("#form1").submit();
                        }
                    }
                });
            }else{
                $("#form1").submit();
            }
	}
    }
    
    function modFcharribo(){
        campo = $('#mod_fcharribo');
        objeto = $('#mod_fcharribo_id');
        if (campo){
            if (campo.attr("checked")) {
                objeto.show();
            }
            else {
                objeto.hide();
            }
        }
    }

    function habilitar(oid) {
        objeto = document.getElementById('tb_' + oid);
        campo = document.getElementById('checkbox_' + oid);
        //alert($("#tipo_msg").val());
        //$('#tb_' + oid).toggle();
        if (campo.checked) {
            
            $('#tb_' + oid).show();
            
            switch($(".tipostatus:checked").val() )
            {
                case "Conf":
                case "Fact":
                    $('#divfchrecibo_' + oid).hide();
                    $('#divhorarecibo_' + oid).hide();
                break;
                default :
                    $('#divfchrecibo_' + oid).show();
                    $('#divhorarecibo_' + oid).show();
            }
            
            
            
            
            if($(".tipostatus:checked").val()=="Desc")
            {
                $('#fchrecibido_'+ oid).val($('#desconsolidacionF').val());
                $('#horarecibido_'+ oid).val($('#desconsolidacionH').val());
            }
            else if($(".tipostatus:checked").val()=="not_planilla")
            {
                $('#fchrecibido_'+ oid).val($('#planillaF').val());
                $('#horarecibido_'+ oid).val($('#planillaH').val());
            }
        } else {
            //objeto.style.display = "none";
            $('#tb_' + oid).hide();
            $('#fchrecibido_'+ oid).val('');
            $('#horarecibido_'+ oid).val('');
        }
    }

    function mostrarFchllegada(oid){
        eval('var tipo = document.form1.tipo_' + oid);
        var value = '';
        for (i = 0; i < tipo.length; i++){
            if (tipo[i].checked){
                value = tipo[i].value;
            }
        }

        var objeto_1 = document.getElementById('divfchllegada_' + oid);
        if (value == "IMCOL"){
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

    function mostrar(oid){

        eval('var tipo = document.form1.tipo_' + oid);
        var value = '';
        for (i = 0; i < tipo.length; i++){
            if (tipo[i].checked){
                value = tipo[i].value;
            }
        }

        var objeto_1 = document.getElementById('divfchllegada_' + oid);
        var objeto_2 = document.getElementById('divbodega_' + oid);
        var objeto_3 = document.getElementById('divmessage_' + oid);
        var objeto_4 = document.getElementById('mensaje_' + oid);
        var objeto_5 = document.getElementById('divfchplanilla_' + oid);
        switch (value){
<?
        foreach ($etapas as $etapa) {
?>
            case '<?= $etapa->getCaIdetapa() ?>':
                objeto_3.innerHTML = '<?= $etapa->getCaMessage() ?>';
                break;
<?
        }
?>
            default:
                objeto_3.innerHTML = '';
                break;
        }

        switch (value){
<?
        foreach ($etapas as $etapa) {
?>
            case '<?= $etapa->getCaIdetapa() ?>':
                var val = '<?= str_replace("\n", "<br />", $etapa->getCaMessageDefault()) ?>';
                objeto_4.value = val.split("<br />").join("\n");
                //objeto_4.value='<?= str_replace("\n", "<br>", html_entity_decode($etapa->getCaMessageDefault())) ?>';
                break;
<?
        }
        if ($modo == "otm") {
?>
            case '99999':
                objeto_4.value = '<?= str_replace("\n", "<br>", $textos['mensajeCierreOTM']) ?>';
                break;
<?
        }
?>
            default:
                objeto_4.value = "";
                break;
        }

        mostrarFchllegada(oid);
        
        if (value == "IMCOL") {
            objeto_2.style.display = 'inline';
        } else {
            objeto_2.style.display = 'none';
        }
<?
        if ($modo == "otm") {
?>
            if (value == "99999") {
                objeto_5.style.display = 'inline';
            } else {
                objeto_5.style.display = 'none';
            }
<?
        }
?>
    }

    function cambiarTextosOTM(value){
        if (value == "Fact"){
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajeFacFletes']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        } else if (value == "Desc"){
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajeDesc']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        } else if (value == "not_planilla"){
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajePlanilla']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        } else {
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajeStatus']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        }

<?
        foreach ($inoClientes as $inoCliente) {
?>
            if (value == "Fact"){
                if ($("#mensaje_<?= $inoCliente->getOid() ?>"))
                    //Ext.getCmp('mensaje_+ oid' ).setValue("");
                    document.getElementById('mensaje_<?= $inoCliente->getOid() ?>').value = "";
            } else {
                if ($("#mensaje_<?= $inoCliente->getOid() ?>"))
                    //Ext.getCmp('mensaje_+ oid' ).setValue(document.getElementById('mensajeOTM_<?= $inoCliente->getOid() ?>').value);
                    document.getElementById('mensaje_<?= $inoCliente->getOid() ?>').value = document.getElementById('mensajeOTM_<?= $inoCliente->getOid() ?>').value;
            }
<?
        }
?>
    }
    
    function cambiarTextosFact(value){
        if (value == "fletes"){
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajeFacFletes']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        } else if (value == "otm"){
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajeFacOtm']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        } else if (value == "cont"){
            var msg = "<?= str_replace("\n", "<br />", $textos['mensajeFacCont']) ?>";
            $("#status_body").val(msg.split("<br />").join("\n"));
        }
    }

    function cambiarTipoMsg(value){

        if (value == "Conf" || value == "Puerto"){
            $("#status_tbl").hide();
            $("#status_cnt").hide();
            $("#planilla_tbl").hide();
            $("#status_fct").hide();
            $("#confirmacion_tbl").show();
            $("#upload_tbl").show();
            $("#planilla_form").hide();
        } else if (value == "Cont"){
            $("#status_cnt").show();
            $("#status_tbl").hide();
            $("#planilla_tbl").hide();
            $("#status_fct").hide();
            $("#confirmacion_tbl").hide();
            $("#upload_tbl").show();
            $("#planilla_form").hide();
        } else if (value == "Planilla"){
            $("#status_cnt").hide();
            $("#status_tbl").hide();
            $("#planilla_tbl").show();
            $("#status_fct").hide();
            $("#confirmacion_tbl").hide();
            $("#upload_tbl").hide();
            $("#planilla_form").show();            
        } else if (value == "1207"){
            $("#status_tbl").hide ();
            $("#1207_tbl").show();
            $("#status_cnt").hide();
            $("#planilla_tbl").hide();
            $("#status_fct").hide();
            $("#confirmacion_tbl").hide();
            $("#upload_tbl").hide();
            $("#planilla_form").hide();
        } else if (value == "Fact"){
            $("#status_fct").show ();
            $("#status_tbl").show ();
            $("#1207_tbl").hide();
            $("#status_cnt").hide();
            $("#planilla_tbl").hide();
            $("#confirmacion_tbl").hide();
            $("#upload_tbl").hide();
            $("#planilla_form").hide();
        } else if (value == "Desc"){
            $("#status_fct").hide();
            $("#status_tbl").show();
            $("#1207_tbl").hide();
            $("#status_cnt").hide();
            $("#planilla_tbl").hide();
            $("#confirmacion_tbl").hide();
            $("#upload_tbl").show();
            $("#planilla_form").hide();
        } else {
            $("#status_tbl").show();
            $("#status_cnt").hide();
            $("#planilla_tbl").hide();
            $("#status_fct").hide();
            $("#confirmacion_tbl").hide();
            $("#upload_tbl").hide();
            $("#planilla_form").hide();
        }
        if (modo != "puerto")
            cambiarTextosOTM(value);
    }

    function formatDate(date){

        var fullDate = date;
        var twoDigitMonth = fullDate.getMonth() + 1 + ''; if (twoDigitMonth.length == 1)  twoDigitMonth = '0' + twoDigitMonth;
        var twoDigitDate = fullDate.getDate() + ''; if (twoDigitDate.length == 1) twoDigitDate = '0' + twoDigitDate;
        var currentDate = fullDate.getFullYear() + '-' + twoDigitMonth + '-' + twoDigitDate;
        return currentDate;
    }
    
    function formatHours(date){

        var fullDate = date;
        var twoDigitHours = fullDate.getHours(); if (twoDigitHours.length == 1) twoDigitHours = "0" + twoDigitHours;
        var twoDigitMinutes = fullDate.getMinutes(); if (twoDigitMinutes.length == 1) twoDigitMinutes = "0" + twoDigitMinutes;
        var currentHour = twoDigitHours + ":" + twoDigitMinutes;
        return currentHour;
    }
</script>

<div align="center">
    <form action='<?= url_for("confirmaciones/crearStatus?modo=" . $modo) ?>' method="post" enctype='multipart/form-data' name='form1' id="form1" onsubmit='return false;'>
        <input type="hidden" name="referencia" value="<?= $referencia->getCaReferencia() ?>" />
        <table cellspacing="1" class="tableList" width="90%" >
            <tr>
                <td class="partir" colspan="6">
                    <div align="center">COLTRANS S.A.<br /><?=$titulo?></div></td>
            </tr>
            <tr>
                <td width="6%" class="partir">&nbsp;</td>
                <td width="13%" class="partir">Referencia:</td>
                <td class="listar" style='font-size: 11px; font-weight:bold;' colspan="2"><?= $referencia->getCaReferencia() ?></td>
                <td width="33%" class="partir">Fecha de Registro :</td>
                <td width="24%" class="listar" style='font-size: 11px; text-align: center;'><span class="listar" style="font-size: 11px; font-weight:bold;"><?=$referencia->getCaFchreferencia() ?></span></td>
            </tr>
            <tr>
                <td class="partir">&nbsp;</td>
                <td class="partir">&nbsp;</td>
                <td class="partir" style='font-size: 11px; text-align: center;' colspan="2">Ciudad de Origen</td>
                <td class="partir" style='font-size: 11px; text-align: center;' colspan="2">Ciudad de Destino</td>
            </tr>
            <tr>
                <td class="partir" style='text-align: center; vertical-align:top;'>&nbsp;</td>
                <td class="partir" style='text-align: center; vertical-align:top;'>Importación<br />&nbsp;<br />&nbsp;</td>
                <td width="14%" class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?= $origen->getCaCiudad() ?></td>
                <td width="7%" class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?= $origen->getTrafico() ?></td>
                <td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?= $destino->getCaCiudad() ?></td>
                <td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?= $destino->getTrafico() ?></td>
            </tr>           
            <tr>
                <td class="partir">&nbsp;</td>
                <td class="partir">Transportista:</td>
                <td class="listar" colspan="2"><?= $linea->getIds()->getCaNombre() . " " . $linea->getCaSigla() ?></td>
                <td class="listar" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="partir" rowspan="2">&nbsp;</td>
                <td class="partir" rowspan="2">Modalidad:<br /><center><?= $referencia->getCaModalidad() ?></center></td>
                <td class="listar"><b>Motonave:</b><br /><?= $referencia->getCaMotonave() ?></td>
                <td class="listar"><b>MBL's:</b><br /><?= $referencia->getCaMbls() . "|" . $referencia->getCaFchmbls() ?></td>
                <td class="listar" colspan="2"><b>Observaciones:</b><br /><?= Utils::replace($referencia->getCaObservaciones()) ?></td>
            </tr>            
            <tr>
                <td colspan="4" class="listar">
<?
                    $inoEquipos = $referencia->getInoEquiposSea();
                    if (count($inoEquipos) > 0) {
?>
                        <table cellspacing="0" style='letter-spacing:-1px;' width="100%">
                            <tr>
                                <th>Concepto</th>
                                <th>Cantidad</th>
                                <th>Id Equipo</th>
                                <th colspan="3">Entrega de Comodato</th>
                            </tr>
<?
                            $agente_aduana = "";

                            $infoAduanas = $referencia->getInoClientesSea();
                            foreach ($infoAduanas as $infoAduana) {
                                $agAduana = $infoAduana->getAduana();
                                $agente_aduana = $agAduana->getCaNombre();
                            }

                            $intro_body_desc = "\n\n";
                            foreach ($inoEquipos as $inoEquipo) {
                                $inoContrato = $inoEquipo->getInoContratosSea();
                                $intro_body_desc.= "Equipo : " . $inoEquipo->getConcepto()->getCaConcepto() . "\n";
                                $intro_body_desc.= "Id Equipo : " . $inoEquipo->getCaIdequipo() . "\n";
                                $intro_body_desc.= "Entrega Comodato : " . ($inoContrato ? $inoContrato->getCaEntregaComodato() : "") . "\n";
                                $intro_body_desc.= "Patio de Entrega : " . ($inoContrato ? $inoContrato->getPricPatio()->getCaNombre() : "") . "\n";
                                $intro_body_desc.= "Agente Aduana : " . $agente_aduana . "\n";
                                $intro_body_desc.= "Observaciones : " . ($inoContrato ? $inoContrato->getCaObservaciones() : "") . "\n\n\n";
?>
                                <tr>
                                    <td  class="listar"><?= $inoEquipo->getConcepto()->getCaConcepto() ?></td>
                                    <td  class="listar"><?= $inoEquipo->getCaCantidad() ?></td>
                                    <td  class="listar"><?= $inoEquipo->getCaIdequipo() ?></td>
                                    <td  class="listar"><?= $inoContrato ? $inoContrato->getCaEntregaComodato() : "&nbsp;" ?></td>
                                    <td  class="listar"><?= $inoContrato ? $inoContrato->getPricPatio()->getCaNombre() : "&nbsp;" ?></td>
                                    <td  class="listar"><?= $inoContrato ? $inoContrato->getCaObservaciones() : "&nbsp;" ?></td>
                                </tr>
<?
                            }
?>
                        </table>
<?
                    } else {
                        echo "&nbsp;";
                    }
?>
                </td>
            </tr>
            <tr>
                <td class="partir">&nbsp;</td>
                <td class="partir">Tránsito:&nbsp;</td>
                <td class="listar" style='font-weight:bold;'>Fecha Estim.Embarque:</td>
                <td class="listar"><?= $referencia->getCaFchembarque() ?></td>
                <td class="listar" style='font-weight:bold;'>Fecha Estim.Arribo:</td>
                <td class="listar"><?= $referencia->getCaFcharribo() ?></td>
            </tr>
            <tr height="5">
                <td class="invertir" colspan="6">&nbsp;</td>
            </tr>
<?
            if ($modo == "otm") {
?>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir">Status OTM:&nbsp;</td>
                    <td class="mostrar" colspan="4"><b>Introducción al Mensaje:</b>
                        <input type="checkbox" value="1" name="intro_otm" id="intro_otm" /><br />
                        <textarea name='intro_body_otm' wrap="virtual" rows="3" cols="93"><?= $textos['mensajeConfOTM'] ?></textarea>
                    </td>
                </tr>
<?
            } else if ($modo == "puerto") {
?>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Puerto" checked="checked" onclick="cambiarTipoMsg(this.value)" type="radio">Llegada:</td>
                    <td class="mostrar" colspan="4" rowspan="2">
                        <table id="confirmacion_tbl" style="display: block;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar">Fecha Confirmación:<br><?echo extDatePicker('fchconfirmacion', $referencia->getCaFchconfirmacion("Y-m-d"));?></td>
                                    <td class="mostrar">Hora en Formato 24h:<br><?echo extTimePicker("horaconfirmacion", $referencia->getCaHoraconfirmacion()); ?></td>
                                    <td class="mostrar">Registro Aduanero:<br><input name="registroadu" value="<?= $referencia->getCaRegistroadu() ?>" size="22" maxlength="20" type="text"></td>
                                    <td class="mostrar">Fecha Registro:<br><?echo extDatePicker('fchregistroadu', $referencia->getCaFchregistroadu("Y-m-d"));?></td>
                                </tr>
                                <tr>
                                    <td class="mostrar">Reg. Capitania:<br><input name="registrocap" value="<?= $referencia->getCaRegistrocap() ?>" size="20" maxlength="20" type="text"></td>
                                    <td class="mostrar">Bandera:<br><input name="bandera" value="<?= $referencia->getCaBandera() ?>" size="20" maxlength="20" type="text"></td>								
                                    <td class="mostrar">Motonave Llegada:<br><input name="mnllegada" value="<?= $referencia->getCaMnllegada() ?>" size="20" maxlength="50" type="text"></td>
                                    <td class="mostrar">Muelle:<br>                                    
                                        <input type='text' id='muelle' name='muelle' />
                                        <script>
                                            var mu = new WidgetMuelles({
                                                        id: 'muelle',
                                                        name: 'muelle',
                                                        hiddenName: "idmuelle",
                                                        value:"<?= $referencia->getInoDianDepositos()->getCaNombre() ?>",
                                                        hiddenValue:"<?= $referencia->getCaMuelle() ?>",
                                                        applyTo: "muelle"
                                                    })
                                        </script>                                    
                                    </td>                                
                                </tr>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducción al Mensaje de Confirmación:</b><br>
                                        <textarea name="intro_body" wrap="virtual" rows="3" cols="93">Se Notifica que la carga arribo con la siguiente informacion.</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="status_tbl" style="display: none;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducción al Mensaje de Confirmación:</b><br>
                                        <textarea name="intro_body_desc" wrap="virtual" rows="3" cols="93">Se desconsolido la carga con la siguiente informacion:</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Fecha de arribo</b><br>
                                        Modificar Fch. Arribo: <input type="checkbox" name="mod_fcharribo" id="mod_fcharribo" onClick="modFcharribo()" />
                                        <div id="mod_fcharribo_id"><?echo extDatePicker('fcharribo', $referencia->getCaFcharribo());?></div>
                                    </td>
                                </tr>                            
                                <tr>                                
                                    <td class="mostrar" width="25%">Fecha Vaciado:<br><?echo extDatePicker('ca_fchvaciado', $referencia->getCaFchvaciado("Y-m-d"));?></td>
                                    <td class="mostrar" width="25%">Hora Vaciado:<br><?echo extTimePicker("ca_horavaciado", $referencia->getCaHoravaciado("Y-m-d"));?></td>
                                    <td class="mostrar" width="25%">Fecha finalizaci&oacute;n MUISCA:<br><?echo extDatePicker('fchsyga', $referencia->getCaFchfinmuisca("Y-m-d"));?></td>                                    
                                </tr>
                            </tbody>
                        </table>
                        <table id="planilla_tbl" style="display: none;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducción al Mensaje Planilla de Envio DIAN:</b><br>
                                        <textarea name="intro_body_planilla" wrap="virtual" rows="3" cols="93">Notificaci&oacute;n de los números de planilla de envio asignados por la DIAN</textarea><br />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="1207_tbl" style="display: none;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducción al Mensaje Formulario de la DIAN 1207:</b><br>
                                        <textarea name="intro_body_1207" wrap="virtual" rows="3" cols="93">Notificaci&oacute;n del formulario de la DIAN 1207</textarea><br />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Desc" onclick="cambiarTipoMsg(this.value)" type="radio">Desconsolidaci&oacute;n:</td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Planilla" onclick="cambiarTipoMsg(this.value)" type="radio">Planilla de Envío:</td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="1207" onclick="cambiarTipoMsg(this.value)" type="radio">Formulario DIAN 1207:</td>
                </tr>
<?
            } else {
?>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir">
                        <input name="tipo_msg" class="tipostatus" id="tipo_msg" value="<?= ($modo == "puerto") ? "Puerto" : "Conf" ?>" checked="checked" onclick="cambiarTipoMsg(this.value)" type="radio">
                        <?= ($modo == "puerto") ? "Llegada" : "Confirmaci&oacute;n" ?>:
                    </td>
                    <td class="mostrar" colspan="4" rowspan="6">
                        <table id="confirmacion_tbl" style="display: block;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar">Fecha Confirmación:<br><?echo extDatePicker('fchconfirmacion', $referencia->getCaFchconfirmacion("Y-m-d"));?></td>								
                                    <td class="mostrar">Hora en Formato 24h:<br>
                                        <input name="horaconfirmacion" id="horaconfirmacion" value="<?= $referencia->getCaHoraconfirmacion() ?>" onblur="CheckTime(this)" size="9" maxlength="8" type="text">00-23hrs</td>
                                    <td class="mostrar">Registro Aduanero:<br><input name="registroadu" value="<?= $referencia->getCaRegistroadu() ?>" size="22" maxlength="20" type="text"></td>
                                    <td class="mostrar">Fecha Registro:<br><?echo extDatePicker('fchregistroadu', $referencia->getCaFchregistroadu("Y-m-d"));?></td>
                                </tr>
                                <tr>
                                    <td class="mostrar">Reg. Capitania:<br><input name="registrocap" value="<?= $referencia->getCaRegistrocap() ?>" size="20" maxlength="20" type="text"></td>
                                    <td class="mostrar">Bandera:<br><input name="bandera" value="<?= $referencia->getCaBandera() ?>" size="20" maxlength="20" type="text"></td>
                                    <td class="mostrar">Motonave Llegada:<br><input name="mnllegada" value="<?= $referencia->getCaMnllegada() ?>" size="20" maxlength="50" type="text"></td>
                                    <td class="mostrar">Muelle:<br>
                                        <input type='text' id='muelle' name='muelle' />
                                        <script>
                                            var mu = new WidgetMuelles({
                                                        id: 'muelle',
                                                        name: 'muelle',
                                                        hiddenName: "idmuelle",
                                                        value:"<?= $referencia->getInoDianDepositos()->getCaNombre() ?>",
                                                        hiddenValue:"<?= $referencia->getCaMuelle() ?>",
                                                        applyTo: "muelle"
                                                    })
                                        </script>                                    
                                    </td> 
                                    <td class="mostrar" style="display: none">Fecha Desconsolidación:<br><?echo extDatePicker('fchdesconsolidacion', $referencia->getCaFchdesconsolidacion("Y-m-d"));?>	</td>
                                </tr>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducción al Mensaje de Confirmación:</b><br>
                                        <textarea name="intro_body" wrap="virtual" rows="3" cols="93"><?= ($modo == "puerto") ? $textos['mensajeConfPuerto'] : $textos['mensajeConf'] ?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="justify_tbl" style="display: none;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Justificaci&oacute;n Fuera de Tiempo IDG:</b><br>
                                        <textarea id="observaciones_idg" name="observaciones_idg" wrap="virtual" rows="3" cols="93"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="status_fct" style="display: none;" cellspacing="1" width="100%">
                            <tr>
                                <td class="mostrar"><input name="tipo_fact" id="tipo_fact" value="fletes" checked="checked" type="radio" onclick="cambiarTextosFact(this.value)">Fletes</td>
                                <td class="mostrar"><input name="tipo_fact" id="tipo_fact" value="otm" type="radio" onclick="cambiarTextosFact(this.value)">Otm</td>
                                <td class="mostrar"><input name="tipo_fact" id="tipo_fact" value="cont" type="radio" onclick="cambiarTextosFact(this.value)">Contenedores</td>
                                    
                        <table id="status_tbl" style="display: none;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducci&oacute;n al Status:</b><br>
                                        <textarea name="status_body_intro" wrap="virtual" rows="2" cols="93"><?= $textos['mensajeStatusIntro'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Mensaje de Status:</b><br>
                                        <textarea name="status_body" id="status_body" wrap="virtual" rows="3" cols="93"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Fecha de arribo</b><br>
                                        Modificar Fch. Arribo: <input type="checkbox" name="mod_fcharribo" id="mod_fcharribo" onClick="modFcharribo()" />
                                        <div id="mod_fcharribo_id"><?echo extDatePicker('fcharribo', $referencia->getCaFcharribo());?></div>
                                </tr>
                            </tbody>
                        </table>
                        <table id="status_cnt" style="display: none;" cellspacing="1" width="100%">
                            <tbody>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Introducci&oacute;n al Mensaje de Contenedores:</b><br>
                                        <textarea name="status_intro_cont" wrap="virtual" rows="2" cols="93"><?= $textos['mensajeStatusIntro'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="mostrar" colspan="4"><b>Mensaje de Contenedores:</b><br>
                                        <textarea name="status_body_cont" wrap="virtual" rows="7" cols="93">La siguiente es la informaci&oacute;n relacionada con la devoluci&oacute;n de contenedor(es)<?= $intro_body_desc ?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir">
<?
                        if ($modo != "puerto") {
?>
                            <input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Status" onclick="cambiarTipoMsg(this.value)" type="radio">Status:
<?
                        }
?>
                    </td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir">
<?
                        if ($modo != "puerto") {
?>
                            <input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Fact" onclick="cambiarTipoMsg(this.value)" type="radio">Factura (Fletes-Otm-Contenedores):
<?
                        }
?>
                    </td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Desc" onclick="cambiarTipoMsg(this.value)" type="radio">Desconsolidaci&oacute;n:</td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="not_planilla" onclick="cambiarTipoMsg(this.value)" type="radio">Notificaci&oacute;n Planilla:</td>
                </tr>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir"><input name="tipo_msg" class="tipostatus" id="tipo_msg" value="Cont" onclick="cambiarTipoMsg(this.value)" type="radio">Contenedores:</td>
                </tr>
<?
            }
?>
                <tr>
                    <td class="partir">&nbsp;</td>
                    <td class="partir">Adjuntar archivo:</td>
                    <td class="mostrar" colspan="4"><input type='file' id='attachment' name='attachment' size="65" /></td>
                </tr>
                <tr>
                    <td class="listar" colspan="6">&nbsp;</td>
                </tr>
<?
            if (isset($confirmaciones) && $confirmaciones) {
?>
                <tr>
                    <td class="listar" colspan="6">
                        <b>Otras Comunicaciones</b>
                        <table width="100%" border="0" class="tableList">
                            <tr>
                                <th width="18%" >Fecha</th>							
                                <th width="60%" >Asunto</th>
                                <th width="22%" >Ver email</th>
                            </tr>
<?
                            foreach ($confirmaciones as $confirmacion) {
                                
                                $fechatmp= explode(" ", $confirmacion->getCaFchenvio());
                                
                                if (strpos($confirmacion->getCaSubject(), "Notificación de Desconsolidación desde el Puerto") !== false)
                                {                            
                            ?>
                            <script>
                            descF='<?=$fechatmp[0]?>';
                            descH='<?=$fechatmp[1]?>';
                            </script>
                            <input type="hidden" name="desconsolidacionF"id="desconsolidacionF" value="<?=$fechatmp[0]?>"> 
                            <input type="hidden" name="desconsolidacionH" id="desconsolidacionH" value="<?=$fechatmp[1]?>"> 
                            <?
                                }
                                if (strpos($confirmacion->getCaSubject(), "Notificación de Planilla desde el Puerto de")!== false)
                                {
                            ?>
                            <script>
                            plaF='<?=$fechatmp[0]?>';
                            plaH='<?=$fechatmp[1]?>';
                            </script>
                            <input type="hidden" name="planillaF"id="planillaF" value="<?=$fechatmp[0]?>"> 
                            <input type="hidden" name="planillaH" id="planillaH" value="<?=$fechatmp[1]?>"> 
                            <?
                                }
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
            if(isset($tickets) && count($tickets)>0){?>
                <tr>
                    <td class="listar" colspan="6">
                        <b>Tickets Asociados</b>
                        <table width="100%" border="0" class="tableList">
                             <tr>
                                <th width="18%" >Ticket No.</th>							
                                <th width="60%" >Asunto</th>
                                <th width="22%" >Ver Email</th>
                            </tr>
                            <?
                                foreach ($tickets as $ticket) {
                                    ?>
                                    <tr>
                                        <td><?= $ticket->getCaIdticket() ?></td>
                                        <td><?= $ticket->getCaTitle() ?></td>
                                        <td>
                                            <?
                                                echo "<a href='#' onClick=window.open('" . url_for("email/verEmail?id=" . $ticket->getIdemail()) . "')>" . image_tag("22x22/email.gif") . "</a>";
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
            ?>
                
<?
            
        if ($modo != "puerto")
            include_component("confirmaciones", "notClientes", array("numRef" => $referencia->getCaReferencia(), "inoClientes" => $inoClientes, "modo" => $modo, "etapas" => $etapas, "coordinadores" => $coordinadores, "textos" => $textos, $bodegas = "bodegas"));
?>
                <tr height="5">
                    <td class="invertir" colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td class="mostrar" colspan="6"><b>Ingrese mensaje adicional para el correo:</b><br />
                        <textarea name='email_body' wrap="virtual" rows="3" cols="113"></textarea></td>
                </tr>
                <tr height="5">
                    <td class="invertir" colspan="6"></td>
                </tr>
        </table>
        <table width="850" border="0" class="tableList" id="planilla_form" style="display: none;">
            <?
            if ($modo == "puerto")
                include_component("confirmaciones", "notPlanilla", array("inoClientes" => $inoClientes, "modo" => $modo, "tipo_msg" => "Planilla"));
            ?>
        </table><br />
        <table cellspacing="10">
            <tr>
                <th><input class="submit" type='button' name='accion' value='Enviar Correo' onClick="javascript:validarFormConfirmacion(this.planillachecked)" /></th>
                <th><input class="button" type='button' name='boton' value=' Regresar ' onclick="javascript:document.location.href = '<?= url_for("confirmaciones/index?modo=" . $modo) ?>'" /></th>
            </tr>
        </table>        
    </form>
    <table width="850" border="0" class="tableList" id="upload_tbl">
<?
        if ($modo == "puerto" || $modo == "otm")
            include_component("confirmaciones", "uploadClientes", array("inoClientes" => $inoClientes, "modo" => $modo));
?>
    </table><br />
</div>

<script language="javascript" type="text/javascript">
<?
    foreach ($inoClientes as $inoCliente) {
        if ($modo == "otm") {
?>
                mostrar('<?= $inoCliente->getOid() ?>');
<?
        }
        if ($modo != "puerto") {
?>
            habilitar('<?= $inoCliente->getOid() ?>');
<?
            }
        }
        if ($modo != "otm" and $modo != "puerto") {
?>
            radioObj = document.form1.tipo_msg;
            for (var i = 0; i < radioObj.length; i++) {
                if (radioObj[i].checked) {
                    cambiarTipoMsg(radioObj[i].value)
            }
        }
<?
    }
?>
    modFcharribo();
</script>
<?
//print_r($fechasRecibido);
foreach($fechasRecibido as $f)
{

}

?>