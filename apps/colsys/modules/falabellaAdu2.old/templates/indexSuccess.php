
<?

$resul = $sf_data->getRaw("resul");
$resul = $resul[0];

//print_r(json_encode($resul));
$facturacion = $sf_data->getRaw("facturacion");
$propios = $sf_data->getRaw("propios");
$do = $sf_data->getRaw("do");
$do1 = $sf_data->getRaw("do1");
$costos = $sf_data->getRaw("costos");
$costos1= $sf_data->getRaw("costos1");
$importar= $sf_data->getRaw("importar");

$facClientes=0;
$ventaExtra=0;
$costoNeto=0;

?>



<form method="post" action="#">
    <table align="center" width="80%" class="tableList">
        <tr>
            <td>Do</td>
            <td>
                <input type="text" name="do" id="do" value="<?=$do?>" style="width:250px"> 
                <input type="submit" value="Buscar">
            </td>
        </tr>
        
    </table>
</form>
<?
if($do!="")
{
?>

<form method="post" action="/falabellaAdu2/importarDo">
    <input type="hidden" name="do" id="do" value="<?=$do1?>">
    <input type="hidden" name="opcion" id="opcion" value="validar">    
    

<table align="center" width="80%" class="tableList">
    <th style="font-size: large;text-align: center" colspan="4"><?=$do?></th>
    <tr>
        <th width="15%">Referencia</th><td width="35%"><?=$do1?></td>
        <th width="15%">Fecha de Registro</th><td width="35%"><?=$resul["ca_fchcreado"]?>
            <input type="hidden" name="ca_fchcreado" id="ca_fchcreado" value="<?=$resul["ca_fchcreado"]?>"> 
        </td>
    </tr>
<!--$this->resul[$k]["ca_iddestino1"]=$ciu_simi["ca_idciudad"];
                $this->resul[$k]["ca_destino1"]=$ciu_simi["ca_ciudad"];
                $this->resul[$k]["ca_trafdestino1"]=$ciu_simi["ca_idtrafico"];-->
    <tr>
        <th>Origen</th><td><?=$resul["ca_origen"]. "&nbsp;&nbsp;&nbsp;(".$resul["ca_origen1"].")" ?> 
            <input type="hidden" name="ca_origen" id="ca_origen" value="<?=$resul["ca_origen1"]?>"> 
            <input type="hidden" name="ca_origen" id="ca_origen" value="<?=$resul["ca_idorigen1"]?>">
            <input type="hidden" name="ca_traforigen" id="ca_traforigen" value="<?=$resul["ca_traforigen1"]?>">
        </td>
        <th>Destino</th><td><?=$resul["ca_destino"]. "&nbsp;&nbsp;&nbsp; (".$resul["ca_destino1"].")"?> 
            <input type="hidden" name="ca_destino" id="ca_destino" value="<?=$resul["ca_iddestino1"]?>">
            <input type="hidden" name="ca_trafdestino" id="ca_trafdestino" value="<?=$resul["ca_trafdestino1"]?>">
        </td>
    </tr>
    
    <tr>
        <th>Cliente</th><td><?=$resul["ca_idcliente"] ."&nbsp;&nbsp;&nbsp; (".$resul["ca_compania"].")"?> <input type="hidden" name="ca_idcliente" id="ca_cliente" value="<?=$resul["ca_idcliente1"]?>"></td>
        <th>Coordinador</th><td><?=$resul["ca_idcoordinador"]."&nbsp;&nbsp;&nbsp; (".$resul["ca_coordinador"].")" ?> <input type="hidden" name="ca_coordinador" id="ca_coordinador" value="<?=$resul["ca_coordinador"]?>"></td>
    </tr>
    
    <tr>
        <th>Vendedor</th><td><?=$resul["ca_idvendedor"]."&nbsp;&nbsp;&nbsp; (".$resul["ca_vendedor"].")"?> <input type="hidden" name="ca_vendedor" id="ca_vendedor" value="<?=$resul["ca_vendedor"]?>"></td>
        <th>Analista</th><td><?=$resul["ca_idanalista"]."&nbsp;&nbsp;&nbsp; (".$resul["ca_analista"].")"?> <input type="hidden" name="ca_analista" id="ca_analista" value="<?=$resul["ca_analista"]?>"></td>        
    </tr>
    <tr>
        <th>Piezas</th><td><?=$resul["ca_piezas"]?> <input type="hidden" name="ca_piezas" id="ca_piezas" value="<?=$resul["ca_piezas"]?>"></td>
        <th>Peso</th><td><?=$resul["ca_peso"]?> <input type="hidden" name="ca_peso" id="ca_peso" value="<?=$resul["ca_peso"]?>"></td>
    </tr>
    <tr>
        <th>Mercancia</th><td><?=$resul["ca_mercancia"]?> <input type="hidden" name="ca_mercancia" id="ca_mercancia" value="<?=$resul["ca_mercancia"]?>"></td>
        <th>Proveedor</th><td><?=$resul["ca_proveedor"]?> <input type="hidden" name="ca_proveedor" id="ca_proveedor" value="<?=$resul["ca_proveedor"]?>"></td>
    </tr>
    <tr>
        <th>Modalidad</th><td><?=$resul["ca_modalidad"]."&nbsp;&nbsp;&nbsp; (".$resul["ca_modalidad1"].")"?> <input type="hidden" name="ca_modalidad" id="ca_modalidad" value="<?=$resul["ca_modalidad1"]?>"></td>
        <th>Fecha Arribo</th><td><?=$resul["ca_fcharribo"]?> <input type="hidden" name="ca_fcharribo" id="ca_fcharribo" value="<?=$resul["ca_fcharribo"]?>"></td>
    </tr>
    <tr>
        <th>Deposito</th><td><?=$resul["ca_deposito"]?> <input type="hidden" name="ca_deposito" id="ca_deposito" value="<?=$resul["ca_deposito"]?>"></td>
        <th>Pedido</th><td><?=$resul["ca_pedido"]?> <input type="hidden" name="ca_pedido" id="ca_pedido" value="<?=$resul["ca_pedido"]?>"></td>        
    </tr>
    
    <tr>
        <th>Contacto</th><td><?=$resul["ca_nombrecontacto"]?> <input type="hidden" name="ca_nombrecontacto" id="ca_nombrecontacto" value="<?=$resul["ca_nombrecontacto"]?>"></td>
        <th>Email</th><td><?=$resul["ca_emailcontacto"]?> <input type="hidden" name="ca_emailcontacto" id="ca_emailcontacto" value="<?=$resul["ca_emailcontacto"]?>"></td>
    </tr>
    
    <tr>
        <th>Fecha Levante</th><td><?=$resul["ca_fchlevante"]?> <input type="hidden" name="ca_fchlevante" id="ca_fchlevante" value="<?=$resul["ca_fchlevante"]?>"></td>
        <th>Fecha pago</th><td><?=$resul["ca_fchpago"]?> <input type="hidden" name="ca_fchpago" id="ca_fchpago" value="<?=$resul["ca_fchpago"]?>"></td>
    </tr>
    
    <tr>
        <th>Fecha Siglo XXI</th><td><?=$resul["ca_fchsigloxxi"]?> <input type="hidden" name="ca_fchsigloxxi" id="ca_fchsigloxxi" value="<?=$resul["ca_fchsigloxxi"]?>"></td>
        <th>Fecha Entrega Transportador</th><td><?=$resul["ca_fchentrtransportador"]?> <input type="hidden" name="ca_fchentrtransportador" id="ca_fchentrtransportador" value="<?=$resul["ca_fchentrtransportador"]?>"></td>
    </tr>
    
    <tr>
        <th>Fecha Despacho Carga</th><td><?=$resul["ca_fchdespcarga"]?> <input type="hidden" name="ca_fchdespcarga" id="ca_fchdespcarga" value="<?=$resul["ca_fchdespcarga"]?>"></td>
        <th>Fecha ETA</th><td><?=$resul["ca_fcheta"]?> <input type="hidden" name="ca_fcheta" id="ca_fcheta" value="<?=$resul["ca_fcheta"]?>"></td>
    </tr>
    
    <tr>
        <th>Fecha Entraga Carp. Factturacion</th><td><?=$resul["ca_fchentrcarpfacturacion"]?> <input type="hidden" name="ca_fchentrcarpfacturacion" id="ca_fchentrcarpfacturacion" value="<?=$resul["ca_fchentrcarpfacturacion"]?>"></td>
        <th>Fecha Entrega Facturacion</th><td><?=$resul["ca_fchentrfacturacion"]?> <input type="hidden" name="ca_fchentrfacturacion" id="ca_fchentrfacturacion" value="<?=$resul["ca_fchentrfacturacion"]?>"></td>
    </tr>
    
    <tr>
        <th>Fecha Facturacion</th><td><?=$resul["ca_fchfacturacion"]?> <input type="hidden" name="ca_fchfacturacion" id="ca_fchfacturacion" value="<?=$resul["ca_fchfacturacion"]?>"></td>
        <th>Fecha Documentos Completos</th><td><?=$resul["ca_fchmayordoc"]?> <input type="hidden" name="ca_fchmayordoc" id="ca_fchmayordoc" value="<?=$resul["ca_fchmayordoc"]?>"></td>
    </tr>
    <tr>
        <th>Fecha a Mensajeria </th><td><?=$resul["ca_fchmensajeria"]?> <input type="hidden" name="ca_fchmensajeria" id="ca_fchmensajeria" value="<?=$resul["ca_fchmensajeria"]?>"></td>
    </tr>
    
</table>
<table align="center" width="80%" class="tableList">
    <?
    foreach($facturacion as $keyFac=>$f)
    {
        $total=0;
        //echo "<pre>";print_r($f);echo "</pre>";
        $nfactura=$f["comidxxx"].substr($f["comcodxx"], -1)."-".$f["comcscxx"];
    ?>
    <tr>
        <th><b>Factura No <?=$nfactura?>  (<?=$f["comfecxx"]?>)   
                Valor:          <?=  Utils::formatNumber($f["comvlrxx"]-$f["comvlr01"]-$f["comrivax"]-$f["comricax"])?></b>
            
            <!--<input type="hidden" name="ca_nofactura[]" id="ca_nofactura<?=$f["comcscxx"]?>" value="<?=$nfactura?>">-->
            <input type="hidden" name="ca_facturas[<?=$nfactura?>][valor]" id="ca_valorfactura<?=($f["comvlrxx"]-$f["comvlr01"]-$f["comrivax"]-$f["comricax"])?>" value="<?=($f["comvlrxx"]-$f["comvlr01"]-$f["comrivax"]-$f["comricax"])?>">
            <input type="hidden" name="ca_facturas[<?=$nfactura?>][cliente]" id="ca_clientefactura<?=$f["teridxxx"]?>" value="<?=$f["teridxxx"]?>">
            <input type="hidden" name="ca_facturas[<?=$nfactura?>][fecha]" id="ca_fechafactura<?=$f["comfecxx"]?>" value="<?=$f["comfecxx"]?>">
            
        </th>
    </tr>
    <tr>
        <td>Cliente: <?=$f["teridxxx"]?></td>            
    </tr>
    <tr>
        <td width="100%">
            <table width="100%">
                <tr><th colspan="4">COSTOS</th></tr>
                <tr>
                    <th width="15%">Id Concepto</th>
                    <th width="45%">Concepto</th>
                    <th width="30%">Tercero</th>
                    <th width="10%">Valor</th>
                </tr>
    <?
        $cons=0;
        if($f["commemod"]!="")
        {
            $arrCostos=explode("|", $f["commemod"]);
            $titulo=true;
            $total=0;
            
            foreach($arrCostos as $c)
            {
                //echo "<pre>";print_r($c);echo "</pre>";
                $arrConceptos=explode("~", $c);
                //echo count($arrConceptos);
                if(count($arrConceptos)>=25)
                {
                    //echo "<pre>";print_r($arrConceptos);echo "</pre>";
                    
                    $arrDo=explode("-", $arrConceptos["14"]);
                    if($arrDo[1]!=$do)
                    {
                        $observaciones[$nfactura][$arrDo[1]]=$arrDo[1];
                        continue;
                    }
                    else
                        $observaciones[$nfactura][$arrDo[1]]=$arrDo[1];
                    $total+=$arrConceptos[7];
                    //foreach($arrConceptos as $p)
                    {
                        $arrTer=  explode("^", $arrConceptos[2]);
                        if(isset($costos1[$arrConceptos[1]]))
                        {
                            $tmpCosto=$costos[$costos1[$arrConceptos[1]]];
                        }
                        else
                        {                            
                            $tmpCosto["ca_costo"]="<span class='rojo'>No Registrado en Colsys</span>";
                            $tmpCosto["ca_idcosto"]="<span class='rojo'>No Registrado en Colsys</span>";
                        }
                        
                                //array_search($arrConceptos[1], array_column($costos, 'ca_conceptoopen'));
                    ?>
                    <tr>                        
                        <td><?=$arrConceptos[1]." (".$tmpCosto["ca_idcosto"].")" ?> </td>
                        <td><?=$arrTer[0]." (".$tmpCosto["ca_costo"].")"?></td>
                        <td><?=$arrTer[1]?> </td>
                        <td style="text-align: right"><?=Utils::formatNumber($arrConceptos[7])?> 
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][tipo]" id="ca_valorcosto<?=$cons?>" value="T">
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][valor][]" id="ca_valorcosto<?=$cons?>" value="<?=$arrConceptos[7]?>">
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][factura]" id="ca_valorcosto<?=$cons?>" value="<?=$arrConceptos[5]?>">
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][fecha]" id="ca_valorpropio<?=$cons++?>" value="<?=$f["comfecxx"]?>">
                        </td>
                    </tr>
                    <?
                    }
                }
                //echo "<br><hr>";
            }
        }
        else if($f["comfpxxx"]!=""&& $f["comobsxx"] =="FACTURA ADICIONAL, COBRO DE POLIZA DE SEGURO")
        {
            $total=0;
            $arrCostos=explode("|", $f["comfpxxx"]);
            //echo  count($arrCostos);
            foreach($arrCostos as $c)
            {
                //echo "<pre>";print_r($c);echo "</pre>";
                $arrConceptos=explode("~", $c);
                //echo count($arrConceptos)."---";
                if(count($arrConceptos)>=25)
                {
                    $total+=$arrConceptos[19];
                    //echo "<pre>";print_r($arrConceptos);echo "</pre>";
                    if(isset($costos1[$arrConceptos[14]]))
                    {
                        $tmpCosto=$costos[$costos1[$arrConceptos[14]]];
                    }
                    else
                    {
                        $tmpCosto["ca_costo"]="<span class='rojo'>No Registrado en Colsys</span>";
                        $tmpCosto["ca_idcosto"]="<span class='rojo'>No Registrado en Colsys</span>";
                    }
                    ?>
                    <tr>
                        <td><?=$arrConceptos[14]." (".$tmpCosto["ca_idcosto"].")"?> </td>
                        <td><?=$f["comobsxx"]." (".$tmpCosto["ca_costo"].")"?></td>
                        <td></td>
                        <td style="text-align: right"><?=$arrConceptos[19]?> 
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][tipo]" id="ca_valorcosto<?=$cons?>" value="T">
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][valor][]" id="ca_valorcosto<?=$cons?>" value="<?=$arrConceptos[19]?>">
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][factura]" id="ca_valorcosto<?=$cons?>" value="<?=$nfactura?>">
                            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][fecha]" id="ca_valorpropio<?=$cons++?>" value="<?=$f["comfecxx"]?>">
                            
                        </td>
                    </tr>
                    <?
                }
            }
        }
        
        
        if($f["comifxxx"]>0)
        {
            $imp=round($total*0.004);
            $total+=$imp;//$f["comifxxx"];
            
            if(isset($costos1["2815050041"]))
            {
                $tmpCosto=$costos[$costos1["2815050041"]];
            }
            else
            {
                $tmpCosto["ca_costo"]="No Registrado en Colsys";
                $tmpCosto["ca_idcosto"]="No Registrado en Colsys";
            }
        ?>
        <tr>
            <td>2815050041 <?=" (".$tmpCosto["ca_idcosto"].")"?> </td>
            <td>IMPUESTO 4*1000 <?=" (".$tmpCosto["ca_costo"].")"?></td>
            <td></td>
            <td style="text-align: right"><?=$imp?> 
                <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][tipo]" id="ca_valorcosto<?=$cons?>" value="T">
                <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][valor][]" id="ca_valorcosto<?=$cons?>" value="<?=$imp?>">
                <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][factura]" id="ca_valorcosto<?=$cons?>" value="<?=$nfactura?>">
                <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][fecha]" id="ca_valorpropio<?=$cons++?>" value="<?=$f["comfecxx"]?>">
            </td>
        </tr>
        
        <?
        }
        $costoNeto+=$total;
        $facClientes+=$total;
        ?>
        <tr>
            <td colspan="3"><b>TOTAL</b></td>
            
            <td style="text-align: right"><b><?=$total?></b></td>
        </tr>
        <?
        if(count($observaciones[$nfactura])>1)
        {
        ?>
        <tr>
            <td colspan="3">
                <input type="hidden" name="ca_facturas[<?=$nfactura?>][observaciones]" id="ca_observacionesfactura<?=$nfactura?>" value="LA FACTURA DE INGRESOS A TERCEROS #<?=$nfactura?> AGRUPA LOS DO(S) <?=implode(" , ",$observaciones[$nfactura])?>">
                <b>Observaciones : </b>LA FACTURA DE INGRESOS A TERCEROS #<?=$nfactura?> AGRUPA LOS DO(S) <?=implode(" , ",$observaciones[$nfactura])?></td>
        </tr>
        <?
        }
        ?>
 </table>
        </td>
    </tr>   

<?

///echo "valor facturador=".($f["comvlrxx"]-$f["comvlr01"]-$f["comrivax"]-$f["comricax"]);

    }
    ?>
    
</table>



<table align="center" width="80%" class="tableList">
    <tr>
        <th colspan="3"><b>INGRESOS PROPIOS</b></th>
    </tr>
    <tr>
        <th width="15%">Id Concepto</th>
        <th width="65%">Concepto</th>
        <th width="10%">Neta</th>
        <th width="10%">Venta</th>
    </tr>
    <?
    $total=0;
    //echo "<pre>";print_r($costos1);echo "</pre>";
    foreach($propios as $p)
    {
        //echo "<pre>";print_r($p);echo "</pre>";
        if(($p["comidxxx"]=="F" && ($p["comidc2x"]!="P" && $p["comidc2x"]!="" ) )   )
        {
            //echo "<pre>";print_r($p);echo "</pre>";
            continue;
        }
        if($p["comidxxx"] == "P"  && $p["comcodxx"] && ($p["comcodxx"]!="004" && $p["comcodxx"]!="020" ))
        {
            //echo "<pre>";print_r($p);echo "</pre>";
            $concep="Seguro y Administración de Riesgo";
        }
        else if($p["comidxxx"] == "P"  &&  $p["comcodxx"]=="004")
        {
            if($p["ctoidxxx"]=="5295950004")
            {
                $neto["4145400002"]=round($p["comvlrxx"]+($p["comvlrxx"]*0.16));
                //echo $neto["4145400002"];
            }
            //4145400002
            continue;
        }
        else if($p["comidxxx"] == "P"  &&  $p["comcodxx"]=="020")
        {
            $concep=$p["comobsxx"];
            $neto["2815050025"]=round($p["comvlrxx"]);
            $p["comvlrxx"]=0;            
        }        
        else
        {
            $arrConceptos=explode("~", $p["comobsxx"]);
            $concep=$arrConceptos[2];
        }
        $total+=$p["comvlrxx"];
        $total-=$neto[$p["ctoidxxx"]];
        
        if(isset($costos1[$p["ctoidxxx"]]))
        {
            $tmpCosto=$costos[$costos1[$p["ctoidxxx"]]];
        }
        else
        {
            $tmpCosto["ca_costo"]="<span class='rojo'>No Registrado en Colsys</span>";
            $tmpCosto["ca_idcosto"]="<span class='rojo'>No Registrado en Colsys</span>";
        }
        //print_r($tmpCosto)
        
?>
    <tr>
        <td><?=$p["ctoidxxx"]." (".$tmpCosto["ca_idcosto"].")"?> </td>
        <td><?=$concep." (".$tmpCosto["ca_costo"].")"?></td>
        <td style="text-align: right"><?=$neto[$p["ctoidxxx"]]?>
        </td>
        <td style="text-align: right"><?=Utils::formatNumber($p["comvlrxx"])?> 
            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][tipo]" id="ca_valorcosto<?=$cons?>" value="P">
            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][valor][]" id="ca_valorcosto<?=$cons?>" value="<?=$p["comvlrxx"]?>">
            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][factura]" id="ca_valorcosto<?=$cons?>" value="<?=$p["comcscxx"]?>">
            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][neto]" id="ca_valorcosto<?=$cons?>" value="<?=$neto[$p["ctoidxxx"]]?>">
            <input type="hidden" name="ca_costos[<?=$tmpCosto["ca_idcosto"]?>][fecha]" id="ca_valorcosto<?=$cons++?>" value="<?=$p["comfecxx"]?>">
        </td>
    </tr>
<?
    }
    
    $ventaExtra=$total;
    $facClientes+=$total;
    ?>
    <tr>
        <td colspan="3"><b>TOTAL</b></td>
        <td style="text-align: right"><b><?=$total?></b></td>
    </tr>
</table>

<table align="center" width="80%" class="tableList">
    <tr>
        <th colspan="4"><b>RESUMEN</b></th>
    </tr>
    
    <tr>
        <td><b>Facturacion Clientes</b></td>
        <td><?=Utils::formatNumber($facClientes)?></td>
        
        <td><b>Venta Extra</b></td>
        <td><?=Utils::formatNumber($ventaExtra)?></td>
    </tr>    
    <tr>
        <td><b>Costo Neto</b></td>
        <td><?=Utils::formatNumber($costoNeto)?></td>
    </tr>
</table>

<br><br>
<?

if($importar=="1")
{
?>
<input type="submit" value="Importar" onclick="importar()">
<?
}
else
{
    echo "REFERENCIA CERRADA, NO ES POSIBLE IMPORTARLA";
}
?>
</form>
<script>
function importar()
{
//    console.log('<?=json_encode($resul)?>');
}
</script>
    

<iframe  width="100%" height="600" border:0
    src="/Coltrans/Aduanas/ConsultaReferenciaAction.do?referencia=<?=$do1?>&consulta="></iframe>
<?
}
?>
