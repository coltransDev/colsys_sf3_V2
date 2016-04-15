<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("otm", "filtrosEstadisticasOtm");
$resul = $sf_data->getRaw("resul");
$datos = $sf_data->getRaw("datos");
$comerciales = array();
$serieX = array();
$hijas = array();
?>
<div align="center" id="container" class="esconder"></div>
<?
if ($opcion) {
    /*if (count($resul) <= 0) {
        ?>  
        <div align="center"><br />
            <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><? echo "NO EXISTEN DATOS QUE CUMPLAN CON ESTOS CRITERIOS" ?></div>
        </div><br />
        <?
    } else {
        ?>
        <div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
        <div align= "center" style="margin: 10px;">
            <input class="bigbuttonmin" id="button1" type="submit" value="Contraer Todos" onclick="ocultar()"/> 
            <input class="bigbuttonmin" id="button2" type="submit" value="Expandir Todos" onclick="mostrarTodos()"/>         
        </div>
        
        <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Tabla de Datos" onclick="mostrar('datos')"/></div>
        <div id="datos">
            <table style="font-size: 8" width="90%" border="1" class="tableList" align="center">
                <tr>
                    <th>AÑO</th>
                    <th>MES</th>                    
                    <th>FCH. ARRIBO</th>
                    <th>REFERENCIA</th>
                    <th>REPORTE</th>
                    <th>COMPANIA</th>
                    <th style="font-size: 6px;">MODALIDAD</th>
                    <th>DOC.TRANSPORTE</th>
                    <th>ORIGEN</th>
                    <th>DESTINO</th>
                    <th>TRANSPORTADOR</th>
                    <th># HIJAS</th>
                    <th>PESO</th>
                    <th>PIEZAS</th>
                    <th>VOLUMEN</th>
                    <th>CONTENEDOR</th>
                    <th>VALOR FOB</th>
                    <th>DTM</th>
                    <th>BODEGA</th>
                    <th>VEHICULO</th>
                    <th>IMPORTADOR</th>                        
                    <? if ($nempresa == 1) { ?>               
                        <th>SUCURSAL</th>
                    <? } ?>
                </tr>
                <?
                foreach ($resul as $r) {
                    $comerciales[$r["ca_vendedor"]][$r["ano"]][$r["mes"]] ++;
                    $sucursales[$r["ca_sucursal"]][$r["ano"]][$r["mes"]] ++;
                    $clientes[$r["ca_compania"]][$r["ano"]][$r["mes"]] ++;
                    $vehiculos[$r["ca_vehiculo"]][$r["ano"]][$r["mes"]] ++;
                    
                    echo '<tr>';
                    echo '<td>' . $r["ano"] . '</td>';
                    echo '<td>' . $r["mes"] . '</td>';                    
                    echo '<td>' . $r["ca_fcharribo"] . '</td>';
                    echo '<td> <a href="/ino/verReferencia/modo/5/idmaster/' . $r["ca_idmaster"] . '" target="_blank">' . $r["referencia"] . '</a></td>';
                    echo '<td class="numCenter"> <a href="/reportesNeg/consultaReporte/modo/Mar%EDtimo/impoexpo/Importaci%F3n/id/' . $r["idreporte"] . '" target="_blank">' . $r["no_reporte"] . '</a></td>';
                    echo '<td>' . $r["ca_compania"] . '</td>';
                    echo '<td>' . $r["modalidad"] . '</td>';
                    echo '<td>' . $r["doctransporte"] . '</td>';
                    echo '<td>' . $r["origen"] . '</td>';
                    echo '<td>' . $r["destino"] . '</td>';
                    echo '<td>' . $r["transportador"] . '</td>';
                    $numhijas = in_array($r["referencia"], $hijas)?"-":$r["numhijas"];
                    echo '<td class="numCenter">' . $numhijas . '</td>';
                    
                    echo '<td class="numCenter">' . $r["peso"] . '</td>';
                    echo '<td class="numCenter">' . $r["numpiezas"] . '</td>';
                    echo '<td class="numCenter">' . $r["volumen"] . '</td>';
                    if ($r["modalidad"] == "FCL" || $r["modalidad"] == "DIRECTO")
                        echo '<td class="numCenter">' . $r["contenedor"] . '</td>';
                    else if ($r["modalidad"] == "LCL")
                        echo '<td class="numCenter">' . ($r["peso"] / 25000) . '</td>';
                    else
                        echo '<td></td>';
                    echo '<td class="numCenter">' . $r["valorfob"] . '</td>';
                    echo '<td>' . $r["dtm"] . '</td>';                    
                    echo '<td>' . $r["ca_bodega"] . '</td>';
                    echo '<td>' . $r["ca_vehiculo"] . '</td>';
                    echo '<td>' . $r["ca_importador"] . '</td>';
                    if ($nempresa == 1)
                        echo '<td>' . $r["ca_sucursal"] . '</td>';                    
                    echo '</tr>';
                    
                    $hijas[$r["modalidad"]]["suma"]+=in_array($r["referencia"], $hijas)?0:$r["numhijas"];
                    $hijas[$r["referencia"]] = $r["referencia"];                    
                    $piezas[$r["modalidad"]]+=$r["numpiezas"];
                    $peso[$r["modalidad"]]+=$r["peso"];
                    $volumen[$r["modalidad"]]+=$r["volumen"];
                    $valorFOB[$r["modalidad"]]+=$r["valorfob"];
                    $modalidad[$r["modalidad"]]++;

                    if ($r["modalidad"] == "LCL")
                        $porcentajeContenedor+=($r["peso"] / 25000);
                }
                
                echo "<pre>";print_r($hijas); echo "</pre>";
                
                ?>
            </table>            
            <table class="tableList" align="center" width="30%">
                <tr>
                    <th colspan="4" style="text-align: center"><b>RESUMEN INFORME COLOTM</b></th>
                </tr>
                <tr>
                    <th colspan="1"><b>Fecha Creación:</b></th>
                    <td colspan="3"><?=date('Y-m-d H:i:s')?></td>
                </tr>
                <tr>
                    <th colspan="1"><b>Periodo:</b></th>
                    <td colspan="3"><b><?=$fechaInicial?></b> al <b><?=$fechaFinal?></b></td>
                </tr>
                <tr>
                    <th colspan="1"><b>TOTALES</b></th>
                    <th colspan="1" style="text-align: center;"><b>LCL</b></th>
                    <th colspan="1" style="text-align: center;"><b>FCL</b></th>
                    <th colspan="1" style="text-align: center;"><b>TODOS</b></th>
                </tr>
                <tr>
                    <th><b>Cantidad de Registros:</b></th>
                    <td style="text-align: right;"><b><?=$modalidad["LCL"]?></b></td>
                    <td style="text-align: right;"><b><?=$modalidad["FCL"]?></b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=array_sum($modalidad)?></b></font></td>
                </tr>
                <? if($empresa == 1){?>
                <tr>
                    <th><b>Número de Hijas:</b></th>
                    <td style="text-align: right;"><b><?=$hijas["LCL"]["suma"]?></b></td>
                    <td style="text-align: right;"><b><?=$hijas["FCL"]["suma"]?></b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=$hijas["LCL"]["suma"]+$hijas["FCL"]["suma"]?></b></font></td>
                </tr>
                <?}?>
                <tr>
                    <th><b>Piezas:</b></th>
                    <td style="text-align: right;"><b><?=$piezas["LCL"]?></b></td>
                    <td style="text-align: right;"><b><?=$piezas["FCL"]?></b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=round(array_sum($piezas),2)?></b></font></td>
                </tr>
                <tr>
                    <th><b>Peso:</b></th>
                    <td style="text-align: right;"><b><?=$peso["LCL"]?></b></td>
                    <td style="text-align: right;"><b><?=$peso["FCL"]?></b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=round(array_sum($peso),2)?></b></font></td>
                </tr>
                <tr>
                    <th><b>Volumen:</b></th>
                    <td style="text-align: right;"><b><?=$volumen["LCL"]?></b></td>
                    <td style="text-align: right;"><b><?=$volumen["FCL"]?></b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=round(array_sum($volumen),2)?></b></font></td>
                </tr>
                <tr>
                    <th><b>% Contenedor:</b></th>
                    <td style="text-align: right;"><b><?=round($porcentajeContenedor,2)?></b></td>
                    <td style="text-align: right;"><b>-</b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=round($porcentajeContenedor,2)?></b></font></td>
                </tr>
                <tr>
                    <th><b>Valor FOB:</b></th>
                    <td style="text-align: right;"><b><?=  number_format($valorFOB["LCL"],'0.00')?></b></td>
                    <td style="text-align: right;"><b><?=number_format($valorFOB["FCL"],'0.00')?></b></td>                    
                    <td style="text-align: right;"><font color="blue"><b><?=number_format(array_sum($valorFOB),'0.00')?></b></font></td>
                </tr>
                
            </table>
        </div>
        <?
        if($tipo!=2){
            foreach ($comerciales as $comercial => $gridAno) {
                foreach ($gridAno as $ano => $gridMes) {
                    foreach ($gridMes as $mes => $data) {
                        if (!in_array($mes, $serieX))                                
                            $serieX[] = $mes;
                    }
                }
            }

            sort($serieX);
            $nmeses = count($serieX);

            foreach ($comerciales as $key => $gridAno) {
                foreach ($gridAno as $ano => $gridMes) {
                    $criterio[$key]+= array_sum($gridMes);
                }
            }
            array_multisort($criterio, SORT_DESC, $comerciales);
            ?>
            <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Informe por Comercial" onclick="mostrar('por_comercial')"/></div>
            <div id="por_comercial">
                <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
                    <tr>
                        <th>COMERCIAL</th>
                        <th>ANO</th>
                        <?
                        foreach ($serieX as $k => $mes) {
                            echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                        }
                        ?>
                        <th>TOTAL</th>
                    </tr>
                    <?
                    foreach ($comerciales as $comercial => $gridAno) {
                        echo "<tr><td class='dinamica' rowspan='" . count($gridAno) . "'>$comercial</td>";
                        foreach ($gridAno as $ano => $gridMes) {
                            echo "<td >$ano</td>";
                            foreach ($serieX as $k => $mes) {
                                if ($gridMes[$mes] == '')
                                    echo "<td> </td>";
                                else
                                    echo "<td style ='text-align:center'>" . $gridMes[$mes] . "</td>";
                                $total[$comercial][$ano]+=$gridMes[$mes];
                            }
                            echo "<th style ='text-align:right'>" . $total[$comercial][$ano] . "</th>";
                            echo "</tr>";
                            $totalComercial[$comercial]+=$total[$comercial][$ano];
                        }
                        echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total $comercial</th><th style ='text-align:right'>" . $totalComercial[$comercial] . "</th></tr>";
                        $totalGnral+=$totalComercial[$comercial];
                    }
                    echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total General</th><th style ='text-align:right'>" . $totalGnral . "</th></tr>";
                    ?>
                </table>
            </div>
            <?
            $total = array();
            $totalGnral = 0;
            $criterio = array();

            foreach ($sucursales as $key => $gridAno) {
                foreach ($gridAno as $ano => $gridMes) {
                    $criterio[$key]+= array_sum($gridMes);
                }
            }
            array_multisort($criterio, SORT_DESC, $sucursales);
            ?>
            <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Informe por Sucursal" onclick="mostrar('por_sucursal')"/></div>
            <div id="por_sucursal">
                <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
                    <tr>
                        <th>SUCURSAL</th>
                        <th>ANO</th>
                        <?
                        foreach ($serieX as $k => $mes) {
                            echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                        }
                        ?>
                        <th>TOTAL</th>
                    </tr>
                    <?
                    foreach ($sucursales as $sucursal => $gridAno) {
                        echo "<tr><td class='dinamica' rowspan='" . count($gridAno) . "'>$sucursal</td>";
                        foreach ($gridAno as $ano => $gridMes) {
                            echo "<td >$ano</td>";
                            foreach ($serieX as $k => $mes) {
                                if ($gridMes[$mes] == '')
                                    echo "<td> </td>";
                                else
                                    echo "<td style ='text-align:center'>" . $gridMes[$mes] . "</td>";
                                $total[$sucursal][$ano]+=$gridMes[$mes];
                            }
                            echo "<th style ='text-align:right'>" . $total[$sucursal][$ano] . "</th>";
                            echo "</tr>";
                            $totalSucursal[$sucursal]+=$total[$sucursal][$ano];
                        }
                        echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total $sucursal</th><th style ='text-align:right'>" . $totalSucursal[$sucursal] . "</th></tr>";
                        $totalGnral+=$totalSucursal[$sucursal];
                    }
                    echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total General</th><th style ='text-align:right'>" . $totalGnral . "</th></tr>";
                    ?>
                </table>
            </div>
            <?
            $total = array();
            $totalGnral = 0;
            $criterio = array();

            foreach ($clientes as $key => $gridAno) {
                foreach ($gridAno as $ano => $gridMes) {
                    $criterio[$key]+= array_sum($gridMes);
                }
            }
            array_multisort($criterio, SORT_DESC, $clientes);
            ?>
            <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Informe por Cliente" onclick="mostrar('por_cliente')"/></div>
            <div id="por_cliente">
                <table style="font-size: 10" width="70%" border="1" class="tableList" align="center">
                    <tr>
                        <th>CLIENTES</th>
                        <th>ANO</th>
                        <?
                        foreach ($serieX as $k => $mes) {
                            echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                        }
                        ?>
                        <th>TOTAL</th>
                    </tr>
                    <?
                    foreach ($clientes as $cliente => $gridAno) {
                        echo "<tr><td class='dinamica' rowspan='" . count($gridAno) . "'>$cliente</td>";
                        foreach ($gridAno as $ano => $gridMes) {
                            echo "<td >$ano</td>";
                            foreach ($serieX as $k => $mes) {
                                if ($gridMes[$mes] == '')
                                    echo "<td> </td>";
                                else
                                    echo "<td style ='text-align:center'>" . $gridMes[$mes] . "</td>";
                                $total[$cliente][$ano]+=$gridMes[$mes];
                            }
                            echo "<th style ='text-align:right'>" . $total[$cliente][$ano] . "</th>";
                            echo "</tr>";
                            $totalSucursal[$cliente]+=$total[$cliente][$ano];
                        }
                        echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total $cliente</th><th style ='text-align:right'>" . $totalSucursal[$cliente] . "</th></tr>";
                        $totalGnral+=$totalSucursal[$cliente];
                    }
                    echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total General</th><th style ='text-align:right'>" . $totalGnral . "</th></tr>";
                    ?>
                </table>
            </div>
        <?
        $total = array();
        $totalGnral = 0;
        $criterio = array();

        foreach ($vehiculos as $key => $gridAno) {
            foreach ($gridAno as $ano => $gridMes) {
                $criterio[$key]+= array_sum($gridMes);
            }
        }
        array_multisort($criterio, SORT_DESC, $vehiculos);
        ?>
        <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Informe por Vehiculo" onclick="mostrar('por_vehiculo')"/></div>
        <div id="por_vehiculo">
            <table style="font-size: 10" width="70%" border="1" class="tableList" align="center">
                <tr>
                    <th>VEHICULO</th>
                    <th>ANO</th>
                    <?
                    foreach ($serieX as $k => $mes) {
                        echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                    }
                    ?>
                    <th>TOTAL</th>
                </tr>
                <?
                foreach ($vehiculos as $vehiculo => $gridAno) {
                    echo "<tr><td class='dinamica' rowspan='" . count($gridAno) . "'>$vehiculo</td>";
                    foreach ($gridAno as $ano => $gridMes) {
                        echo "<td >$ano</td>";
                        foreach ($serieX as $k => $mes) {
                            if ($gridMes[$mes] == '')
                                echo "<td> </td>";
                            else
                                echo "<td style ='text-align:center'>" . $gridMes[$mes] . "</td>";
                            $total[$vehiculo][$ano]+=$gridMes[$mes];
                        }
                        echo "<th style ='text-align:right'>" . $total[$vehiculo][$ano] . "</th>";
                        echo "</tr>";
                        $totalSucursal[$vehiculo]+=$total[$vehiculo][$ano];
                    }
                    echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total $vehiculo</th><th style ='text-align:right'>" . $totalSucursal[$vehiculo] . "</th></tr>";
                    $totalGnral+=$totalSucursal[$vehiculo];
                }
                echo "<tr><th colspan = '" . (2 + $nmeses) . "' style ='text-align:right'>Total General</th><th style ='text-align:right'>" . $totalGnral . "</th></tr>";
                ?>
            </table>
        </div>
        <?
        }
    }*/
}
?>
<script language="javascript">
    
    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border: true,
        fame: true,
        width: 800,
        standardSubmit: true,
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults: {autoHeight: true, bodyStyle: 'padding:10px'},
            id: 'tab-panel',
            items: [
                new FiltrosEstadisticasOtm()
            ]
        },
        buttons: [
            {
                text: 'Continuar',
                handler: function() {
                    var tp = Ext.getCmp("tab-panel");

                    var owner = Ext.getCmp("formPanel");
                    if (tp.getActiveTab().getId() == "estadisticas") {
                        owner.getForm().getEl().dom.action = '<?= url_for("otm/estadisticasOtm") ?>';
                    }
                    owner.getForm().submit();
                }
            }]
    });
    tabs.render("container");
    
    <?
    if($opcion){
        ?>    
        Ext.onReady(function() {
        
            this.filters = new Ext.ux.grid.GridFilters({
            // encode and local configuration options defined previously for easier reuse
            encode: false, // json encode the filter query
            local: true,   // defaults to false (remote filtering)
            filters: [{
                    type: 'date',
                    dataIndex: 'ca_fcharribo'
                }, {
                    type: 'string',
                    dataIndex: 'referencia'
                }, {
                    type: 'string',
                    dataIndex: 'no_reporte'
                },
                {
                    type: 'string',
                    dataIndex: 'modalidad'
                }]
            });

            this.columns = [
                {
                    header: "Año",
                    dataIndex: 'ano',
                    sortable: true,
                    width: 40
                }, {
                    header: "Mes",
                    dataIndex: 'mes',
                    sortable: true,
                    width: 20
                }, {
                    header: "Fch.Arribo",
                    dataIndex: 'ca_fcharribo',
                    sortable: true,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    width: 70
                }, {
                    header: "Referencia",
                    dataIndex: 'referencia',
                    sortable: true,
                    width: 100,
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idmaster = record.data.ca_idmaster;                    
                        myURL = '';                    
                        if (value !== '') {
                            myURL = '<a href="/ino/verReferencia/modo/5/idmaster/' + idmaster + '" target="_blank">' + value + '</a>';
                        }
                        return myURL;
                    }
                }, {
                    header: "Rep. Neg",
                    dataIndex: 'no_reporte',
                    sortable: true,
                    width: 70,
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idreporte = record.data.idreporte;                    
                        myURL = '';                    
                        if (value !== '') {
                            myURL = '<a href="/reportesNeg/consultaReporte/modo/Mar%EDtimo/impoexpo/Importaci%F3n/id/' + idreporte + '" target="_blank">' + value + '</a>';
                        }
                        return myURL;
                    }
                }, {
                    header: "Modalidad",
                    dataIndex: 'modalidad',
                    sortable: true,
                    width: 50
                }, {
                    header: "Origen",
                    dataIndex: 'origen',
                    sortable: true,                
                    width: 85
                }, {
                    header: "Destino",
                    dataIndex: 'destino',
                    sortable: true,
                    width: 85
                }, {
                    header: "Cliente",
                    dataIndex: 'ca_compania',
                    sortable: true,                
                    width: 85
                },  {
                    header: "Importador",
                    dataIndex: 'ca_importador',
                    sortable: true,                
                    width: 85
                }, {
                    header: "Doc. Transporte",
                    dataIndex: 'doctransporte',
                    sortable: true,
                    width: 100
                }, {
                    header: "Transportador",
                    dataIndex: 'transportador',
                    sortable: true,
                    width: 150
                }, {
                    header: "#Hijas",
                    dataIndex: 'numhijas',
                    sortable: true,
                    align: 'right',
                    summaryType: 'sum',
                    width: 45
                }, {
                    header: "Peso",
                    dataIndex: 'peso',
                    align: 'right',
                    sortable: true,
                    summaryType: 'sum',
                    width: 50
                }, {
                    header: "Vol.",
                    dataIndex: 'volumen',
                    align: 'right',
                    sortable: true,
                    summaryType: 'sum',
                    width: 50
                }, {
                    header: "Contenedor",
                    dataIndex: 'contenedor',
                    sortable: true,
                    align: 'right',
                    summaryType: 'sum',
                    width: 80
                }, {
                    header: "Valor Fob",
                    dataIndex: 'valorfob',
                    sortable: true,
                    summaryType: 'sum',
                    align: 'right',
                    renderer: Ext.util.Format.usMoney,
                    width: 85
                }, {
                    header: "Dtm",
                    dataIndex: 'dtm',
                    sortable: true,                
                    width: 85
                }, {
                    header: "Vendedor",
                    dataIndex: 'ca_vendedor',
                    sortable: true,                
                    width: 85
                }, {
                    header: "Sucursal",
                    dataIndex: 'ca_sucursal',
                    sortable: true,                
                    width: 85
                }, {
                    header: "Vehiculo",
                    dataIndex: 'ca_vehiculo',
                    sortable: true,                
                    width: 85
                }, {
                    header: "Bodega",
                    dataIndex: 'ca_bodega',
                    sortable: true,                
                    width: 85
                }
            ];

            this.record = Ext.data.Record.create([
                {name: 'ano', type: 'string'},
                {name: 'mes', type: 'string'},
                {name: 'ca_fcharribo', type: 'date'},
                {name: 'ca_idmaster', type: 'integer'},
                {name: 'referencia', type: 'string'},
                {name: 'idreporte', type: 'integer'},
                {name: 'no_reporte', type: 'string'},
                {name: 'modalidad', type: 'string'},
                {name: 'doctransporte', type: 'string'},
                {name: 'origen', type: 'string'},
                {name: 'destino', type: 'string'},
                {name: 'transportador', type: 'string'},
                {name: 'numhijas', type: 'integer'},
                {name: 'peso', type: 'integer'},
                {name: 'volumen', type: 'integer'},
                {name: 'contenedor', type: 'string'},
                {name: 'valorfob', type: 'float'},
                {name: 'dtm', type: 'string'},
                {name: 'ca_vendedor', type: 'string'},
                {name: 'ca_sucursal', type: 'string'},
                {name: 'ca_compania', type: 'string'},
                {name: 'ca_importador', type: 'string'},
                {name: 'ca_bodega', type: 'string'}
            ]);

            // define a custom summary function
            /*
             Ext.ux.grid.GroupSummary.Calculations['totalCaValor'] = function(v, record, field) {
             return v + (ca_valor);
             };*/

            this.store = new Ext.data.GroupingStore({
                autoLoad: true,
                proxy: new Ext.data.MemoryProxy(<?= json_encode(array("root" => $datos)) ?>),
                reader: new Ext.data.JsonReader(
                        {
                            root: 'root'
                        },
                this.record
                        ),
                sorters: [{
                    property: 'ca_fcharribo',
                    direction: 'ASC'
                }],
                groupField: 'ano'
            });

            this.summary = new Ext.ux.grid.GroupSummary();

            var gridDatos = new Ext.grid.EditorGridPanel({
                title: 'Comisiones Pendientes por Cobrar',
                autoHeight: "auto",
                width: 1800,
                id:'grid-result',
                bodyStyle: "pading: 5px",
                store: store,
                colModel: new Ext.grid.ColumnModel({
                    defaults: {
                        width: 120,
                        sortable: true
                    },
                    columns: columns
                }),
                plugins: [
                    this.summary,
                    this.filters
                ],
                tbar: [{
                    text: 'Exportar',
                    handler: function() {

                        /*changes=new Object();

                        data=Ext.getCmp("grid-result").getStore();//.getRange();
                        changes.group=Ext.getCmp("grid-result").getStore().groupField.keys;
                        changes.sort=Ext.getCmp("grid-result").getStore().sorters.keys;
                        changes.data=[];

                        /*Ext.each(data, function(key, value) {
                            changes.data[key]=value.data;
                        });
                        alert(JSON.stringify(changes));
                        //var store = grid.getStore();
                        Ext.iterate(data, function(key, value) {
                            alert('key=>'+key + '|value=>' + value);
                            //changes.data[key] = value;
                          });*/
        
                        var jsonArr = [];
                        Ext.getCmp("grid-result").getStore().each( function (model) {
                            jsonArr.push(model.data);
                        });
                        //alert(JSON.stringify(jsonArr));
                        //exit();
                        var str= JSON.stringify(jsonArr);
                        alert(str);
                        if(str.length>5)
                        {                        
                            $("#datos").val(str);
                            $("#formXls").submit();
                        }
                    }
                }],
                view: new Ext.grid.GroupingView({
                    forceFit: true,
                    showGroupName: false,
                    enableNoGroups: false,
                    enableGroupingMenu: false,
                    hideGroupedColumn: true
                })
            });
            gridDatos.render("main-panel");
        });
    <?
    }
    ?>

    /*function ocultar() {
        document.getElementById('datos').style.display = 'none';
        document.getElementById('por_comercial').style.display = 'none';
        document.getElementById('por_sucursal').style.display = 'none';
        document.getElementById('por_cliente').style.display = 'none';
        document.getElementById('por_vehiculo').style.display = 'none';
    }

    function mostrar(id) {
        document.getElementById(id).style.display = 'inline';
    }

    function mostrarTodos() {
        document.getElementById('datos').style.display = 'inline';
        document.getElementById('por_comercial').style.display = 'inline';
        document.getElementById('por_sucursal').style.display = 'inline';
        document.getElementById('por_cliente').style.display = 'inline';
        document.getElementById('por_vehiculo').style.display = 'inline';
    }
    
    
    function imprimir(){
        $(".esconder").hide();            
        document.getElementById('container').style.display = 'none';
        document.getElementById('button1').style.display = 'none';
        document.getElementById('button2').style.display = 'none';
        window.print();            
    }*/
    

    /*window.onload = function() {
        ocultar();
    }*/

</script>

<div class="content">    
    <div id="main-panel"></div>
</div>
<form id="formXls" name="formXls" action="<?= url_for("inoReportes/reporteadorXls") ?>" method="post">
    <input type="hidden" id="datos" name="datos">
</form>