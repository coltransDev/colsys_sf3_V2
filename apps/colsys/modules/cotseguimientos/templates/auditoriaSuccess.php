<div align="center">
    <br>
    <h3>Estadisticas de cotizaciones <?= $fechaInicial ? Utils::fechaMes($fechaInicial) : "" ?> <?= $fechaFinal ? Utils::fechaMes($fechaFinal) : "" ?> <br>
        <?
        if (isset($usuario) && $usuario) {
            echo "Vendedor: " . $usuario->getCaNombre();
        }
        if (isset($sucursal) && $sucursal) {
            echo " Sucursal: " . $sucursal;
        }

        if ($est) {
            if ($est == "SIN") {
                echo "Sin seguimientos";
            } else {
                echo " Estado: " . $estados[$est];
            }
        }
        ?>
    </h3>
    Datos basados en <?= count($cotizaciones) ?> cotizaciones 
    <br />
    Empresa <?= $empresa ?>
    <br />
    <br />
    <table width="80%" border="1" class="tableList">
        <tr>
            <th scope="col">No Cotizacion</th>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha</th>					
            <th scope="col">Usuario</th>
            <th scope="col">Sucursal</th>
            <th scope="col">Origen</th>
            <th scope="col">Destino</th>
            <th scope="col">Fecha Ultimo Seguimiento</th>
            <th scope="col">Ultimo Seguimiento</th>
            <th scope="col">Etapa</th>
            <th scope="col">Empresa</th>
        </tr>
        <?
        $total = 0;
        $total2 = 0;
        $con_sec = null;
        foreach ($cotizaciones as $cotizacion) {
            $sin_trayectos = FALSE;
            $cot = $cotizacion;
            if ($cot["ca_etapa_cot"] and !$cot["ca_idproducto"]){
                $fchSeg = $cot["ca_fchseguimiento_cot"];
                $lastSeg = $cot["ca_seguimiento_cot"];
                $etapaSeg = $cot["ca_etapa_cot"];
                $sin_trayectos = TRUE;
            }else if(!$cot["ca_etapa_cot"] and !$cot["ca_idproducto"]) {
                $sin_trayectos = TRUE;
            }else{
                $fchSeg = null;
                $lastSeg = null;
                $etapaSeg = null;
            }
            if ($cot["ca_consecutivo"] != $con_sec){
                ?>
                <tr class="row0">
                    <td><?= link_to($cot["ca_consecutivo"] . "-V" . $cot["ca_version"], "cotseguimientos/verSeguimiento?idcotizacion=" . $cot["ca_cotizacion_id"], array("target" => "_blank")) ?></td>
                    <td><?= $cot["ca_compania"] ?></td>
                    <td><?= Utils::fechaMes($cot["ca_fchcreado"]) ?></td>
                    <td><?= $cot["ca_usuario"] ?></td>
                    <td><?= $cot["ca_sucursal"] ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?= $fchSeg ? Utils::fechaMes($fchSeg) : "&nbsp;" ?></td>
                    <td><?= $lastSeg ? $lastSeg : "&nbsp;" ?></td>
                    <td><?= ($cot["ca_etapa_cot"] and !$cot["ca_idproducto"])? $estados[$cot["ca_etapa_cot"]] : "&nbsp;" ?></td>
                    <td><?= $cot["ca_empresa"] ?></td>
                </tr>                
                <?
                $con_sec = $cot["ca_consecutivo"];
            }
            if ($sin_trayectos){
                continue;
            }
            $fchSeg = $cot["ca_fchseguimiento_pro"];
            $lastSeg = $cot["ca_seguimiento_pro"];
            $etapaSeg = $cot["ca_etapa_pro"];
            ?>
            <tr >
                <td colspan="5">                            
                    &nbsp;</td>
                <td ><?= $cot["ca_origen"] ?></td>
                <td ><?= $cot["ca_destino"] ?></td>
                <td><?= $fchSeg ? Utils::fechaMes($fchSeg) : "&nbsp;" ?></td>
                <td><?= $lastSeg ? $lastSeg : "&nbsp;" ?></td>
                <td><?= $etapaSeg ? $estados[$etapaSeg] : "&nbsp;" ?></td>
                <td></td>
            </tr>     
            <?
                    
            
        }
        ?>				
    </table>


</div>
