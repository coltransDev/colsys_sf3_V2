<? 
error_reporting(0);
$notas = $sf_data->getRaw('notas'); 
    
?>

<div class="content" >
    <div id="panel"></div>
</div>

<div id="header" class="x-hide-display">
    <table cellspacing="1" width="100%" class="tableList">
        <tr>
            <td width="122" >
                <div align="center">
                    <b>Reporte No.:</b><br />
                    <?= $reporte->getCaConsecutivo() ?>
                </div>
            </td>
            <td width="90"  ><div align="center" class="help" id="fchreporte"><span ><b>Fecha</b></span><br />
                    <?= Utils::fechaMes($reporte->getCaFchreporte()) ?>
                </div></td>
            <td width="107" ><div align="center" class="help" id="versiones"><b>Versi&oacute;n No.</b>:<br />
                    <?= $reporte->getCaVersion() . "/" . $reporte->numVersiones() ?>
                </div></td>
            <td width="85" >
                <div align="left" <?= ($comparar) ? (($reporte->compDato("CaIdcotizacion") != 0) ? "class='rojo'" : "") : "" ?>>
                    <b>Cotizaci&oacute;n</b>
                    <br />
                    <?= $reporte->getCaIdcotizacion() ?>
                </div>
            </td>
            <td width="173" >&nbsp;</td>
            <?
            /* $cotProducto = $reporte->getCotProducto();
              if( $cotProducto ){

              $id_cotizacion = $cotProducto->getCaIdcotizacion();
              }else{

              $id_cotizacion = null;
              } */
            ?>

        </tr>


    </table>

</div>


<div id="footer" class="x-hide-display">
    <?
    $usuario = $reporte->getUsuario();
    $sucursal = $usuario->getSucursal();
    ?>
    <table cellspacing="0" width="100%" class="tableList alignLeft">
        <tbody>
            <tr class="row0">
                <td width="20%" ><b>Ciudad :</b><br />
                    <?= $sucursal ? $sucursal->getCaNombre() : "" ?>
                </td>
                <td width="20%">
                    <div align="left">
                        <b>Elaborado por:</b><br />
                        <?= $reporte->getCaUsucreado() ?> <?= UTils::fechaMes($reporte->getCaFchcreado()) ?>
                    </div>
                </td>
                <td width="20%">
                    <div align="left">
                        <b>Actualizado por:</b><br />
                        <?= $reporte->getCaUsuactualizado() ? $reporte->getCaUsuactualizado() : "&nbsp;" ?> <?= UTils::fechaMes($reporte->getCaFchactualizado()) ?>
                    </div>
                </td>
                <td width="20%">
                    <div align="left">
                        <b>Cerrado por:</b><br />
                        <?= $reporte->getCaUsucerrado() ? $reporte->getCaUsucerrado() : "&nbsp;" ?> <?= UTils::fechaMes($reporte->getCaFchcerrado()) ?>
                    </div>
                </td>
                <td width="20%">
                    <div align="left">
                        <b>Rep. Comercial:</b><br />
                        <?= $usuario->getCaNombre() ?>
                    </div>
                </td>
            </tr>
            <?
            if ($reporte->getRepAntecedentes()) {
                ?>
                <tr class="row0">
                    <td width="20%">
                        <div align="left">
                            <b>Enviado por:</b><br />                        
                            <?= $reporte->getRepAntecedentes()->getCaUsucreado() ?> <?= $reporte->getRepAntecedentes()->getCaFchcreado() ?>
                        </div>
                    </td>
                    <td colspan="<?= ($reporte->getRepAntecedentes()->getCaEstado() != "A" && $reporte->getRepAntecedentes()->getCaEstado() != "R" ) ? "4" : "1" ?>" width="20%" >
                        <div align="left">
                            <b>Enviado a:</b><br />
                            <?= $reporte->getRepAntecedentes()->getCaLogin() ?> 
                        </div>
                    </td>
                    <?
                    if ($reporte->getRepAntecedentes()->getCaEstado() == "A") {
                        $repAntUsuario = $reporte->getRepAntecedentes()->getRepAntUsuario();
                        $email = "";
                        foreach ($repAntUsuario as $ra) {
                            $email.="," . $ra->getUsuario()->getCaEmail();
                        }
                        ?>

                        <td width="20%" >
                            <div align="left">
                                <b>Desbloqueado por:</b><br />
                                <?= $reporte->getRepAntecedentes()->getCaUsuaceptado() ?> <?= $reporte->getRepAntecedentes()->getCaFchactualizado() ?>
                            </div>
                        </td>

                        <td  colspan="2">
                            <div align="left" >
                                <b>Notificado a:</b><br />
                                <?= $reporte->getRepAntecedentes()->getCaResponder() . $email ?> 
                            </div>
                        </td>
                        <?
                    }else if($reporte->getRepAntecedentes()->getCaEstado() == "R"){
                        ?>
                        <td width="20%" >
                            <div align="left">
                                <b>Rechazado por:</b><br />
                                <?= $reporte->getRepAntecedentes()->getCaUsurechazo() ?> <?= $reporte->getRepAntecedentes()->getCaFchrechazo() ?>
                            </div>
                        </td>
                        <td  colspan="2">
                            <div align="left" >
                                <b>Motivo rechazo:</b><br />
                                <?= $reporte->getRepAntecedentes()->getCaMotrechazo() ?> 
                            </div>
                        </td>
                        <?
                    }
                    ?>
                </tr>
                <?
            }
            ?>
        </tbody>
    </table>

</div>

<?
include_component("reportesNeg", "infoReporte", array("reporte" => $reporte, "grupoReportes" => $grupoReportes, "comparar" => $comparar));

include_component("reportesNeg", "mainPanel");

include_component("reportesNeg", "panelConceptosFletes", array("reporte" => $reporte, "comparar" => $comparar));
$panelConceptosFletes = true;

if ($reporte->getEsOtm()) {
    include_component("reportesNeg", "panelConceptosOtm", array("reporte" => $reporte, "comparar" => $comparar));
    $panelConceptosOtm = true;
} else
    $panelConceptosOtm = false;

if ($reporte->getCaImpoexpo() != Constantes::EXPO || $reporte->getCaTiporep() == "3") {
    include_component("reportesNeg", "panelRecargos", array("reporte" => $reporte, "comparar" => $comparar));
    $panelRecargos = true;
} else {
    $panelRecargos = false;
}


if (($reporte->getCaColmas() == "Sí" && $reporte->getCaImpoexpo() != Constantes::TRIANGULACION /* || substr($reporte->getCaModalidad(),0,6) == "ADUANA" */ ) || $reporte->getCaTiporep() == "3") {
    include_component("reportesNeg", "panelRecargosAduana", array("reporte" => $reporte, "comparar" => $comparar));
    $panelAduana = true;
} else {
    $panelAduana = false;
}
?>
<script language="javascript">
    Ext.onReady(function(){

    });
    
    var anularReporte = function(btn, text){

        if (btn == "ok" || btn == "yes"){

            if (text.trim() == ""){
                alert("Debe colocar un motivo");
            } else {
                if (btn == "ok")
                    href = '<?= url_for("reportesNeg/anularReporte?id=" . $reporte->getCaIdreporte()) ?>';
                else if (btn == "yes")
                    href = '<?= url_for("reportesNeg/anularReporte?consecutivo=" . $reporte->getCaConsecutivo()) ?>';
                    Ext.Ajax.request({
                        waitMsg: 'Anulando...',
                            url: href,
                            params :	{
                                motivo: text.trim()
                            },
                            callback :function(options, success, response){
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.success){
                                    document.location = "<?= url_for("reportesNeg/verReporte?id=" . $reporte->getCaIdreporte()) ?>";
                                }
                            }
                    });
            }
        }
    };
    
    var ventanaAnularReporte = function(){
        Ext.MessageBox.show({
            title: 'Anular Reporte',
            msg: 'por favor coloque el motivo por el que anula el reporte:',
            width:300,
            buttons:{
                ok     : "Solo Version",
                cancel : "cancelar",
                yes    : "Todas Las versiones"
            },
            multiline: true,
            fn: anularReporte,
            animEl: 'anular-reporte',
            modal: true
        });
        Ext.MessageBox.buttonText.yes = "Version";
        Ext.MessageBox.buttonText.no = "Todas las versiones";
    }

    var ventanaNotas = function(){
    //crea una ventana
        win = new Ext.Window({
            width       : 500,
            height      : 300,
            closeAction :'close',
            plain       : true,
            items       : new Ext.FormPanel({
                id: 'reporte-notas',
                layout: 'form',
                frame: true,
                title: 'Notas Servicio al Cliente',
                autoHeight: true,
                autoWidth: true,
                items: [{
                    xtype:'htmleditor',
                    name:'observaciones',
                    fieldLabel:'RN <?=$reporte->getCaConsecutivo()?>',
                    height:200,
                    anchor:'98%',
                    enableFont: false,
                    enableFontSize: false,
                    enableLinks:  false,
                    enableSourceEdit : false,
                    enableColors : false,
                    enableLists: false,
                    enableFormat: false,
                    enableAlignments: false,
                    allowBlank: true,
                    value: '<?= utf8_decode($notas) ?>'
                }]
            }),
            buttons: [{
                text     : 'Ok',
                handler: function(){
                    var fp = Ext.getCmp("reporte-notas");
                    href = '<?= url_for("reportesNeg/guardarNotas?id=" . $reporte->getCaIdreporte()) ?>';
                    
                    if (fp.getForm().isValid()){
                        Ext.Ajax.request({
                            waitMsg: 'Guardando cambios...',
                            url: href,
                            params :{
                                notas: fp.getForm().findField("observaciones").getValue()
                            },
                            //Ejecuta esta accion cuando el resultado es exitoso
                            callback :function(options, success, response){
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.success){
                                    alert("Las notas se guardaron correctamente");
                                } else {
                                    alert("Ha ocurrido un error al crear el registro");
                                }
                                win.close();
                                document.location = "<?= url_for("reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte()."&modo=".$modo."&impoexpo=".$reporte->getCaImpoexpo())?>";
                            }
                        });
                    }
                }
            }, 
            {
                text: 'Cancelar',
                handler  : function(){
                    win.close();
                }
            }]
        });
        win.show();
    };

var guardarCambios = function(){
    <?
    if ($panelConceptosFletes) {
    ?>
        panelFletes.guardarCambios();
    <?
    }
    if ($panelConceptosOtm) {
    ?>
        panelFletes.guardarCambios();
    <?
    }
    if ($panelRecargos) {
    ?>
        panelRecargosLocales.guardarCambios();
    <?
    }   
    if ($panelAduana) {
    ?>
        panelRecargosAduana.guardarCambios();
    <?
    }
    ?>
}


var importarConceptosFletes = function(){
    panelFletes.importarCotizacion();
}

var importarRecargosLocales = function(){
    panelRecargosLocales.importarCotizacion();
}

<?
if ($panelConceptosFletes) {
    ?>
    var panelFletes = new PanelConceptosFletes({
        title: 'Con. de fletes',
        id:'panel-Fletes'
    });
    <?
}
if ($panelConceptosOtm) {
    ?>
        var panelOtm = new PanelConceptosOtm({
        title: 'Otm',
                id:'panel-Otm'
        });
    <?
}
if ($panelRecargos) {
    ?>
        var panelRecargosLocales = new PanelRecargos({
        title: 'Rec. locales',
                id:'panel-RecargosLocales',
                transporte:'<?= $modo ?>'
        });
    <?
}
if ($panelAduana) {
    ?>
    var panelRecargosAduana = new PanelRecargosAduana({
        title: 'Rec. Aduana',
        id:'panel-Recargos-Aduana'
        <?
        if ($editable) {
            ?>
            ,
            tbar: [{
                text:'Guardar',
                iconCls: 'disk',
                scope:this,
                handler: guardarCambios
            }]
        <?
        }
    ?>
    });
    <?
}
?>

var bodyStyle = 'padding: 5px 5px 5px 5px;';
var mainPanel = new MainPanel({
    activeTab: 0,
    id:"panelMainReporte",
    items: [
        {contentEl:'trayecto', title: 'Trayecto', bodyStyle: bodyStyle},
        {contentEl:'cliente', title: 'Cliente', bodyStyle: bodyStyle},
        {contentEl:'facturacion', title: 'Facturación', bodyStyle: bodyStyle},
        {contentEl:'preferencias', title: 'Preferencias', bodyStyle: bodyStyle},
        <?
        if ($reporte->getCaColmas() == "Sí") {
            ?>
            {contentEl:'aduana', title: 'Aduana', bodyStyle: bodyStyle},
            <?
        }
        if ($reporte->getCaSeguro() == "Sí") {
            ?>
            {contentEl:'seguros', title: 'Seguros', bodyStyle: bodyStyle},
            <?
        }
        if (!$reporte->esSoloAduana()) {
            ?>
            {contentEl:'guias', title: 'Corte de Doc', bodyStyle: bodyStyle},
            <?
        }
        if ($reporte->getCaImpoexpo() == Constantes::EXPO && 1 == 2) {
            ?>
            {contentEl:'exportaciones', title: 'Exportaciones', bodyStyle: bodyStyle},
            <?
        }

        $flag = false;
        if ($panelConceptosFletes) {
            ?>
            panelFletes
            <?
            $flag = true;
        }
        if ($panelConceptosOtm) {
            if ($flag) {
                echo ",";
            }
            ?>
            panelOtm
            <?
            $flag = true;
        }
        if ($panelRecargos) {
            if ($flag) {
                echo ",";
            }
            $flag = true;
            ?>
            panelRecargosLocales
            <?
        }
        if ($panelAduana) {
            if ($flag) {
                echo ",";
            }
            $flag = true;
            ?>
            panelRecargosAduana
            <?
        }
        ?>
    ]
});

var panel = new Ext.FormPanel({
    title: "Reportes de Negocio",
            id:"panel-Form-Reporte",
            items: [
                {contentEl:'header'},
                mainPanel,
                {contentEl:'footer'}
            ]
});
panel.render("panel");
</script>

