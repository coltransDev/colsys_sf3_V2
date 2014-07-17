<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("inoReportes", "filtrosEstadisticasOtm");
$resul = $sf_data->getRaw("resul");
$comerciales = array();
?>
<div align="center" id="container" ></div>
<?
if ($opcion) {
    if (count($resul) <= 0) {
        ?>  
        <div align="center"><br />
            <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><? echo "NO EXISTEN DATOS QUE CUMPLAN CON ESTOS CRITERIOS" ?></div>
        </div><br />
        <?
    } else {
        ?>
        <div align= "center" style="margin: 10px;">
            <input class="bigbuttonmin" type="submit" value="Contraer Todos" onclick="ocultar()"/> 
            <input class="bigbuttonmin" type="submit" value="Expandir Todos" onclick="mostrarTodos()"/>         
        </div>
        <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Tabla de Datos" onclick="mostrar('datos')"/></div>
        <div id="datos">
            <table style="font-size: 10" width="95%" border="1" class="tableList" align="center">
                <tr>
                    <th>AÑO</th>
                    <th>MES</th>
                    <th>REFERENCIA</th>
                    <th>REPORTE</th>
                    <th>COMPANIA</th>
                    <th>MODALIDAD</th>
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
                    <? if ($nempresa == 2) { ?>
                        <th>IMPORTADOR</th>
                        <th>BODEGA</th>
                    <? } else { ?>                    
                        <th>COMERCIAL</th>
                        <th>SUCURSAL</th>
                    <? } ?>
                </tr>
                <?
                foreach ($resul as $r) {
                    $comerciales[$r["ca_vendedor"]][$r["ano"]][$r["mes"]] ++;
                    $sucursales[$r["ca_sucursal"]][$r["ano"]][$r["mes"]] ++;
                    $clientes[$r["ca_compania"]][$r["ano"]][$r["mes"]] ++;

                    $nhijas+=$r["numhijas"];
                    $pesoTotal+=$r["peso"];
                    $volumenTotal+=$r["volumen"];

                    if ($r["modalidad"] == "LCL")
                        $porcentajeContenedor+=($r["peso"] / 25000);
                    
                    echo '<tr>';
                    echo '<td>' . $r["ano"] . '</td>';
                    echo '<td>' . $r["mes"] . '</td>';
                    echo '<td> <a href="/ino/verReferencia/modo/5/idmaster/' . $r["ca_idmaster"] . '" target="_blank">' . $r["referencia"] . '</a></td>';
                    echo '<td> <a href="/reportesNeg/consultaReporte/modo/Mar%EDtimo/impoexpo/Importaci%F3n/id/' . $r["idreporte"] . '" target="_blank">' . $r["no_reporte"] . '</a></td>';
                    echo '<td>' . $r["ca_compania"] . '</td>';
                    echo '<td>' . $r["modalidad"] . '</td>';
                    echo '<td>' . $r["doctransporte"] . '</td>';
                    echo '<td>' . $r["origen"] . '</td>';
                    echo '<td>' . $r["destino"] . '</td>';
                    echo '<td>' . $r["transportador"] . '</td>';
                    echo '<td class="numeros">' . $r["numhijas"] . '</td>';
                    echo '<td class="numeros">' . $r["peso"] . '</td>';
                    echo '<td class="numeros">' . $r["numpiezas"] . '</td>';
                    echo '<td class="numeros">' . $r["volumen"] . '</td>';
                    if ($r["modalidad"] == "FCL" || $r["modalidad"] == "DIRECTO")
                        echo '<td class="numeros">' . $r["contenedor"] . '</td>';
                    else if ($r["modalidad"] == "LCL")
                        echo '<td class="numeros">' . ($r["peso"] / 25000) . '</td>';
                    else
                        echo '<td></td>';
                    echo '<td class="numeros">' . $r["valorfob"] . '</td>';
                    echo '<td>' . $r["dtm"] . '</td>';
                    if ($nempresa == 2) {
                        echo '<td>' . $r["importador"] . '</td>';
                        echo '<td>' . $r["ca_bodega"] . '</td>';
                    } else {
                        echo '<td>' . $r["ca_vendedor"] . '</td>';
                        echo '<td>' . $r["ca_sucursal"] . '</td>';
                    }
                    
                    echo '</tr>';                    
                }
                ?>
                <tr><th colspan="19" style="text-align: center"># HIJAS: <?=$nhijas?> CONTENEDOR LCL: <?=$porcentajeContenedor?></th></tr>'
            </table>
        </div>
        <?
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
    }
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
                        owner.getForm().getEl().dom.action = '<?= url_for("inoReportes/estadisticasOtm") ?>';
                    }
                    owner.getForm().submit();
                }
            }]
    });
    tabs.render("container");

    function ocultar() {
        document.getElementById('datos').style.display = 'none';
        document.getElementById('por_comercial').style.display = 'none';
        document.getElementById('por_sucursal').style.display = 'none';
        document.getElementById('por_cliente').style.display = 'none';
    }

    function mostrar(id) {
        document.getElementById(id).style.display = 'inline';
    }

    function mostrarTodos() {
        document.getElementById('datos').style.display = 'inline';
        document.getElementById('por_comercial').style.display = 'inline';
        document.getElementById('por_sucursal').style.display = 'inline';
        document.getElementById('por_cliente').style.display = 'inline';
    }

    window.onload = function() {
        ocultar();
    }

</script>