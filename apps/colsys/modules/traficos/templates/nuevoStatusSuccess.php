<?
include_component("gestDocumental", "widgetUploadButton");
use_helper("MimeType");

$reporte = $sf_data->getRaw("reporte");
$files = $sf_data->getRaw("files");
$archivos = $sf_data->getRaw("archivos");
$att = $sf_data->getRaw("att");
$reporte_incompleto = $sf_data->getRaw("reporte_incompleto");

if ($reporte->getCaImpoexpo() == Constantes::OTMDTA) {
    if ($reporte->getCaTransporte() == Constantes::TERRESTRE)
        $reporte->setCaTransporte(Constantes::MARITIMO);
    $reporte->setCaImpoexpo(Constantes::IMPO);
}
if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
    $contacto = $reporte->getContacto();

    $sucursal = Doctrine::getTable("Sucursal")->find($user->getIdSucursal());
    $saludo = $sucursal->getCaNombre() . ',  ' . Utils::fechaLarga(date("Y-m-d")) . '\n\n' . $contacto->getCaSaludo() . ': \n';
    $saludo .= $contacto->getCaNombres() . " " . $contacto->getCaPapellido() . " " . $contacto->getCaSapellido() . '\nCiudad\n\n';
    $saludo .= 'Apreciado/a ' . $contacto->getCaSaludo() . ':';

    $saludoAviso = $saludo . '\n\nPor medio de la presente estamos confirmando la salida  de la carga de los señores  ' . $reporte->getConsignatario() . ' como  sigue:';

    $saludoAviso = str_replace("'", "\\'", $saludoAviso);
}

$destinatariosFijos = $form->getDestinatariosFijos();
$contactos_reporte = $form->getContactos();
$operativos_reporte = $form->getOperativos();
$folder = $reporte->getDirectorioBase();
?>
<script language="javascript" type="text/javascript">

    Ext.onReady(function(){
        var uploadButton = new WidgetUploadButton({
            text: "Agregar Archivo",
            iconCls: 'arrow_up',
            folder: "<?= base64_encode($folder) ?>",
            filePrefix: "",
            confirm: true,
            callback:"actualizar",
            renderTo:"button11"
        });
    });
    
    function actualizar(file){
        $("#archivos").append("<input type='checkbox' name='attachments[]' value='" + Base64.encode(file) + "' />");
        $("#archivos").append('<img src="/images/22x22/mimetypes/binary.gif">');
        $("#archivos").append("<a href='<?= url_for("gestDocumental/verArchivo?idarchivo=") ?>" + Base64.encode("<?= $folder ?>/" + file) + "'>" + file + "</a><br>");
    }

    function eliminar(file, idtr){
        if (window.confirm("Realmente desea eliminar este archivo?")){
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request({
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("gestDocumental/borrarArchivo") ?>',
                params :	{
                    idarchivo:file
                },
                failure:function(response, options){
                var res = Ext.util.JSON.decode(response.responseText);
                    if (res.err)
                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                    else
                        Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                },
                success:function(response, options){
                var res = Ext.util.JSON.decode(response.responseText);
                        $("#" + idtr).remove();
                        Ext.MessageBox.hide();
                }
            });
        }
    }


    var enviarFormulario = function(){
        var numChecked = 0;
        for (var i = 0; i <<?= count($destinatariosFijos) ?>; i++){
            var checkFld = document.getElementById("destinatariosfijos_" + i);
            if (checkFld.checked && checkFld.value.trim() != ""){
                numChecked++;
            }   

            if (checkFld.checked && checkFld.value.trim() == ""){
                alert("Un contacto fijo seleccionado no tiene e-mail, por favor seleccione otro");
                return 0;
            }
        }
        //Evalua si la etapa requiere datos para indicador
        var tipo = document.form1.idetapa;
        var value = '';
        for (i = 0; i < tipo.length; i++){
            if (tipo[i].selected){
                value = tipo[i].value;
                break;
            }
        }

        switch (value){
            <?
            foreach ($etapas as $etapa) {
                ?>
                    case '<?= $etapa->getCaIdetapa() ?>':
                        <?
                        if($etapa->getCaIdg()){
                            ?>
                            if ($("#fchrecibo_ext_control").val() == "" || $("#horarecibo_hour").val() == "" || $("#horarecibo_minute").val() == ""){
                                alert("Por Favor ingrese la fecha y hora de recibido el status");
                                return 0;
                            }   
                            <?
                        }
                        ?>
                        break;
                <?
            }
            ?>
        }

        if (numChecked > 0 || <?= $reporte->getCliente()->getProperty("consolidar_comunicaciones") ? "true" : "false" ?>){
            document.getElementById("form1").submit();
        } else{
            if (<?= ($reporte->getCaTiporep() == 4) ? "true" : "false" ?>)
                document.getElementById("form1").submit();
            else
                alert("debe seleccionar al menos un contacto fijo.");
        }
    }

    var validarMensaje = function(){
        document.getElementById("mensaje_dirty").value = "1";
    }

    var mostrar = function(type){
        var tipo = document.form1.idetapa;
        var value = '';
        for (i = 0; i < tipo.length; i++){
            if (tipo[i].selected){
                value = tipo[i].value;
                break;
            }
        }

        var divmensaje = document.getElementById('divmensaje');
        var mensaje = document.form1.mensaje;
        var mensaje_mask = document.form1.mensaje_mask;
        switch (value){
            <?
            foreach ($etapas as $etapa) {                
                ?>
                case '<?= $etapa->getCaIdetapa() ?>':                    
                    var val = '<?= str_replace("\n", "<br />", $etapa->getCaMessage()) ?>';
                    divmensaje.innerHTML = val.split("<br />").join("\n");
                    mensaje_mask.value = val.split("<br />").join("\n");                    
                    <?
                    if($etapa->getCaIdg()!="1"){
                        ?>
                        $("#indicador").hide();
                        $("#observaciones").hide();                    
                        <?
                    }else{
                        
                        ?>
                        $("#indicador").show();
                        $("#observaciones").show();                        
                        <?
                    }
                    ?>
                    break;
                <?
            }
            ?>
            default:
                divmensaje.innerHTML = '';
                mensaje_mask.value = '';
                break;
        }

        switch (value){
            <?
            foreach ($etapas as $etapa) {
                if ($etapa->getIntroAsunto()) {
                ?>
                    case '<?= $etapa->getCaIdetapa() ?>':
                        document.getElementById("asuntoIntro").innerHTML = "<?= $etapa->getIntroAsunto() ?>";
                        break;
                <?
                }
            }
            ?>
            default:
                document.getElementById("asuntoIntro").innerHTML = "";
                break;
        }


        if (!document.form1.mensaje_dirty.value){
            switch (value){
                <?
                foreach ($etapas as $etapa) {
                    ?>
                    case '<?= $etapa->getCaIdetapa() ?>':
                        var val = '<?= str_replace("\n", "<br />", $etapa->getCaMessageDefault()) ?>';
                        mensaje.value = val.split("<br />").join("\n");
                        break;
                    <?
                }
                ?>
                default:
                    mensaje.value = '';
                    break;
            }

            switch (value){
                <?
                foreach ($etapas as $etapa) {
                    if ($etapa->getCaIntro()) {
                    ?>
                        case '<?= $etapa->getCaIdetapa() ?>':
                            var val = '<?= str_replace("\n", "<br />", $etapa->getCaIntro()) ?>';
                            document.form1.introduccion.value = val.split("<br />").join("\n");
                            break;
                    <?
                    }
                }

                if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                    ?>
                        case 'EECEM':
                            var val = '<?= str_replace("\n", "<br />", $saludoAviso) ?>';
                            document.form1.introduccion.value = val.split("<br />").join("\n");
                            break;
                        case 'EEETD':
                            var val = '<?= str_replace("\n", "<br />", $saludoAviso) ?>';
                            document.form1.introduccion.value = val.split("<br />").join("\n");
                            break;
                    <?
                }
                ?>
                default:
                    var val = '<?= str_replace("\n", "<br />", $textos['saludo']) ?>';
                    document.form1.introduccion.value = val.split("<br />").join("\n");
                    break;
            }
        }

        if (type == "1"){
            <?
            if ($_REQUEST["introduccion"] != "") {
                $intro = htmlentities($_REQUEST["introduccion"]); //make remaining items html entries.
                $intro = nl2br($intro); //add html line returns
                $intro = str_replace(chr(10), "", $intro); //remove carriage returns
                $intro = str_replace(chr(13), "", $intro); //remove carriage returns
                ?>
                    var val = '<?= str_replace("\n", "<br />", $intro) ?>';
                            document.form1.introduccion.value = val.split("<br />").join("\n");
                <?
            }
            ?>
            //$("#indicador").show();
            //$("#observaciones").show();
        }
        if (value == "IMETA"){
            document.getElementById("prog_seguimiento").checked = false;
            crearSeguimiento();
            document.getElementById("prog_seguimiento").disabled = true;
        } else{
            document.getElementById("prog_seguimiento").disabled = false;
        }

        <?
        if ($_REQUEST["txtincompleto"] != "") {
            $txtincompleto = htmlentities($_REQUEST["txtincompleto"]); //make remaining items html entries.
            $txtincompleto = nl2br($txtincompleto); //add html line returns
            $txtincompleto = str_replace(chr(10), "", $txtincompleto); //remove carriage returns
            $txtincompleto = str_replace(chr(13), "", $txtincompleto); //remove carriage returns
            ?>
                var val = '<?= str_replace("\n", "<br />", $txtincompleto) ?>';
                        document.form1.txtincompleto.value = val.split("<br />").join("\n");
            <?
        }
        ?>

    }

    var crearSeguimiento = function(){
        if (document.getElementById("prog_seguimiento").checked){
            document.getElementById("row_seguimiento").style.display = "";
        } else{
            document.getElementById("row_seguimiento").style.display = "none";
        }
    }

    var reporteIncompleto = function(){
        if (document.getElementById("rep_incompleto").checked){
            $("#row_incompleto").show();
        } else {
            $("#row_incompleto").hide();
        }
    }

    var reporteOperativo = function(){
        if (document.getElementById("rep_operativo").checked){
            $("#row_operativo").show();
        } else{
            $("#row_operativo").hide();
        }
    }
</script>


<div class="content" align="center">
    <div id="button11" name="button11" ></div>
    <form name="form1" id="form1" action="<?= url_for("traficos/nuevoStatus?modo=" . $modo . "&idreporte=" . $reporte->getCaIdreporte()) ?>" method="post" name="form1" >
        <?
        echo $form['mensaje_dirty']->render();
        echo $form['mensaje_mask']->render();

        /* if( !sfConfig::get("app_smtp_user") ){
          ?>
          <?=image_tag("22x22/alert.gif")?>La autenticación SMTP se encuentra desactivada, es posible que sus mensajes no lleguen al destinatario.
          <br />
          <br />
          <?
          } */
        $form->setDefault('impoexpo', $reporte->getCaImpoexpo());
        echo $form['impoexpo']->render();
        $form->setDefault('transporte', $reporte->getCaTransporte());
        echo $form['transporte']->render();
        ?>
        <table width="60%" border="0" class="tableList">
            <tr>
                <th colspan="2"><div align="center"><b>Nuevo <?= $tipo == "aviso" ? "Aviso" : "Status" ?> </b></div></th>
            </tr>
            <?
            if ($form->renderGlobalErrors()) {
                ?>
                <tr>
                    <td colspan="2">				
                        <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
                </tr>
                <?
            }
            ?>	
            <tr>
                <td width="50%">				
                    <div align="left"><b>Cliente:</b><br /><?= $reporte->getCliente()->getCaCompania() ?></div>		</td>	
                <td width="50%">
                    <div align="left"><b>Reporte:</b><br /><?= $reporte->getCaConsecutivo() . " V" . $reporte->getCaVersion() ?> <a href="/reportesNeg/verReporte/id/<?= $reporte->getCaIdreporte() ?>/impoexpo/<?= $reporte->getCaImpoexpo() ?>/modo/<?= $reporte->getCaTransporte() ?>" target="_blank"><img  src="/images/16x16/pdf.gif"></a></div>
                </td>
            </tr>
            <tr>
                <td valign="top"><div align="left"><b>Remitente:</b>
                <?
                if ($user->getEmail() == "traficos1@coltrans.com.co" || $user->getEmail() == "traficos2@coltrans.com.co") {
                    echo $form['remitente']->renderError();
                    $form->setDefault('remitente', $user->getEmail());
                    echo $form['remitente']->render();
                } else {
                    echo $usuario->getCaNombre() . " &lt;" . $usuario->getCaEmail() . "&gt;";
                }
                ?>	
                    </div></td>
                <td valign="top"><div align="left">&nbsp;</div></td>
            </tr>
            <tr>
                <td valign="top">
                    <div align="left">
                        <?
                        if (count($destinatariosFijos) > 0) {
                            ?>
                                <div class="qtip box1" title="Debe seleccionar al menos un contacto fijo" >
                                    <b>Destinatarios Fijos:</b><br />
                                <?
                                for ($i = 0; $i < count($destinatariosFijos); $i++) {
                                    echo $form['destinatariosfijos_' . $i]->renderError();
                                    $form->setDefault('destinatariosfijos_' . $i, (stripos($reporte->getCaConfirmarClie(), trim($destinatariosFijos[$i]->getCaEmail())) !== false));
                                    echo $form['destinatariosfijos_' . $i]->render() . $form['destinatariosfijos_' . $i]->renderLabel() . "<br />";
                                }
                                ?>
                                </div>
                                <br/>
                                <?
                        }
                        ?>
                        <div class="qtip box1" title="Selecciones los destinatarios a los que les llegara el correo" >
                            <b>Destinatarios:</b><br />
                            <?
                            $destinatarios = $form->getDestinatarios();
                            for ($i = 0; $i < count($destinatarios); $i++) {
                                echo $form['destinatarios_' . $i]->renderError();
                                $form->setDefault('destinatarios_' . $i, 1);
                                echo $form['destinatarios_' . $i]->render() . $form['destinatarios_' . $i]->renderLabel() . "<br />";
                            }
                            if (($reporte->getCaContinuacion() != "N/A" && $reporte->getCaContinuacion() != "TRANSBORDO") && $reporte->getCaTransporte() == Constantes::MARITIMO && $reporte->getCaImpoexpo() != Constantes::EXPO) {
                                echo " &nbsp;&nbsp;&nbsp;Coordinador OTM/DTA<br />";
                            }
                            if ($reporte->getCaSeguro() == "Sí") {
                                $repseguro = $reporte->getRepSeguro();
                                if ($repseguro) {
                                    $usuario = Doctrine::getTable("Usuario")->find($repseguro->getCaSeguroConf());
                                    if ($usuario) {
                                        echo " &nbsp;&nbsp;&nbsp;Seguros: " . $usuario->getCaEmail() . "<br />";
                                        if ($usuario->getCaEmail() != "seguros@coltrans.com.co") {
                                            echo " &nbsp;&nbsp;&nbsp;Seguros: seguros@coltrans.com.co<br />";
                                        }
                                    } else {
                                        echo " &nbsp;&nbsp;&nbsp;Seguros: seguros@coltrans.com.co<br />";
                                    }
                                }
                            }

                            if ($reporte->getCaColmas() == "Sí") {
                                $repaduana = $reporte->getRepAduana();
                                $coordinador = null;
                                if ($repaduana) {

                                    $coordinador = Doctrine::getTable("Usuario")->find($repaduana->getCaCoordinador());
                                }

                                if ($coordinador) {
                                    echo " &nbsp;&nbsp;&nbsp;" . $coordinador->getCaNombre() . "<br />";
                                } else {
                                    echo "- No se ha definido coordinador de aduana en Maestra de Clientes<br />";
                                }

                                if (($reporte->getCaTransporte() == constantes::MARITIMO && $reporte->getCaImpoexpo() == constantes::IMPO) && $reporte->getCaContinuacion() != "OTM") {
                                    $cargo = "Jefe de Aduanas Puerto";
                                } else if (($reporte->getCaTransporte() == constantes::AEREO && $reporte->getCaImpoexpo() == constantes::IMPO) || $reporte->getCaContinuacion() == "OTM") {
                                    $cargo = "Jefe Dpto. Aduana";
                                }
                                $cargo1 = 'Coordinador Control Riesgo Aduana';
                                echo " &nbsp;&nbsp;&nbsp;" . $cargo . "<br />";
                                echo " &nbsp;&nbsp;&nbsp;" . $cargo1 . "<br />";
                            }
                            ?>
                        </div>
                    </div></td>
                <td valign="top">
                    <div align="left"><b>Copiar a: </b>
                        <br />
                        <?
                        for ($i = 0; $i < NuevoStatusForm::NUM_CC; $i++) {
                            echo $form['cc_' . $i]->renderError();
                            echo $form['cc_' . $i]->render() . "<br />";
                        }
                        ?>		
                    </div></td>
            </tr>
            <tr>
                <td>
                    <div align="left"><b>Etapa:</b><br />
                        <?
                        echo $form['idetapa']->renderError();
                        if ($tipo == "aviso") {
                            if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                                $form->setDefault('idetapa', "EEETD");
                            } else {
                                $form->setDefault('idetapa', "IMETA");
                            }
                        } else {
                            if ($ultStatus) {
                                $form->setDefault('idetapa', $ultStatus->getCaIdetapa());
                            }
                        }
                        echo $form['idetapa']->render();
                        ?>		
                    </div></td>
                <td><div align="left"></div></td>
            </tr>
            <?
            $asunto = "";

            $origen = $reporte->getOrigen()->getCaCiudad();
            $destino = $reporte->getDestino()->getCaCiudad();
            $cliente = $reporte->getCliente()->getCaCompania();
            $consignatario = $reporte->getConsignatario();
            if ($reporte->getCaTiporep() == "4") {
                $importador = $reporte->getRepOtm()->getImportador()->getCaNombre();
                if ($importador)
                    $asunto .= $importador . " / " . $cliente . " [" . $origen . " -> " . $destino . "] " . $reporte->getCaOrdenClie() . "-" . $reporte->getRepOtm()->getCaHbls();
                else
                    $asunto .= $cliente . " [" . $origen . " -> " . $destino . "] " . $reporte->getCaOrdenClie() . "-" . $reporte->getRepOtm()->getCaHbls();
            }
            else if ($reporte->getCaImpoexpo() == Constantes::IMPO || $reporte->getCaImpoexpo() == Constantes::TRIANGULACION) {
                $proveedor = substr($reporte->getProveedoresStr(), 0, 130);
                $asunto .= $proveedor . " / " . $cliente . " [" . $origen . " -> " . $destino . "] " . $reporte->getCaOrdenClie();
            } else if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                if (!$ultStatus)
                    $asunto .= "Status Id.: " . $reporte->getCaConsecutivo() . " " . $consignatario . " / " . $cliente . " [" . $origen . " -> " . $destino . "] ";
                else
                    $asunto = $ultStatus->getEmail()->getCaSubject();
            }
            else {
                $asunto .= $consignatario . " / " . $cliente . " [" . $origen . " -> " . $destino . "] ";
            }
            ?>
            <tr>
                <td colspan="2"><div align="left"><b>Asunto:</b><br />
                    <div id="asuntoIntro"></div>
                        <?
                        if ($reporte->getCaImpoexpo() != Constantes::EXPO)
                            echo " Id.: " . $reporte->getCaConsecutivo() . " ";
                        echo $form['asunto']->renderError();
                        $form->setDefault('asunto', $asunto);
                        echo $form['asunto']->render();
                        ?>
                    </div></td>
            </tr>
            <tr>
                <td><div align="left"><b>Informaci&oacute;n de la carga</b></div></td>
                <td><div align="left"></div></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="0" class="tableList">
                        <tr>
                            <td width="34%"><div align="left"><b>Origen</b>:<br />
                                <?= $reporte->getOrigen() ?>
                                </div></td>
                            <td width="31%"><div align="left"><b>Fecha de salida:</b><br />
                                <?
                                echo $form['fchsalida']->renderError();
                                if ($ultStatus) {
                                    $form->setDefault('fchsalida', $ultStatus->getCaFchsalida());
                                }
                                echo $form['fchsalida']->render();
                                ?>		
                                </div></td>
                            <td width="35%">
                                <div align="left">
                                    <?
                                    if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                                        ?>
                                        <b>Hora de salida:</b><br />
                                        <?
                                        echo $form['horasalida']->renderError();
                                        if ($ultStatus) {
                                            $form->setDefault('horasalida', $ultStatus->getCaHorasalida());
                                        }
                                        echo $form['horasalida']->render();
                                    } else {
                                        echo "&nbsp;";
                                    }
                                    ?>
                                </div></td>
                        </tr>
                        <tr>
                            <td><div align="left"><b>Destino:</b><br />
                                    <?= $reporte->getDestino() ?>				
                                </div></td>
                            <td><div align="left"><b>Fecha de llegada:</b><br />
                                    <?
                                    echo $form['fchllegada']->renderError();
                                    if ($ultStatus) {
                                        $form->setDefault('fchllegada', $ultStatus->getCaFchllegada());
                                    }
                                    echo $form['fchllegada']->render();
                                    if ($reporte->getCaTransporte() == Constantes::AEREO) {
                                        echo $form['jornada']->renderError();
                                        $jornadaAereo = "";
                                        if ($ultStatus) {
                                            $form->setDefault('jornada', $ultStatus->getProperty("jornada"));
                                        } else {
                                            $form->setDefault('jornada', $jornadaAereo);
                                        }
                                        echo $form['jornada']->render();
                                    }
                                    ?>                        
                                </div></td>
                            <td>&nbsp;</td>
                        </tr>
                        <?
                        if ($reporte->getCaImpoexpo() != Constantes::EXPO && ($reporte->getCaContinuacion() != "N/A" && $reporte->getCaContinuacion() != "TRANSBORDO")) {
                            ?>
                            <tr>
                                <td><div align="left"><b>Continuación:</b><br />
                                        <?= $reporte->getCaContinuacion() . " -> " . $reporte->getDestinoCont() ?>				
                                    </div></td>
                                <td><div align="left"><b><b>Fecha de llegada:</b></b><br />
                                        <?
                                        echo $form['fchcontinuacion']->renderError();
                                        if ($ultStatus) {
                                            $form->setDefault('fchcontinuacion', $ultStatus->getCaFchcontinuacion());
                                        }
                                        echo $form['fchcontinuacion']->render();
                                        ?>
                                    </div></td>
                                <td>&nbsp;</td>
                            </tr>
                            <?
                        }
                        ?>
                        <tr>
                            <td><div align="left"><b>Piezas</b>:<br />
                                    <?
                                    echo $form['piezas']->renderError();

                                    $piezas = "";
                                    $piezasTipo = "";
                                    if ($reporte->getCaTiporep() == "4") {
                                        $piezas = $reporte->getRepOtm()->getCaNumpiezas();
                                        $piezasTipo = $reporte->getRepOtm()->getCaNumpiezasun();
                                    } else {
                                        if ($ultStatus && $ultStatus->getCaPiezas()) {
                                            $piezasArr = explode("|", $ultStatus->getCaPiezas());
                                            $piezas = $piezasArr[0];
                                            $piezasTipo = isset($piezasArr[1]) ? $piezasArr[1] : "";
                                        }
                                    }
                                    $form->setDefault('piezas', $piezas);
                                    $form->setDefault('un_piezas', $piezasTipo);

                                    echo $form['piezas']->render() . "&nbsp;";
                                    echo $form['un_piezas']->render() . "&nbsp;";
                                    ?>				
                                </div></td>
                            <td><div align="left"><b>Peso</b>:<br />
                                    <?
                                    echo $form['peso']->renderError();
                                    $peso = "";
                                    $pesoTipo = "";
                                    if ($reporte->getCaTiporep() == "4") {
                                        $peso = $reporte->getRepOtm()->getCaPeso();
                                        $pesoTipo = $reporte->getRepOtm()->getCaPesoun();
                                    } else {
                                        if ($ultStatus && $ultStatus->getCaPeso()) {
                                            $pesoArr = explode("|", $ultStatus->getCaPeso());
                                            $peso = $pesoArr[0];
                                            $pesoTipo = isset($pesoArr[1]) ? $pesoArr[1] : "";
                                        }
                                    }
                                    $form->setDefault('peso', $peso);
                                    $form->setDefault('un_peso', $pesoTipo);
                                    echo $form['peso']->render() . "&nbsp;";
                                    echo $form['un_peso']->render() . "&nbsp;";
                                    ?>				
                                </div></td>
                            <td><div align="left"><b>Volumen</b>:<br />
                                    <?
                                    echo $form['volumen']->renderError();
                                    $vol = "";
                                    $volTipo = "";
                                    if ($reporte->getCaTiporep() == "4") {
                                        $vol = $reporte->getRepOtm()->getCaVolumen();
                                        $volTipo = $reporte->getRepOtm()->getCaVolumenun();
                                    } else {
                                        if ($ultStatus && $ultStatus->getCaVolumen()) {
                                            $volArr = explode("|", $ultStatus->getCaVolumen());
                                            $vol = $volArr[0];
                                            $volTipo = isset($volArr[1]) ? $volArr[1] : "";
                                        }
                                    }
                                    $form->setDefault('volumen', $vol);
                                    $form->setDefault('un_volumen', $volTipo);

                                    echo $form['volumen']->render() . "&nbsp;";
                                    echo $form['un_volumen']->render() . "&nbsp;";
                                    ?>				
                                </div></td>
                        </tr>
                        <tr>
                            <td><div align="left"><b><?= ($reporte->getCaTransporte() == Constantes::MARITIMO) ? "HBL:" : "HAWB:" ?></b><br />
                                    <?
                                    echo $form['doctransporte']->renderError();
                                    if ($reporte->getCaTiporep() == "4") {
                                        $form->setDefault('doctransporte', $reporte->getRepOtm()->getCaHbls());
                                    } else {
                                        if ($ultStatus) {
                                            $form->setDefault('doctransporte', $ultStatus->getCaDoctransporte());
                                        }
                                    }
                                    echo $form['doctransporte']->render();
                                    ?>				
                                </div></td>
                            <td><div align="left"><b><?= ($reporte->getCaTiporep() != "4") ? (($reporte->getCaTransporte() == Constantes::MARITIMO) ? "Motonave:" : "Vuelo:") : "Vehiculo" ?></b><br />					
                                    <?
                                    echo $form['idnave']->renderError();
                                    if ($ultStatus) {
                                        $form->setDefault('idnave', $ultStatus->getCaIdnave());
                                    }
                                    echo $form['idnave']->render();
                                    ?>
                                </div></td>
                            <td><div align="left"> <? if ($reporte->getCaTransporte() == Constantes::MARITIMO) { ?>
                                    <b>Muelle</b>:<br />
                                    <?
                                    echo $form['idmuelle']->renderError();
                                    if ($ultStatus) {
                                        $form->setDefault('idmuelle', $ultStatus->getProperty("muelle"));
                                    }
                                    echo $form['idmuelle']->render();  
                                    } ?>
                                </div></td>
                        </tr>
                        <!--<tr>
                            <td><div align="left"><b>Carga Disponible</b>:<br />
                                    <?
                                    //echo $form['fch_cargadisponible']->renderError();
                                    /*if ($ultStatus) {
                                        $form->setDefault('fch_cargadisponible', $ultStatus->getProperty("cargaDisponible"));
                                    }
                                    echo $form['fch_cargadisponible']->render(); */
                                    ?>				
                                </div></td>
                                <td><div align="left">&nbsp;</div></td>
                                <td><div align="left">&nbsp;</div></td>
                        </tr>                        -->
                        <?
                        if ($reporte->getCaTiporep() != 4) {
                            $widgets = $form->getWidgetsClientes();
                            if (count($widgets) > 0) {
                                foreach ($widgets as $name => $val) {
                                    ?>
                        <tr>
                            <td colspan="3">
                                <div align="left">
                                    <?
                                    echo "<b>" . $val["label"] . ":</b><br />";
                                    echo $form[$name]->renderError();
                                    if ($ultStatus) {
                                        $form->setDefault($name, $reporte->getProperty($name));
                                    }
                                    echo $form[$name]->render();
                                    ?>
                                </div></td>
                        </tr>						
                                    <?
                                }
                            }
                        }
                        if($reporte->getCliente()->getProperty("idgProveedor")){
                            $widgets = $form->getWidgetsProveedores();                            
                            if(count($widgets)>0){
                                ?>
                                <tr>
                                    <td colspan="3">Proveedores: <br/>
                                        Fechas de carga disponible para medir indicador Coordinación de Embarque:
                                        <?
                                        foreach ($widgets as $name => $val) {                                            
                                            ?>
                                            <div align="left">
                                                <?
                                                echo "<b>" . $val["label"] . ":</b>";
                                                echo $form["id_".$name]->renderError();                                                
                                                $form->setDefault('id_'.$name, $val["valor"]);                                                
                                                echo $form["id_".$name]->render();
                                                ?>
                                            </div>
                                            <?
                                        }  
                                        ?>
                                    </td>
                                </tr>
                                <?
                            }
                        }
                        if ($reporte->getCaModalidad() == "FCL") {
                            ?>
                            <tr>
                                <td valign="top"><b>No. Master:</b>
                            <?
                            echo $form['docmaster']->renderError();
                            if ($ultStatus) {
                                $form->setDefault('docmaster', $ultStatus->getCaDocmaster());
                            }
                            echo $form['docmaster']->render();
                            ?>				
                                </td>
                                <td colspan="2">
                                    <b> Equipos para el embarque :&nbsp;</b><br />
                                    <table  width="100%" border="1" class="tableList">
                                        <tbody>
                                            <tr>
                                                <th width="34%">Tipo</th>
                                        <?
                                        if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                                            ?>
                                                    <th width="21%">Serial</th>
                                            <?
                                        } else if ($reporte->getCaImpoexpo() == Constantes::IMPO) {
                                            ?>
                                                    <th width="21%">No.Contenedor</th>
                                            <?
                                        }
                                        ?>
                                                <th width="45%">Cantidad</th>
                                            </tr>
                                    <?
                                    $repequipos = $reporte->getRepEquipos();

                                    for ($i = 0; $i < NuevoStatusForm::NUM_EQUIPOS; $i++) {
                                        if (count($repequipos) > 0 && isset($repequipos[$i])) {
                                            $repequipo = $repequipos[$i];
                                        } else {
                                            $repequipo = null;
                                        }
                                        ?>
                                                <tr>
                                                    <td>
                                                    <?
                                                    echo $form['equipos_tipo_' . $i]->renderError();
                                                    if ($repequipo) {
                                                        $form->setDefault('equipos_tipo_' . $i, $repequipo->getCaIdconcepto());
                                                    }
                                                    echo $form['equipos_tipo_' . $i]->render();
                                                    ?>								</td>
                                                    <?
                                                    if ($reporte->getCaImpoexpo() == Constantes::EXPO or $reporte->getCaImpoexpo() == Constantes::IMPO) {
                                                        ?>
                                                        <td>
                                                        <?
                                                        echo $form['equipos_serial_' . $i]->renderError();
                                                        if ($repequipo) {
                                                            $form->setDefault('equipos_serial_' . $i, $repequipo->getCaIdequipo());
                                                        }
                                                        echo $form['equipos_serial_' . $i]->render();
                                                        ?>									</td>	
                                                    <?
                                                }
                                                ?>
                                                    <td>
                                                <?
                                                echo $form['equipos_cant_' . $i]->renderError();
                                                if ($repequipo) {
                                                    $form->setDefault('equipos_cant_' . $i, $repequipo->getCaCantidad());
                                                }
                                                echo $form['equipos_cant_' . $i]->render();
                                                ?>								</td>											
                                                </tr>
                                                        <?
                                                    }
                                                    ?>
                                        </tbody>
                                    </table>				
                                </td>
                            </tr>
                                                <?
                                            }if ($reporte->getCaTransporte() == Constantes::AEREO) {
                                                ?>
                            <tr>
                                <td valign="top" colspan="3"><b>Manifiesto:</b><br>
                                                    <?
                                                    echo $form['manifiesto']->renderError();
                                                    if ($ultStatus) {
                                                        $form->setDefault('manifiesto', $ultStatus->getProperty("manifiesto"));
                                                    }
                                                    echo $form['manifiesto']->render();
                                                    ?>				
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3"><b>Fch. Manifiesto:</b><br>
                                                    <?
                                                    echo $form['fchmanifiesto']->renderError();
                                                    if ($ultStatus) {
                                                        $form->setDefault('fchmanifiesto', $ultStatus->getProperty("fchmanifiesto"));
                                                    }
                                                    echo $form['fchmanifiesto']->render();
                                                    ?>				
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td valign="top" colspan="3"><b>Valor Fob:</b>
                                                    <?
                                                    echo $form['valor_fob']->renderError();
                                                    if ($ultStatus) {
                                                        $form->setDefault('valor_fob', $ultStatus->getProperty("valor_fob"));
                                                    }
                                                    echo $form['valor_fob']->render();
                                                    ?>				
                                </td>
                            </tr>-->
    <?
}
?>		
                    </table></td>
            </tr>	
            <?
            if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                $repexpo = $reporte->getRepExpo();
                //if( $repexpo->getCaEmisionbl()=="Destino" ){												
                ?>
                <tr>
                    <td colspan="2"><div align="left"><b>Datos en destino para reclamar el BL:</b><br />
                                    <?
                                    echo $form['datosbl']->renderError();
                                    $datosbl = str_replace("<br />", "\n", $repexpo->getCaDatosbl());
                                    $form->setDefault('datosbl', $repexpo->getCaDatosbl() ? $datosbl : "Empresa:\nTel:\nContacto:" );
                                    echo $form['datosbl']->render();
                                    ?>								
                        </div></td>
                </tr>
                <?
                if ($repexpo->getCaIdsia() == 17 || $repexpo->getCaIdsia() == 9) { //Solamente cuan colmas maneja la carga
                    ?>
                <tr>
                    <td colspan="2"><div align="left"><b>Inspección Fisica:</b><br />
                                    <?
                                    echo $form['inspeccion_fisica']->renderError();
                                    $form->setDefault('inspeccion_fisica', $repexpo->getCaInspeccionFisica());
                                    echo $form['inspeccion_fisica']->render();
                                    ?>
                        </div></td>
                </tr>
                    <?
                }
            }
            ?>
            <tr>
                <td colspan="2"><div align="left"><b>Introducci&oacute;n al mensaje:</b><br />
                    <?
                    echo $form['introduccion']->renderError();
                    $form->setDefault('introduccion', $textos['saludo']);
                    echo $form['introduccion']->render();
                    ?>		
                    </div></td>
            </tr>
            <tr>
                <td colspan="2"><div align="left"><b>Descripci&oacute;n del Status</b><br />
                        <div id="divmensaje"></div>
            <?
            echo $form['mensaje']->renderError();
            echo $form['mensaje']->render();
            ?>
                    </div></td>
            </tr>
                        <?
                        /*
                          <tr>
                          <td colspan="2"><div align="left"><b>Notas</b><br />
                          <?
                          // echo $form['notas']->renderError();
                          // echo $form['notas']->render();
                          ?>
                          </div></td>
                          </tr>
                         */
                        ?>
            <tr>
                <td colspan="2">
                    <div align="left" id="archivos"><b>Adjuntar documento:</b><br />
                        <input type="checkbox"  title="Marcar o Desmarcar Todos los archivos " onclick="selTodasFotos(this)"> Marcar o Desmarcar Todos los archivos<br/>
                        <?
                        if (count($files) > 0) {
                            $imagenes="";
                            foreach ($files as $file) {
                                if (array_search(base64_encode(basename($file)), $att) !== false) {
                                    $option = 'checked="checked"';
                                } else {
                                    $option = '';
                                }
                                
                                if(Utils::isImage($file)){
                                    $dimension = 640;
                                    $dimVisual = 50;
                                    $i = 0;
                                    $j = 0;
                                    
                                    $filename = $file;
                                    //echo $file;
                                    //$folder = $reporte->getDirectorioBaseDocs($filename);                            
                                    $imagenes.= '<div style="width:' . $dimVisual . 'px;height:' . $dimVisual . 'px;float: left;margin: 15px;" id="file_' . $j . '">
                                        <div style="position:relative ">
                                            <div style="position:absolute;" >
                                                <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?name=' . base64_encode($file) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" alt="'.basename($filename).'"  title="'.basename($filename).'"   />
                                                '.basename($filename).'
                                            </div>                                    
                                            <div style="position:absolute;top:0px;right:0px;display:block" >
                                               <input type="checkbox" value="'.base64_encode(basename($filename)) .'" name="attachments[]" '.$option.' class="imgS" />
                                            </div>
                                        </div>                        
                                    </div>';
                                    //echo '<img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folder) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" /><br>';
                                }else{
                                ?>
                                    <input type="checkbox" name="attachments[]" value="<?= base64_encode(basename($file)) ?>"  <?= $option ?> class="imgS" />
                                <?
                                    echo mime_type_icon(basename($file)) . " " . link_to(basename($file), url_for("traficos/fileViewer?idreporte=" . $reporte->getCaIdreporte() . "&file=" . base64_encode(basename($file))), array("target" => "blank")) . "<br />";
                                }
                            }                            
                        }
                        
                        if (count($archivos) > 0) {
                            //$imagenes="";
                            foreach ($archivos as $file) {
                                $filename = $file->getCaNombre();
                                if (array_search(base64_encode(basename($filename)), $att) !== false) {
                                    $option = 'checked="checked"';
                                } else {
                                    $option = '';
                                }
                                ?>
                                
                                
                                <?
                                if(Utils::isImage($file->getCaNombre())){
                                    $dimension = 640;
                                    $dimVisual = 50;
                                    $i = 0;
                                    $j = 0;
                                    
                                    $filename = $file->getCaNombre();
                                    $folder = $reporte->getDirectorioBaseDocs($filename);                            
                                    $imagenes.= '<div style="width:' . $dimVisual . 'px;height:' . $dimVisual . 'px;float: left;margin: 5px;" id="file_' . $j . '">
                                        <div style="position:relative ">
                                            <div style="position:absolute;" >
                                                <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folder) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" alt="'.$filename.'"  title="'.$filename.'"   />
                                            </div>                                    
                                            <div style="position:absolute;top:0px;right:0px;display:block" >
                                               <input type="checkbox" value="'.base64_encode(basename($filename)) .'" name="attachments1[]" '.$option.' class="imgS" />
                                            </div>
                                    </div>                        
                                  </div>';
                                    //echo '<img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folder) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" /><br>';
                                }else
                                {
                                    ?><input type="checkbox" name="attachments1[]" value="<?= base64_encode(basename($filename)) ?>"  <?= $option ?> class="imgS" /><?
                                    echo mime_type_icon(basename($filename)) . " " . link_to(basename($filename), url_for("traficos/fileViewer?idreporte=" . $reporte->getCaIdreporte() . "&gestDoc=true&file=" . base64_encode(basename($filename))), array("target" => "blank")) . "<br />";
                                }
                                //include_component("gestDocumental", "returnFiles",array("idsserie"=>"2","view"=>"email1","ref1"=>$reporte->getInoClientesSea()->getCaReferencia(),"ref2"=>$reporte->getInoClientesSea()->getCaHbls(),"ref3"=>"","format"=>"coloader")); 
                            }
                        }
                        echo $imagenes;
                        ?>
                        
                    </div>
                </td>
            </tr>
            <!--<tr>
                <td colspan="2" id="button11"></td>
            </tr>-->

            <tr id="indicador">
                <td><div align="left"><b>Fecha Recibido Status:</b><br />
                    <?
                    echo $form['fchhorarecibo']->renderError();
                    echo $form['fchrecibo']->renderError();
                    echo $form['fchrecibo']->render();
                    ?>		
                    </div></td>
                <td><div align="left"><b>Hora de Recibido - Formato 24h: (HH:mm)</b><br />
                        <?
                        echo $form['horarecibo']->renderError();
                        echo $form['horarecibo']->render();
                        ?>		
                    </div></td>
            </tr>
            <tr id="observaciones">
                <td colspan="2"><div align="left"><b>Observaciones IDG (Justificaci&oacute;n Demoras):</b><br />
                        <?
                        echo $form['observaciones_idg']->renderError();
                        echo $form['observaciones_idg']->render();
                        ?>
                    </div></td>

            </tr>
            <tr>
                <td colspan="2"><div align="left"><b>Programar recordatorio:</b>
                    <?
                    echo $form['prog_seguimiento']->renderError();
                    echo $form['prog_seguimiento']->render();
                    ?>
                    </div></td>
            </tr>
            <tr>
                <td colspan="2" id="row_seguimiento"><div align="left"><b>Fecha:</b>
                        <?
                        echo $form['fchseguimiento']->renderError();
                        echo $form['fchseguimiento']->render();
                        ?>
                    </div>			
                    <br />
                    <div align="left"><b>Recordar sobre:</b>
                        <?
                        echo $form['txtseguimiento']->renderError();
                        echo $form['txtseguimiento']->render();
                        ?>
                        <br>
                        <b>Notificar tambien a:</b>
                        <div style="overflow:scroll; height: 200px">
                        <?
                        echo $form['emailusuario']->renderError();
                        echo $form['emailusuario']->render();
                        ?>
                        </div>
                    </div></td>
            </tr>
            <tr>
                <td colspan="2"><div align="left"><b>Reporte incompleto:</b>
                        <br>
                        <?
                        echo $reporte_incompleto;
                        echo $form['rep_incompleto']->renderError();
                        echo $form['rep_incompleto']->render();
                        ?>
                    </div>
                </td>
            </tr>
            <tr id="row_incompleto" style="display: none;">
                <td valign="top" >
                    <div >
                        Observaciones<br>
                        <?
                        echo $form['txtincompleto']->renderError();
                        echo $form['txtincompleto']->render();
                        ?>
                    </div>
                    <div align="left">
                        <? ?>
                        <div class="qtip box1" title="Seleccione los destinatarios a los que les llegara el correo" >
                            <b>Destinatarios:</b><br />
                            <?
                            for ($i = 0; $i < count($contactos_reporte); $i++) {
                                echo $form['contactos_' . $i]->renderError();
                                //$form->setDefault('contactos_'.$i, 0 );
                                echo $form['contactos_' . $i]->render() . $contactos_reporte[$i]["ca_email"] . "<br />";
                            }
                            ?>
                        </div>
                    </div></td>
                <td valign="top">
                    <div align="left"><b>Copiar a: </b>
                        <br />
                        <?
                        for ($i = 0; $i < NuevoStatusForm::NUM_CC; $i++) {
                            echo $form['cci_' . $i]->renderError();
                            echo $form['cci_' . $i]->render() . "<br />";
                        }
                        ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2"><div align="left"><b>Incluir Datos de Operativos:</b>
                        <br>
                        <?
                        echo $reporte_operativo;
                        echo $form['rep_operativo']->renderError();
                        echo $form['rep_operativo']->render();
                        ?>
                    </div> Esta opción permite incluir en el cuerpo del mensaje, los datos de contacto de las personas de operativo señaladas.
                </td>
            </tr>

            <tr id="row_operativo" style="display: none;">
                <td valign="top" >
                    <div align="left">
                            <?
                            ?>
                        <div class="qtip box1" title="Seleccione los operativos, cuyos datos serán incuidos en el correo" >
                            <b>Operativos:</b><br />
                            <?
                            for ($i = 0; $i < count($operativos_reporte); $i++) {
                                echo $form['operativos_' . $i]->renderError();
                                //$form->setDefault('contactos_'.$i, 0 );
                                echo $form['operativos_' . $i]->render() . $operativos_reporte[$i]["ca_nombre"] . "<br />";
                            }
                            ?>
                        </div>
                    </div></td>
            </tr>
            <tr>
                <td colspan="2"><div align="center">
                        <input type="button" value="Enviar" class="button" onclick="enviarFormulario()" />&nbsp;			
                        <input type="button" value="Cancelar" class="button" onClick="document.location = '<?= url_for("traficos/listaStatus?modo=" . $modo . "&reporte=" . $reporte->getCaConsecutivo()) ?>'" />
                    </div></td>
            </tr>
        </table>
    </form>
</div>
<script language="javascript" type="text/javascript">
    mostrar(1);
    crearSeguimiento();
    <?
    if ($reporte_incompleto != "") {
        $c++;
        ?>
        $("#rep_incompleto").attr("checked", true);
        <?
    }
    ?>
function selTodasFotos(obj)
    {     
        $('.imgS').attr("checked",!$('.imgS').attr("checked"));
     
    }
</script>