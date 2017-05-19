<?php
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetMultiIncoterms");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetUsuario");
include_component("widgets", "widgetDeptos");
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU101"));
// Grafica
include_component("charts","column");
// Variables
$cliente = $sf_data->getRaw("cliente");
$agente = $sf_data->getRaw("agente");
$idagente = $sf_data->getRaw("idagente");
$idsucursalagente = $sf_data->getRaw("idsucursalagente");
$linea = $sf_data->getRaw("linea");
$sucursalagente = $sf_data->getRaw("sucursalagente");
$sucursal = $sf_data->getRaw("sucursal");
$idDepartamento = $sf_data->getRaw("idDepartamento");
$idUsuenvio = $sf_data->getRaw("idUsuenvio");
$incoterms = $sf_data->getRaw("incoterms");
$tipoInforme = $sf_data->getRaw("tipoInforme");
$resul = $sf_data->getRaw("resul");

$serieX = array();
$dataJSON = array();
$clieJSON = array();
$ejeX = array();
$cliente_tot = array();

$tit_mem="";
$tit_cli="";
?>

<div id="filtros" align="center">
    <br />
    <h3> Reporte de Carga Operativa </h3>
    <br />
</div>

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
                                            value:'<?=$incoterms?implode(",", $incoterms):"" ?>'
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
                                            id: 'idOrigen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            tipo:"3",
                                            traficoParent:"pais_origen",
                                            impoexpo: "impoexpo",
                                            value:"<?= $origen ?>",
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        new WidgetCiudad({fieldLabel: 'destino',
                                            id: 'idDestino',
                                            idciudad:"destino",
                                            hiddenName:"iddestino",
                                            tipo:"3",
                                            traficoParent:"pais_destino",
                                            impoexpo: "impoexpo",
                                            value:"<?= $destino ?>",
                                            hiddenValue:"<?= $iddestino ?>"
                                        }),
                                        new WidgetSucursales({fieldLabel: 'Sucursal',
                                            id:"idSucursal",
                                            hiddenName:"sucursal",
                                            width:120,
                                            value:"<?= $idSucursal ?>",
                                            hiddenValue:"<?= $sucursal ?>"
                                        }),
                                        new WidgetDeptos({fieldLabel: 'Departamento',
                                            id:"idDepartamento",
                                            hiddenName:"departamento",
                                            width:150,
                                            value:"<?= $idDepartamento ?>",
                                            hiddenValue:"<?= $idDepartamento ?>"
                                        }),
                                        new WidgetUsuario({fieldLabel: 'Usuario',
                                            id:"idUsuenvio",
                                            hiddenName:"usuenvio",
                                            width:250,
                                            value:"<?= $idUsuenvio ?>",
                                            hiddenValue:"<?= $usuenvio ?>"
                                        }),
                                        new WidgetParametros({fieldLabel: 'Tipo/Informe',
                                            id:'idTipoInforme',
                                            name:'tipoInforme',
                                            caso_uso:"CU101",
                                            width:200,
                                            value:"<?= $tipoInforme ?>",
                                            hiddenValue:"<?= $tipoInforme ?>",
                                            allowBlank:false
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
    tabs.render("filtros");
</script>

<?
if ($opcion and $tipoInforme != "") {
?>

    <div align="center">
        <br>
        <h3>Estad&iacute;sticas de Carga Operativa <br>
            Informe : <?=$tipoInforme?> <br>
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
        if (strlen(implode(",", $incoterms))!=0) {
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
        $operativo_sub = array();
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
                $tit_tmp = $r["ca_compania"];
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
                            $array_facturas = InoClientesAirTable::facturasPorReporte($r["ca_referencia"], $r["ca_idcliente"], $r["ca_consecutivo"], $usuenvio, $fechainicial, $fechafinal);
                        }else if ($r["ca_transporte"] == "Marítimo"){
                            $array_facturas = InoClientesSeaTable::facturasPorReporte($r["ca_referencia"], $r["ca_idcliente"], $r["ca_consecutivo"], $usuenvio, $fechainicial, $fechafinal);
                        }

                        if (count($array_facturas) != 0 and ($tipoInforme == "Volumen de Trabajo" or $tipoInforme == "Negocios nuevos")){
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

                                    $array_usuarios[] = $factura[2];
                                    $cliente_tot[$idcliente][$ano_mem][$mes_mem]["cant_facturas"]+= $factura[1];
                                    $operativo_sub["Facturas"][$ano_mem][Utils::mesLargo ($mes_mem)]+= $factura[1];
                                    $operativo_tot["Facturas"][$factura[2]][$r["ca_traorigen"]][$r["ca_transporte"]][$r["ca_modalidad"]]+= $factura[1];

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
            $operativo_sub["Comunicaciones"][$ano_mem][Utils::mesLargo ($mes_mem)]+= $r["ca_cant_emails"];
            $operativo_tot["Comunicaciones"][utf8_encode($r["ca_nomoperativo"])][$r["ca_traorigen"]][$r["ca_transporte"]][$r["ca_modalidad"]]+= $r["ca_cant_emails"];
            if(!in_array(Utils::mesLargo ($mes_mem)."-".$ano_mem, $mesesX)){
                $mesesX[]=Utils::mesLargo ($mes_mem)."-".$ano_mem;
            }
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
    $data = array();
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
                        if(!in_array($ope_key, $serieX)){
                            $serieX[]=$ope_key;
                            $data[$reg_key][$ope_key]+= $modalidad;
                        }
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


<?
if (count($cliente_tot) == 1){
    $tit_cli = "Gráfica por Cliente - ".$tit_tmp;
    $dataC = array();
    foreach($cliente_tot as $cli_tit => $ano_dat){
        foreach($ano_dat as $ano_tit => $mes_dat) {
            foreach ($mes_dat as $mes_tit => $dat_dat){
                $mes_temp = Utils::mesLargo ($mes_tit)."-".$ano_tit;
                if(!in_array($mes_temp, $ejeX)){
                    $ejeX[]=$mes_temp;
                }
                $dataC["Reportes"][] = ($dat_dat["cant_reportes"])?($dat_dat["cant_reportes"]):0;
                $dataC["Negocios"][] = ($dat_dat["cant_negocios"])?($dat_dat["cant_negocios"]):0;
                $dataC["Facturas"][] = ($dat_dat["cant_facturas"])?($dat_dat["cant_facturas"]):0;
                $dataC["Comunicaciones"][] = ($dat_dat["cant_emails"])?($dat_dat["cant_emails"]):0;
            }
        }
    }
    $clieJSON[] = array("name" => "Reportes", "data" => $dataC["Reportes"]);
    $clieJSON[] = array("name" => "Negocios", "data" => $dataC["Negocios"]);
    $clieJSON[] = array("name" => "Facturas", "data" => $dataC["Facturas"]);
    $clieJSON[] = array("name" => "Comunicaciones", "data" => $dataC["Comunicaciones"]);
}

if (count($serieX) > 1){
    $tit_mem = "Carga Operativa - ".$tipoInforme;
    $dataN = $dataX = array();

    foreach($operativo_tot as $reg_key => $registros){
        foreach($registros as $ope_key => $operativos){
            foreach($operativos as $tra_key => $traficos){
                foreach($traficos as $tns_key => $transportes){
                    foreach($transportes as $mod_key => $modalidad){
                        $dataN[$reg_key][$ope_key]+= $modalidad;
                    }
                }
            }
        }
    }
    foreach($dataN as $modalidad => $usuario){
        foreach($serieX as $serie){
            $dataX[$modalidad][] = ($usuario[$serie])?($usuario[$serie]):0;
        }
    }

    $serieM=$serieX;
    $dataJSON[] = array("name" => "Comunicaciones", "data" => $dataX["Comunicaciones"]);
    $dataJSON[] = array("name" => "Facturas", "data" => $dataX["Facturas"]);
}else if (count($serieX) == 1){
    $tit_mem = "Gráfica por Funcionario - ".$tipoInforme." - ".$serieX[0];
    $dataN = array();
    foreach($operativo_sub as $modalidad => $usuario){
        foreach($mesesX as $mes){
            list($mes_mem, $ano_mem) = explode("-",$mes);
            $dataN[$modalidad][] = ($usuario[$ano_mem][$mes_mem])?($usuario[$ano_mem][$mes_mem]):0;
        }
    }
    $serieM=$serieX=$mesesX;
    $dataJSON[] = array("name" => "Comunicaciones", "data" => $dataN["Comunicaciones"]);
    $dataJSON[] = array("name" => "Facturas", "data" => $dataN["Facturas"]);
}
?>

<table align="center" width="90%">
    <?if ($tipoInforme != "") {?>
        <tr>
            <td style=" margin: 0 auto" >
                <div align="center" id="grafica1" ></div>
            </td>
        </tr>
        <?if (count($cliente_tot) == 1) {?>
            <tr>
                <td style=" margin: 0 auto" >
                    <div align="center" id="grafica2" ></div>
                </td>
            </tr>
    <?  }
    }
    ?>
</table>
<script type="text/javascript">
    var chart1;
    var chart2;
    chart1=new ChartsColumn({
        renderTo: 'grafica1',
        height: 600,
        title:"<?= $tit_mem ?>",
        titleY:"Cantidad",
        xRotation: -30,
        plotBands: [
            {
                color: 'red',
                width: 2,
                value: 'Comunicaciones',
                label: {
                    text: 'Envío de Comunicaciones',
                    style: {
                        color: 'red',
                        fontWeight: 'bold'
                    }
                }
            }
            ,
            {
                color: 'blue',
                width: 2,
                value: 'Facturacion',
                label: {
                    text: 'Elaboración de Facturas',
                    style: {
                        color: 'blue',
                        fontWeight: 'bold'
                    }
                }
            }
        ],
        serieX: <?= json_encode($serieX) ?>,
        series: <?= json_encode($dataJSON) ?>
    });

    chart2=new ChartsColumn({
        renderTo: 'grafica2',
        height: 600,
        title:"<?= $tit_cli ?>",
        titleY:"Cantidad",
        xRotation: -30,
        plotBands: [
            {
                color: 'red',
                width: 2,
                value: 'Reportes',
                label: {
                    text: 'Reportes de Negocio',
                    style: {
                        color: 'red',
                        fontWeight: 'bold'
                    }
                }
            }
            ,
            {
                color: 'blue',
                width: 2,
                value: 'Negocios',
                label: {
                    text: 'Número de Negocios',
                    style: {
                        color: 'blue',
                        fontWeight: 'bold'
                    }
                }
            }
            ,
            {
                color: 'green',
                width: 2,
                value: 'Facturas',
                label: {
                    text: 'Número de Facturas',
                    style: {
                        color: 'blue',
                        fontWeight: 'bold'
                    }
                }
            }
            ,
            {
                color: 'yellow',
                width: 2,
                value: 'Comunicaciones',
                label: {
                    text: 'Número de Comunicaciones',
                    style: {
                        color: 'blue',
                        fontWeight: 'bold'
                    }
                }
            }
        ],
        serieX: <?= json_encode($ejeX) ?>,
        series: <?= json_encode($clieJSON) ?>
    });

</script>