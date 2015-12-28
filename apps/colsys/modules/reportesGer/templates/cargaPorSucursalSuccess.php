<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("reportesGer", "formMenuCargaPorSucursal");
$fcl = $sf_data->getRaw("fcl");
$lcl = $sf_data->getRaw("lcl");
$resul = $sf_data->getRaw("resul");

/* echo "<pre>";print_r($fcl);echo "</pre>";
  echo "<pre>";print_r($lcl);echo "</pre>"; */
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
            <table style="font-size: 10" width="70%" border="1" class="tableList" align="center">
                <tr><th colspan="12" style="text-align: center;">CARGA POR SUCURSAL</th></tr>
                <tr>
                    <th>AÑO</th>
                    <th>MES</th>
                    <th>TRAFICO ORIGEN</th>
                    <th>CIUDAD ORIGEN</th>
                    <th>MODALIDAD</th>
                    <th>REFERENCIA</th>
                    <th>HBLS</th>
                    <th>PROVEEDOR</th>
                    <th>COMPAÑIA</th>
                    <th>SUCURSAL</th>
                    <th>ESTADO</th>
                    <th>CMB</th>
                    <th>TEUS</th>
                </tr>

                <?
                foreach ($resul as $r) {
                    echo '<tr>';
                    echo '<td>' . $r["ca_ano"] . '</td>';
                    echo '<td>' . $r["ca_mes"] . '</td>';
                    echo '<td>' . $r["ca_traorigen"] . '</td>';
                    echo '<td>' . $r["ca_ciuorigen"] . '</td>';
                    echo '<td>' . $r["ca_modalidad"] . '</td>';
                    echo '<td> <a href="/colsys_php/inosea.php?boton=Consultar&id='. $r["ca_referencia"] . '" target="_blank">'. $r["ca_referencia"].'</a></td>';
                    echo '<td>' . $r["ca_hbls"] . '</td>';
                    echo '<td>' . $r["ca_nombre_pro"] . '</td>';
                    echo '<td>' . $r["ca_compania"] . '</td>';
                    echo '<td>' . $r["ca_sucursal"] . '</td>';
                    echo '<td>' . $r["ca_estado"] . '</td>';
                    echo '<td class="numeros">' . $r["ca_cbm"] . '</td>';
                    echo '<td class="numeros">' . $r["ca_teus"] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
        
        <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Operacion FCL" onclick="mostrar('fcl')"/></div>
        <div id="fcl">
            <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
                <tr>
                    <th style="text-align: center" colspan="20"><b>CARGA POR SUCURSAL <br />
                        OPERACIONES FCL <br />
                        <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>

                        </b></th>
                </tr>
                <tr style ="text-align:center;">
                    <th style="text-align:center;">SUCURSAL</th>
                    <th style="text-align:center;">ESTADO</th>
                    <th style="text-align:center;">TRAFICO ORIGEN</th>
                    <th style="text-align:center;">CIUDAD ORIGEN</th>
                    <th style="text-align:center;">COMPANIA</th>
                    <th style="text-align:center;">TEUS</th>
                    <th style="text-align:center;"># BLS</th>
                </tr>    
                <?
                foreach ($fcl as $sucursal => $gridSucursal) {            
                    foreach ($gridSucursal as $estado => $gridTrafico) {                
                        foreach ($gridTrafico as $traorigen => $gridCiuorigen) {                    
                            foreach ($gridCiuorigen as $ciuorigen => $gridCliente) {
                                $nfilas3[$sucursal][$estado][$traorigen][$ciuorigen] = count($gridCliente);

                                $ntotal[$sucursal]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                                $ntotal1[$sucursal][$estado]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                                $ntotal2[$sucursal][$estado][$traorigen]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                                $ntotal3[$sucursal][$estado][$traorigen][$ciuorigen]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                            }
                        }

                    }

                }
                ksort($fcl);
                foreach ($fcl as $sucursal => $gridSucursal) {
                    echo '<tr><td class="dinamica" rowspan="'.$ntotal[$sucursal].'" style="vertical-align: text-top;">'.$sucursal.'</td>';
                    ksort($gridSucursal);
                    foreach ($gridSucursal as $estado => $gridTrafico) {                
                        echo '<td rowspan="'.$ntotal1[$sucursal][$estado].'" style="vertical-align: text-top;">'.$estado.'</td>';
                        ksort($gridTrafico);
                        foreach ($gridTrafico as $traorigen => $gridCiuorigen) {
                            echo '<td rowspan="'.$ntotal2[$sucursal][$estado][$traorigen].'" style="vertical-align: text-top;">'.$traorigen.'</td>';
                            ksort($gridCiuorigen);
                            foreach ($gridCiuorigen as $ciuorigen => $gridCliente) {
                                echo '<td rowspan="'.$ntotal3[$sucursal][$estado][$traorigen][$ciuorigen].'" style="vertical-align: text-top;">'.$ciuorigen.'</td>';
                                ksort($gridCliente);
                                foreach ($gridCliente as $cliente => $gridData) {
                                    echo '<td >'.$cliente.'</td>';
                                    ksort($gridData);                        
                                    foreach ($gridData as $key => $data) {
                                        if(!$data)
                                            echo '<td></td>';
                                        else
                                            echo '<td class="numeros">'.$data.'</td>';
                                        $total[$sucursal][$key]+=$data;
                                    }
                                    echo "</tr>";
                                }
                            }                    
                        }                
                    }
                    echo '<tr><th style="text-align:right" colspan="5">Total '.$sucursal.'</th>'                   
                            . '<th style="text-align:right">'.$total[$sucursal]["teus"].'</th>'
                            . '<th style="text-align:right">'.$total[$sucursal]["hbls"].'</th>'
                            . '</tr>';
                }
                ?>
            </table>
        </div>
        <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Operacion LCL" onclick="mostrar('lcl')"/></div>
        <div id="lcl">
            <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
                <tr>
                    <th style="text-align: center" colspan="20"><b>CARGA POR SUCURSAL <br />
                        OPERACIONES LCL <br />
                        <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>

                        </b></th>
                </tr>
                <tr style ="text-align:center;">
                    <th style="text-align:center;">SUCURSAL</th>
                    <th style="text-align:center;">ESTADO</th>
                    <th style="text-align:center;">TRAFICO ORIGEN</th>
                    <th style="text-align:center;">CIUDAD ORIGEN</th>
                    <th style="text-align:center;">COMPANIA</th>
                    <th style="text-align:center;">CMB</th>
                    <th style="text-align:center;"># BLS</th>
                </tr>    
                <?

                foreach ($lcl as $sucursal => $gridSucursal) {            
                    foreach ($gridSucursal as $estado => $gridTrafico) {                
                        foreach ($gridTrafico as $traorigen => $gridCiuorigen) {                    
                            foreach ($gridCiuorigen as $ciuorigen => $gridCliente) {
                                $nfilas3[$sucursal][$estado][$traorigen][$ciuorigen] = count($gridCliente);

                                $ntot[$sucursal]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                                $ntot1[$sucursal][$estado]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                                $ntot2[$sucursal][$estado][$traorigen]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                                $ntot3[$sucursal][$estado][$traorigen][$ciuorigen]+=$nfilas3[$sucursal][$estado][$traorigen][$ciuorigen];
                            }
                        }

                    }

                }
                ksort($lcl);
                foreach ($lcl as $sucursal => $gridSucursal) {
                    echo '<tr><td class="dinamica" rowspan="'.$ntot[$sucursal].'">'.$sucursal.'</td>';
                    ksort($gridSucursal);
                    foreach ($gridSucursal as $estado => $gridTrafico) {                
                        echo '<td rowspan="'.$ntot1[$sucursal][$estado].'" style="vertical-align: text-top;">'.$estado.'</td>';
                        ksort($gridTrafico);
                        foreach ($gridTrafico as $traorigen => $gridCiuorigen) {
                            echo '<td rowspan="'.$ntot2[$sucursal][$estado][$traorigen].'" style="vertical-align: text-top;">'.$traorigen.'</td>';
                            ksort($gridCiuorigen);
                            foreach ($gridCiuorigen as $ciuorigen => $gridCliente) {
                                echo '<td rowspan="'.$ntot3[$sucursal][$estado][$traorigen][$ciuorigen].'" style="vertical-align: text-top;">'.$ciuorigen.'</td>';
                                ksort($gridCliente);
                                foreach ($gridCliente as $cliente => $gridData) {
                                    echo '<td >'.$cliente.'</td>';
                                    ksort($gridData);                        
                                    foreach ($gridData as $key => $data) {
                                        if(!$data)
                                            echo '<td></td>';
                                        else
                                            echo '<td class="numeros">'.$data.'</td>';
                                        $total1[$sucursal][$key]+=$data;
                                    }
                                    echo "</tr>";
                                }
                            }                    
                        }                
                    }
                    echo '<tr><th style="text-align:right" colspan="5">Total '.$sucursal.'</th>'
                            . '<th style="text-align:right">'.$total1[$sucursal]["cbm"].'</th>'
                            . '<th style="text-align:right">'.$total1[$sucursal]["hbls"].'</th>'
                            . '</tr>';
                }
                ?>
            </table> 
        </div>
        
    <?
    //echo "<pre>";print_r($fcl);echo "</pre>";
    
    }
}
?>

<script language="javascript">

    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border: true,
        fame: true,
        width: 1000,
        standardSubmit: true,
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults: {autoHeight: true, bodyStyle: 'padding:10px'},
            id: 'tab-panel',
            items: [
                new FormMenuCargaPorSucursal()
            ]
        },
        buttons: [
            {
                text: 'Continuar',
                handler: function() {
                    var tp = Ext.getCmp("tab-panel");

                    var owner = Ext.getCmp("formPanel");
                    if (tp.getActiveTab().getId() == "estadisticas") {
                        owner.getForm().getEl().dom.action = '<?= url_for("reportesGer/cargaPorSucursal") ?>';
                    }
                    owner.getForm().submit();
                }
            }]
    });
    tabs.render("container");
    
     function ocultar() {
        document.getElementById('datos').style.display = 'none';
        document.getElementById('fcl').style.display = 'none';
        document.getElementById('lcl').style.display = 'none';        
    }

    function mostrar(id) {
        document.getElementById(id).style.display = 'inline';
    }

    function mostrarTodos() {
        document.getElementById('datos').style.display = 'inline';
        document.getElementById('fcl').style.display = 'inline';
        document.getElementById('lcl').style.display = 'inline';
    }

    window.onload = function() {
        ocultar();
    }

</script>