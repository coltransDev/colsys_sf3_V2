<?
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
//include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetMultiIncoterms");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetUsuario");
include_component("widgets", "widgetDeptos");
$cliente = $sf_data->getRaw("cliente");
$agente = $sf_data->getRaw("agente");
$linea = $sf_data->getRaw("linea");
$sucursalagente = $sf_data->getRaw("sucursalagente");
$sucursal = $sf_data->getRaw("sucursal");
$incoterms = $sf_data->getRaw("incoterms");
//print_r($incoterms);
//echo implode(",", $incoterms);
$resul = $sf_data->getRaw("resul");
?>

<div align="center" >
    <br />
    <h3> Reporte de Carga Operativa </h3>
    <br />
</div>
<div align="left" id="container"></div>
<script language="javascript">
    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border:true,
        fame:true,
        deferredRender:false,
        width: 900,
        standardSubmit: true,
        buttonAlign : 'center',
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults:{autoHeight:true, bodyStyle:'padding:10px'},
            id: 'tab-panel',
            items:[{
                    title:'Estadisticas',
                    layout:'form',
                    defaultType: 'textfield',
                    id: 'estadisticas',
                    labelWidth: 75,

                    items: [
                        {
                            xtype:'fieldset',
                            title: 'filtros',
                            autoHeight : true,
                            layout : 'column',
                            columns : 2,
                            defaults:{
                                columnWidth:0.5,
                                layout:'form',
                                border:false,
                                bodyStyle:'padding:4px;'
                            },
                            items :
                                [
                                {
                                    xtype:'hidden',
                                    name:"opcion",
                                    value:"buscar"
                                },
                                {
                                    xtype:"hidden",
                                    id: 'impoexpo',
                                    name: 'impoexpo',
                                    value:'<?= Constantes::IMPO ?>'
                                },
                                {
                                    columnWidth:0.5,
                                    border:false,
                                    items:
                                        [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Ini',
                                            name : 'fechaInicial',
                                            format: 'Y-m-d',
                                            value: '<?= $fechainicial ?>'
                                        }
                                        ,
                                        new WidgetTransporte({fieldLabel: 'Transporte',
                                            id: 'transporte',
                                            hiddenName: "idtransporte",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:""
                                        }),
                                        new WidgetPais({title: 'Pais origen',
                                            fieldLabel: 'Pais origen',
                                            id: 'pais_origen',
                                            name: 'pais_origen',
                                            hiddenName: "idpais_origen",
                                            pais:"todos",
                                            value:"<?= $idpais_origen ?>"
                                        }),
                                        new WidgetPais({title: 'Pais destino',
                                            fieldLabel: 'Pais destino',
                                            id: 'pais_destino',
                                            name: 'pais_destino',
                                            hiddenName: "idpais_destino",
                                            pais:"todos",
                                            value:"<?= $idpais_destino ?>"
                                        }),
                                        new WidgetCliente({fieldLabel: 'Cliente',
                                            id:"Cliente",
                                            hiddenName:"idcliente",
                                            width:300,
                                            value:"<?= $cliente ?>",
                                            hiddenValue:"<?= $idcliente ?>"
                                        }),
                                        new WidgetAgente({fieldLabel: 'Agente',
                                            linkImpoExpo: "<?= constantes::IMPO ?>",
                                            linkListarTodos: "all",
                                            id:"Agente",
                                            hiddenName:"idagente",
                                            width:300,
                                            value:"<?= $agente ?>",
                                            hiddenValue:"<?= $idagente ?>"
                                        }),
                                        new WidgetLinea({fieldLabel: 'Naviera',
                                            linkTransporte: "transporte",
                                            name:"linea",
                                            id:"linea",
                                            hiddenName: "idlinea",
                                            value:"<?= $idlinea ?>",
                                            width:300
                                        }),
                                        new WidgetMultiIncoterms({title: 'Terminos',
                                            fieldLabel:"Incoterms",
                                            id: 'incoterms',
                                            name: 'incoterms[]',
                                            width:230,
                                            value:'<?= implode(",", $incoterms) ?>'
                                        })
                                    ]
                                },
                                {
                                    columnWidth:0.5,
                                    border:false,
                                    items:
                                        [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?= $fechafinal ?>'
                                        },
                                        new WidgetModalidad({fieldLabel: 'Modalidad',
                                            id: 'modalidad',
                                            hiddenName: "idmodalidad",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $idmodalidad ?>"
                                        }),
                                        new WidgetCiudad({fieldLabel: 'origen',
                                            id: 'origen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            tipo:"3",
                                            traficoParent:"pais_origen",
                                            impoexpo: "impoexpo",
                                            value:"<?= $origen ?>",
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        new WidgetCiudad({fieldLabel: 'destino',
                                            id: 'destino',
                                            idciudad:"destino",
                                            hiddenName:"iddestino",
                                            tipo:"3",
                                            traficoParent:"pais_destino",
                                            impoexpo: "impoexpo",
                                            value:"<?= $destino ?>",
                                            hiddenValue:"<?= $iddestino ?>"
                                        }),
                                        new WidgetSucursales({fieldLabel: 'Sucursal',
                                            id:"Sucursal",
                                            hiddenName:"sucursal",
                                            width:120,
                                            value:"<?= $sucursal ?>",
                                            hiddenValue:"<?= $sucursal ?>"
                                        }),
                                        new WidgetDeptos({fieldLabel: 'Departamento',
                                            id:"departamento",
                                            hiddenName:"departamento",
                                            width:150,
                                            value:"<?= $departamento ?>",
                                            hiddenValue:"<?= $departamento ?>"
                                        }),
                                        new WidgetUsuario({fieldLabel: 'Usuario',
                                            id:"usuenvio",
                                            hiddenName:"usuenvio",
                                            width:250,
                                            value:"<?= $nomoperativo ?>",
                                            hiddenValue:"<?= $usuenvio ?>"
                                        })
                                    ]
                                }
                            ]
                        }
                    ]
                }]
        },
        buttons: [
            {
                text: 'Continuar',
                handler: function(){
                    var tp = Ext.getCmp("tab-panel");                    
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="estadisticas"){
                        owner.getForm().getEl().dom.action='<?= url_for("reportesGer/reporteCargaOperativa") ?>';
                    }                    
                    //alert(Ext.getCmp("incoterms").getValue());
                    owner.getForm().submit();
                }
            }],
        listeners:{afterrender:function(){

                linea_sel='<?= $linea ?>';
                idlinea_sel='<?= $idlinea ?>';
                if(linea_sel!="")
                {
                    Ext.getCmp("linea").setValue(idlinea_sel);
                    $("#linea").val(linea_sel);

                }

                agente_sel='<?= $agente ?>';
                idagente_sel='<?= $idagente ?>';
                if(agente_sel!="")
                {
                    Ext.getCmp("agente").setValue(idagente_sel);
                    $("#agente").val(agente_sel);
                }

                suc_agente_sel='<?= $sucursalagente ?>';
                idsucagente_sel='<?= $idsucursalagente ?>';
                if(suc_agente_sel!="")
                {
                    Ext.getCmp("sucursalagente").setValue(idsucagente_sel);
                    $("#sucursalagente").val(suc_agente_sel);
                }
        
            }

        }
    });
    tabs.render("container");
</script>

<?
if ($opcion) {
?>

    <div align="center">
        <br>
        <h3>Estad&iacute;sticas de Carga Operativa <br>
        <?
        if ($fechainicial && $fechafinal) {
            echo " fechas de Creacion referencia: " . $fechainicial . " - " . $fechafinal;
        }
        if ($fechaembinicial && $fechaembfinal) {
            echo " fechas de Embarque: " . $fechaembinicial . " - " . $fechaembfinal;
        }
        if ($fechaarrinicial && $fechaarrfinal) {
            echo " fechas de Arribo: " . $fechaarrinicial . " - " . $fechaarrfinal;
        }
        if ($idmodalidad) {
            echo " modalidad: " . $idmodalidad . " - ";
        }
        if ($origen) {
            echo " origen: " . $origen . " - ";
        }
        if ($destino) {
            echo " destino: " . $destino . " - ";
        }
        if ($usuenvio) {
            echo " Operativo: " . $usuenvio . " - ";
        }
        if ($incoterms) {
            echo "<br>Incoterms: " . implode(",", $incoterms) . " - ";
        }
        ?>
    </h3>
    <br />
    <br />
</div>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr>
        <td>A&ntilde;o</td>
        <td>Mes</td>
        <td>No</td>
        <td>Reporte</td>
        <td>Fecha<br>Reporte</td>
        <td colspan="2">Origen</td>
        <td colspan="2">Destino</td>
        <td>Transporte</td>
        <td>Modalidad</td>
        <td>Referencia</td>
        <td>No.Negocios</td>
        <td>Sucursal</td>
        <td colspan="2">Comunicaciones</td>
        <td colspan="2">Facturaci&oacute;n</td>
    </tr>
    <?
        $nitem = 1;
        $ano_mem = "";
        $mes_mem = "";
        $idcliente = 0;

        $ano_sub = 0;
        $mes_sub = 0;

        $cliente_tot = array();
        $reporte_tot = array();
        $operativo_tot = array();
        $comunicaciones_tot = array();
        $facturacion_tot = array();

        foreach ($resul as $r) {

            if (($r["ca_ano"] != $ano_mem and $ano_mem != "") or ($r["ca_mes"] != $mes_mem and $mes_mem != "") or ($r["ca_idcliente"] != $idcliente and $idcliente != 0)) {
                $reporte_tot[$ano_mem][$mes_mem]["cant_reportes"]+= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_reportes"];
                $reporte_tot[$ano_mem][$mes_mem]["cant_negocios"]+= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_negocios"];
                $reporte_tot[$ano_mem][$mes_mem]["cant_emails"]+= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_emails"];
                $reporte_tot[$ano_mem][$mes_mem]["cant_facturas"]+= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_facturas"];
    ?>
                <tr>
                    <td colspan="9" align="right"><b>Totales&nbsp;:</b></td>
                    <td colspan="1" align="right"><b>Reportes&nbsp;:</b></td>
                    <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_reportes"] ?></b></td>
                    <td colspan="1" align="right"><b>Negocios&nbsp;:</b></td>
                    <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_negocios"] ?></b></td>
                    <td colspan="2" align="right"><b>Comunicaciones&nbsp;:</b></td>
                    <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_emails"] ?></b></td>
                    <td colspan="1" align="right"><b>Facturas&nbsp;:</b></td>
                    <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_facturas"] ?></b></td>
                </tr>
    <?
            }

            if ($r["ca_ano"] != $ano_mem) {
                $ano_mem = $r["ca_ano"];
                $ano_tot+= $ano_sub;
                $ano_sub = 0;
    ?>
                <tr>
                    <td><b><?= $ano_mem ?></b></td>
                    <td colspan="17"></td>
                </tr>
    <?
            }

            if ($r["ca_mes"] != $mes_mem) {

                if ($mes_mem != ''){
    ?>
                <tr>
                    <td colspan="9" align="right"><b>Totales&nbsp;mes&nbsp;<?= Utils::mesLargo( $mes_mem ) ?>:</b></td>
                    <td colspan="1" align="right"><b>Reportes&nbsp;:</b></td>
                    <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_reportes"] ?></b></td>
                    <td colspan="1" align="right"><b>Negocios&nbsp;:</b></td>
                    <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_negocios"] ?></b></td>
                    <td colspan="2" align="right"><b>Comunicaciones&nbsp;:</b></td>
                    <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_emails"] ?></b></td>
                    <td colspan="1" align="right"><b>Facturas&nbsp;:</b></td>
                    <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_facturas"] ?></b></td>
                </tr>
    <?
                }
                $mes_mem = $r["ca_mes"];
                $mes_tot+= $mes_sub;
                $mes_sub = 0;
    ?>
                <tr>
                    <td></td>
                    <td colspan="2"><b><?= Utils::mesLargo( $mes_mem ) ?></b></td>
                    <td colspan="15"></td>
                </tr>
    <?
            }

            if ($r["ca_idcliente"] != $idcliente) {
    ?>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="16"><b><?= $r["ca_compania"] ?></b></td>
                </tr>
    <?
                $idcliente = $r["ca_idcliente"];
                $consecutivo = "";
            }

            if($r["ca_consecutivo"] != $consecutivo){
                $imp_rep = true;
                $consecutivo = $r["ca_consecutivo"];
            }

            if($imp_rep){
    ?>
                <tr>
                    <td colspan="2"></td>
                    <td><?= $nitem++ ?></td>
                    <td><?= $r["ca_consecutivo"] ?></td>
                    <td><?= $r["ca_fchreporte"] ?></td>
                    <td><?= $r["ca_traorigen"] ?></td>
                    <td><?= $r["ca_ciuorigen"] ?></td>
                    <td><?= $r["ca_tradestino"] ?></td>
                    <td><?= $r["ca_ciudestino"] ?></td>
                    <td><?= $r["ca_transporte"] ?></td>
                    <td><?= $r["ca_modalidad"] ?></td>
                    <td><?= $r["ca_referencia"] ?></td>
                    <td><?= $r["ca_cant_negocios"] ?></td>
                    <td><?= $r["ca_sucursal"] ?></td>

    <?
                $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_reportes"]+= 1;
                $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_negocios"]+= $r["ca_cant_negocios"];
                $array_usuarios = array();
                $imp_rep = false;
                $first_time = true;
            }else{
    ?>
                <tr>
                    <td colspan="14"></td>
    <?
            }
    ?>
                    <td><?= $r["ca_usuenvio"] ?></td>
                    <td><?= $r["ca_cant_emails"] ?></td>
                    <?
                        $array_facturas = array();
                        if ($r["ca_transporte"] == "Aéreo"){
                            $array_facturas = InoClientesAirTable::facturasPorReporte($r["ca_referencia"], $r["ca_idcliente"], $r["ca_consecutivo"], $usuenvio);
                        }else if ($r["ca_transporte"] == "Marítimo"){
                            $array_facturas = InoClientesSeaTable::facturasPorReporte($r["ca_referencia"], $r["ca_idcliente"], $r["ca_consecutivo"], $usuenvio);
                        }

                        if (count($array_facturas) != 0){
                            // $multiples = (count($array_facturas)>1)?true:false;

                            foreach($array_facturas as $factura){
                                if (!in_array($factura[0], $array_usuarios)){

                                    if ($first_time){
                                        ?>
                                            <td><?= $factura[0] ?></td>
                                            <td><?= $factura[1] ?></td>
                                        <?
                                        $first_time = false;
                                    }else {
                                        ?>
                                        <tr>
                                            <td colspan="16"></td>
                                            <td><?= $factura[0] ?></td>
                                            <td><?= $factura[1] ?></td>
                                        </tr>
                                        <?
                                    }

                                    $array_usuarios[] = $factura[0];
                                    $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_facturas"]+= $factura[1];
                                    $operativo_tot["Facturas"][$r["ca_nomoperativo"]][$r["ca_traorigen"]][$r["ca_transporte"]][$r["ca_modalidad"]]+= $factura[1];
                                }
                            }
                        }else{
                            ?>
                                <td></td>
                                <td></td>
                            <?
                        }

                    ?>
            </tr>
    <?
            $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_emails"]+= $r["ca_cant_emails"];
            $operativo_tot["Comunicaciones"][$r["ca_nomoperativo"]][$r["ca_traorigen"]][$r["ca_transporte"]][$r["ca_modalidad"]]+= $r["ca_cant_emails"];
        }
    ?>
        <tr>
            <td colspan="9" align="right"><b>Totales&nbsp;:</b></td>
            <td colspan="1" align="right"><b>Reportes&nbsp;:</b></td>
            <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_reportes"] ?></b></td>
            <td colspan="1" align="right"><b>Negocios&nbsp;:</b></td>
            <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_negocios"] ?></b></td>
            <td colspan="2" align="right"><b>Comunicaciones&nbsp;:</b></td>
            <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_emails"] ?></b></td>
            <td colspan="1" align="right"><b>Facturas&nbsp;:</b></td>
            <td><b><?= $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_facturas"] ?></b></td>
        </tr>
        <tr>
            <td colspan="9" align="right"><b>Totales&nbsp;mes&nbsp;<?= Utils::mesLargo( $mes_mem ) ?>:</b></td>
            <td colspan="1" align="right"><b>Reportes&nbsp;:</b></td>
            <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_reportes"] ?></b></td>
            <td colspan="1" align="right"><b>Negocios&nbsp;:</b></td>
            <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_negocios"] ?></b></td>
            <td colspan="2" align="right"><b>Comunicaciones&nbsp;:</b></td>
            <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_emails"] ?></b></td>
            <td colspan="1" align="right"><b>Facturas&nbsp;:</b></td>
            <td><b><?= $reporte_tot[$ano_mem][$mes_mem]["cant_facturas"] ?></b></td>
        </tr>
    </table>
    <br />
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr>
<?
    foreach($operativo_tot as $reg_key => $registros){
        $sub_com = 0;
        $tot_com = 0;
        ?>
        <td valign="top">
            <table class="tableList" width="450px" border="1" id="subTable" align="center">
            <tr>
                <td><b>Operativo</b></td>
                <td><b>Tr&aacute;fico</b></td>
                <td><b>Transporte</b></td>
                <td><b>Modalidad</b></td>
                <td><b><?= $reg_key ?></b></td>
            </tr>
        <?
        foreach($registros as $ope_key => $operativos){
            ?>
                <tr>
                <td colspan="5"><b><?= $ope_key ?></b></td>
                </tr>
            <?
            foreach($operativos as $tra_key => $traficos){
                ?>
                    <tr>
                    <td colspan="1"></td>
                    <td colspan="4"><b><?= $tra_key ?></b></td>
                    </tr>
                <?
                foreach($traficos as $tns_key => $transportes){
                    ?>
                        <tr>
                        <td colspan="2"></td>
                        <td colspan="3"><b><?= $tns_key ?></b></td>
                        </tr>
                    <?
                    foreach($transportes as $mod_key => $modalidad){
                        ?>
                            <tr>
                                <td colspan="3"></td>
                                <td><?= $mod_key ?></td>
                                <td><?= $modalidad ?></td>
                            </tr>
                        <?
                        $sub_com+= $modalidad;
                    }
                }
            }
            ?>
                <tr>
                <td colspan="4" align="right"><b>Total  <?= $reg_key." ".$ope_key ?></b></td>
                <td colspan="1"><b><?= $sub_com ?></b></td>
                </tr>
            <?
            $tot_com+= $sub_com;
            $sub_com = 0;
        }
        ?>
            <tr>
            <td colspan="4" align="right"><b>GRAN TOTAL</b></td>
            <td colspan="1"><b><?= $tot_com ?></b></td>
            </tr>
            </table>
        </td>
        <?
    }
}
?>
    </tr>
</table>

    <script>
        //Ext.getCmp('incoterms').mode="local";
        //Ext.getCmp('incoterms').onStoreLoad();
        //Ext.getCmp('incoterms').setValue('<?= implode(",", $incoterms) ?>');
        //Ext.getCmp('incoterms').setValue('<?= implode(",", $incoterms) ?>');</script>