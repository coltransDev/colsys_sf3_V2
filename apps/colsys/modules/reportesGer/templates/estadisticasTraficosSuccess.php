<?
include_component("charts", "column");
$dataJSON = array();
$gridClientes_t= $sf_data->getRaw("gridClientes_t");
?>
<div align="center" >
    <br />
    <h3> Estadisticas Depto Traficos </h3>
    <br />
    <br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
include_component("reportesGer", "filtrosEstadisticasTraficos");

if ($opcion) {
    ?>
    <div>
        <div align="center">
            <br>
            <h3>Estadisticas de cargas  <br>
                <?
                if ($fechainicial && $fechafinal) {
                    echo " fechas de : " . $fechainicial . " - " . $fechafinal;
                }
                foreach ($grid as $g) {
                    $nmeses = count($g);
                    break;
                }
                ?>
            </h3>
            <br />
            <br />
        </div>
        <table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
            <tr><th>No</th><th>Trafico</th>
                <?
                for ($i = 0; $i < $nmeses; $i++) {
                    ?>
                    <th><?= (Utils::addDate($fechainicial, 0, $i, 0, "Y-n")) ?></th>
                    <?
                }
                ?>
            </tr>
                <?
                $origentmp = "";
                $c = 1;
                $serieX = array();
                $dataFechas = array();
                foreach ($grid as $key => $r) {
                    $serieX[] = ".     " . utf8_encode($key);
                    ?>
                    <tr><td><?= $c++ ?></td><td><?= $key ?></td>
                        <?
                        for ($i = 0; $i < $nmeses; $i++) {
                            ?>
                            <td class="number"><?= $r[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")] ?></td>
                            <?
                            $dataFechas[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")][] = $r[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")];
                        }
                        ?>
                    </tr>
                    <?
                }                
                if ($totales) {
                    ?>
                    <tr class="b number"><td colspan="2">totales</td>
                        <?
                        for ($i = 0; $i < $nmeses; $i++) {
                            ?>
                            <td><?= $totales[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")] ?></td>
                            <?
                        }
                        ?>
                    </tr>            
                    <?
                }
                foreach ($dataFechas as $fech => $d) {
                    $dataJSON[] = array("name" => $fech, "data" => $d);
                }                
                ?>
        </table>
        <br>
        <br>
        <br>
        <br>

        <table align="center" width="90%">
            <tr>
                <td style=" margin: 0 auto" >

                    <div align="center" id="grafica" ></div>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            var chart;
            chart = new ChartsColumn({
                renderTo: 'grafica',
                title: "Movimientos de Traficos",
                titleY: "Numero de Reportes",
                height: 800,
                width: 900,
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true
                        }//,
                        //stacking: 'percent'
                    }
                },
                serieX: <?= json_encode($serieX) ?>,
                series: <?= json_encode($dataJSON) ?>
            });
        </script>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div>
        <table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
            <tr><th>No</th><th>Trafico</th>
                <?
                for ($i = 0; $i < $nmeses; $i++) {
                    ?>
                    <th><?= (Utils::addDate($fechainicial, 0, $i, 0, "Y-n")) ?></th>
                    <?
                }
                ?>
            </tr>
            <?
            $origentmp = "";
            $c = 1;
            $serieX = array();
            $dataJSON = array();
            $dataFechas = array();
            foreach ($grid_s as $key => $r) {
                $serieX[] = ".     " . utf8_encode($key);
                ?>
                <tr><td><?= $c++ ?></td><td><?= $key ?></td>
                    <?
                    for ($i = 0; $i < $nmeses; $i++) {
                        ?>
                            <td class="number"><?= $r[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")] ?></td>
                        <?
                        $dataFechas[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")][] = $r[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")];
                    }
                    ?>
                </tr>
                <?
            }

            if ($totales_s) {
                ?>
                <tr class="b number"><td colspan="2">totales</td>
                    <?
                    for ($i = 0; $i < $nmeses; $i++) {
                        ?>
                        <td><?= $totales_s[Utils::addDate($fechainicial, 0, $i, 0, "Y-n")] ?></td>
                        <?
                    }
                    ?>
                </tr>            
                <?
            }
            foreach ($dataFechas as $fech => $d) {
                $dataJSON[] = array("name" => $fech, "data" => $d);
            }
            //print_r(json_decode($serieX));
            //echo "2"print_r(json_encode($serieX));
            ?>
        </table>
        <br>
        <br>
        <br>
        <br>

        <table align="center" width="90%">
            <tr>
                <td style=" margin: 0 auto" >

                    <div align="center" id="grafica_s" ></div>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            var chart;
            chart = new ChartsColumn({
                renderTo: 'grafica_s',
                title: "Movimientos de Traficos",
                titleY: "Numero de Reportes",
                height: 800,
                width: 900,
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true
                        }//,
                        //stacking: 'percent'
                    }
                },
                serieX: <?= json_encode($serieX) ?>,
                series: <?= json_encode($dataJSON) ?>
            });
        </script>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div align="center">
        <h3>Resumen Comparativo de Negocios Manejados</h3>  <br>
    </div>
    <div>
        <table class="tableList" width="900px" border="1" id="mainTable" align="center">
            <tr><th>No</th><th>Trafico</th>
            <?
            $year = Utils::addDate($fechainicial2, 0, 0, 0, "Y");
            $c = 1;
            for ($i = $year - 2; $i <= $year; $i++) {
                ?>
                <th><?= $i ?></th>
                <th width="12%">Variacion <?= $i ?>/<?= $i - 1 ?></th>
                <?
            }
            ?>
                    </tr>
            <?
            $serieX = array();
            $dataFechas = array();
            foreach ($gridCompara as $key => $r) {
                $serieX[] = ".     " . utf8_encode($key);
                ?>
                <tr><td><?= $c++ ?></td><td><?= $key ?></td>
                    <?
                    $year = Utils::addDate($fechainicial2, 0, 0, 0, "Y");
                    for ($i = $year - 2; $i <= $year; $i++) {
                        ?>
                        <td class="number"><?= $r[$i] ?></td>
                        <?
                        $var = $r[$i - 1] ? ($r[$i] / $r[$i - 1]) : 0;
                        ?>
                        <td class="number"><?= ($var > 0) ? Utils::formatNumber($var - 1, 2) * 100 : "0" ?>%</td>
                        <?
                        $dataFechas[$i][] = $r[$i];
                    }
                    ?>
                </tr>
                <?
            }            
            $dataJSON = array();
            foreach ($dataFechas as $fech => $d) {
                $dataJSON[] = array("name" => $fech, "data" => $d);
            }

            if ($totalesCompara) {
                ?>
                <tr class="b number"><td colspan="2">totales</td>
                    <?
                    $year = Utils::addDate($fechainicial2, 0, 0, 0, "Y");
                    for ($i = $year - 2; $i <= $year; $i++) {
                        ?>
                        <td><?= $totalesCompara[$i] ?></td>
                        <td></td>
                        <?
                    }
                    ?>
                </tr>            
                <?
            }
            ?>
        </table>
        <br>
        <br>
        <br>
        <br>
        <div align="center">
            <h3>Resumen Comparativo de Negocios Manejados</h3>  <br>
        </div>
        <table align="center" width="90%">
            <tr>
                <td style=" margin: 0 auto" >

                    <div align="center" id="grafica1" ></div>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            var chart1;
            chart1 = new ChartsColumn({
                renderTo: 'grafica1',
                height: 800,
                width: 900,
                title: "Movimientos de Traficos",
                titleY: "Numero de Reportes",
                serieX: <?= json_encode($serieX) ?>,
                series: <?= json_encode($dataJSON) ?>
            });
        </script>
        </div>
        <br>
        <br>
        <br>
        <br>
        <table class="tableList" width="900px" border="1" id="mainTable" align="center">
            <tr><th>No</th><th>Trafico</th>
                <?
                $year = Utils::addDate($fechainicial2, 0, 0, 0, "Y");
                $c = 1;
                for ($i = $year - 2; $i <= $year; $i++) {
                    ?>
                    <th><?= $i ?></th>
                    <th width="12%">Variacion <?= $i ?>/<?= $i - 1 ?></th>
                    <?
                }
                ?>
            </tr>
            <?
            $serieX = array();
            $dataFechas = array();
            $dataJSON = array();
            foreach ($gridCompara_s as $key => $r) {
                $serieX[] = ".     " . utf8_encode($key);
                ?>
                <tr><td><?= $c++ ?></td><td><?= $key ?></td>
                    <?
                    $year = Utils::addDate($fechainicial2, 0, 0, 0, "Y");
                    for ($i = $year - 2; $i <= $year; $i++) {
                        ?>
                        <td class="number"><?= $r[$i] ?></td>
                        <?
                        $var = $r[$i - 1] ? ($r[$i] / $r[$i - 1]) : 0;
                        ?>
                        <td class="number"><?= ($var > 0) ? Utils::formatNumber($var - 1, 2) * 100 : "0" ?>%</td>
                        <?
                        $dataFechas[$i][] = $r[$i];
                    }
                    ?>
                </tr>
                <?
            }
            print_r($dataFechas);

            foreach ($dataFechas as $fech => $d) {
                $dataJSON[] = array("name" => $fech, "data" => $d);
            }

            if ($totalesCompara_s) {
                ?>
                <tr class="b number"><td colspan="2">totales</td>
                    <?
                    $year = Utils::addDate($fechainicial2, 0, 0, 0, "Y");
                    for ($i = $year - 2; $i <= $year; $i++) {
                        ?>
                        <td><?= $totalesCompara_s[$i] ?></td>
                        <td></td>
                        <?
                    }
                    ?>
                </tr>            
                <?
            }
            ?>

        </table>
        <br>
        <br>
        <br>
        <br>
        <div align="center">
            <h3>Resumen Comparativo de Negocios Manejados</h3>  <br>
        </div>
        <table align="center" width="90%">
            <tr>
                <td style=" margin: 0 auto" >

                    <div align="center" id="grafica1_s" ></div>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            var chart1;
            chart1 = new ChartsColumn({
                renderTo: 'grafica1_s',
                height: 800,
                width: 900,
                title: "Movimientos de Traficos",
                titleY: "Numero de Reportes",
                serieX: <?= json_encode($serieX) ?>,
                series: <?= json_encode($dataJSON) ?>
            });
        </script>


        <br>
        <br>
        <br>
        <br>

        <div align="center">
            <h3>Informe Clientes x Tr&aacute;fico</h3>  <br>
        </div>
        <table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
            <tr><th>Trafico</th><th>Cliente</th>
                <?
                for ($i = 0; $i < $mes; $i++) {
                    ?>
                    <th><?= (Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")) ?></th>
                    <?
                }
                ?>
                <th>Total General</th>
            </tr>
            <?
            $origentmp = "";
            //$c=1;

            foreach ($gridClientes as $key => $r) {
                $cliente = "";
                foreach ($r as $cliente => $c) {
                    ?>
                    <tr <?= ($origentmp != $key) ? 'style="border-top: 2px solid #000"' : ' ' ?>>
                        <?
                        if ($origentmp != $key) {
                            ?>
                            <td rowspan="<?= count($r) + 1 ?>" class="b"><?= $key ?></td>
                            <?
                        }
                        $origentmp = $key;
                        ?>
                        <td ><?= $cliente ?></td>
                        <?
                        for ($i = 0; $i < $mes; $i++) {
                            ?>
                            <td class="number"><?= $c[Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                            <?
                        }
                        ?>
                        <td><?= $c["totales"] ?></td>
                    </tr>
                    <?
                }
                if ($totalesCliente[$key]) {
                    ?>
                    <tr class="b number" style="background: #EAEAEA"><td colspan="1">totales</td>
                        <?
                        for ($i = 0; $i < $mes; $i++) {
                            ?>
                            <td><?= $totalesCliente[$key][Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                            <?
                        }
                        ?>
                        <td><?= $totalesCliente[$key]["totales"] ?></td>
                    </tr>            
                    <?
                }
            }

            if ($totalesCliente["totales"]) {
                ?>
                <tr class="b number" style="background: #D9D9D9"><td colspan="2">totales</td>
                    <?
                    for ($i = 0; $i < $mes; $i++) {
                        ?>
                        <td><?= $totalesCliente["totales"][Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                        <?
                    }
                    ?>
                    <td><?= $totalesCliente["totales"]["totales"] ?></td>
                </tr>            
                <?
            }
            ?>
        </table>

        <?
        if($departamento == "Cuentas Globales"){
        ?>
        <br>
        <br>
        <br>
        <br>
        
        <div align="center">
            <h3>Informe Clientes x Transporte</h3>  <br>
        </div>


        <table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
            <tr><th>Trafico</th><th>Cliente Prueba</th>
                <?
                for ($i = 0; $i < $mes; $i++) {
                  ?>
                    <th><?= (Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")) ?></th>
                  <?
                }
                  ?>
                <th>Total General</th>
            </tr>
                  <?
            $origentmp = "";            
            $serieCl = array();
            
            foreach ($gridClientes_t as $cliente => $gridTransporte) {
                if(!in_array($cliente, $serieCl)){
                    $serieCl[] = $cliente;
                }
                $transporte = "";                
                ksort($gridTransporte);
                foreach ($gridTransporte as $transporte => $gridMes) {                    
                    ?>
                    <tr <?= ($origentmp != $cliente) ? 'style="border-top: 2px solid #000"' : ' ' ?>>
                        <?
                        if ($origentmp != $cliente) {
                            ?>
                            <td rowspan="<?= count($gridTransporte) + 1 ?>" class="b"><?= $cliente ?></td>
                            <?
                        }
                        $origentmp = $cliente;
                        ?>
                        <td ><?= $transporte ?></td>
                        <?
                        for ($i = 0; $i < $mes; $i++) {
                            ?>
                            <td class="number"><?= $gridMes[Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                            <?
                        }
                        ?>
                        <td><?= $gridMes["totales"] ?></td>
                    </tr>
                    <?
                }
                if ($totalesCliente_t[$cliente]) {
                    ?>
                    <tr class="b number" style="background: #EAEAEA"><td colspan="1">totales</td>
                        <?
                        for ($i = 0; $i < $mes; $i++) {
                            ?>
                            <td><?= $totalesCliente_t[$cliente][Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                            <?
                        }
                        ?>
                        <td><?= $totalesCliente_t[$cliente]["totales"] ?></td>
                    </tr>            
                    <?
                }
            }
            
            if ($totalesCliente_t["totales"]) {
                  ?>
                <tr class="b number" style="background: #D9D9D9"><td colspan="2">totales</td>
                    <?
                    for ($i = 0; $i < $mes; $i++) {
                        ?>
                        <td><?= $totalesCliente_t["totales"][Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                        <?
                    }
                    ?>
                    <td><?= $totalesCliente_t["totales"]["totales"] ?></td>
                  </tr>
                  <?
            }
                ?>
        </table>
        <?
        
        $serieCl = array();
        $dataJSON = array();
        $dataFechas = array();
        $serieT[] = "Marítimo";
        $serieT[] = "Aéreo";
        foreach ($gridClientes_t as $cliente => $gridTransporte) {        
            if(!in_array($cliente, $serieCl)){
                    $serieCl[] = utf8_encode($cliente);
            }            
            foreach($serieT as $key => $trans){
               $dataFechas[$trans][] = $gridTransporte[$trans]["totales"]; 
            }            
        }
        
        foreach ($dataFechas as $fech => $d) {
            $dataJSON[] = array("name" => utf8_encode($fech), "data" => $d);
        }
        
        ?>
        <br/><br/>
        <table align="center" width="90%">
        <tr>
            <td style=" margin: 0 auto" >
                <div align="center" id="grafica_transporte" ></div>
            </td>
        </tr>
        </table>
        <script type="text/javascript">
            var chart;
            chart = new ChartsColumn({
                renderTo: 'grafica_transporte',
                title: "Gráfica Cliente x Transporte",
                titleY: "Numero de Reportes",
                height: 800,
                width: 900,
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true
                        }//,
                        //stacking: 'percent'
                    }
                },
                serieX: <?= json_encode($serieCl) ?>,
                series: <?= json_encode($dataJSON) ?>
            });
        </script>
        <?
    }
        ?>
        <br />
        <br />        
        <br />
        <br />
        <div align="center">    
            <h3>Informe x Vendedor</h3>  <br>
        </div>
        <br />
        <br />
    </div>
    <br>
    <br>
    <br>
    <br>
    <table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
        <tr><th>No</th><th>Vendedor</th>
            <?
            for ($i = 0; $i < $mes; $i++) {
                ?>
                <th><?= (Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")) ?></th>
                <?
            }
            ?>
            <th>Total</th>
        </tr>
        <?
        $origentmp = "";
        $c = 1;
        foreach ($gridVendedores as $key => $r) {
            ?>
            <tr><td><?= $c++ ?></td><td><?= $key ?></td>
                <?
                for ($i = 0; $i < $mes; $i++) {
                    ?>
                    <td class="number"><?= $r[Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                    <?
                }
                ?>
                <td class="number b"><?= $r["totales"] ?></td>
            </tr>
            <?
        }

        if ($totalesVendedores) {
            //print_r($totalesVendedores);
            ?>
            <tr class="b number"><td colspan="2">totales</td>
                <?
                for ($i = 0; $i < $mes; $i++) {
                    ?>
                    <td><?= $totalesVendedores[Utils::addDate($fechainicial2, 0, $i, 0, "Y-n")] ?></td>
                    <?
                }
                ?>
                <td><?= $totalesVendedores["totales"] ?></td>
            </tr>            
            <?
        }    
        ?>
    </table>
    <?
}
?>

<script>
    function imprimir()
    {
        $(".esconder").hide();
        Ext.getCmp("tab-panel").hidden = true;
        window.print();
    }
</script>