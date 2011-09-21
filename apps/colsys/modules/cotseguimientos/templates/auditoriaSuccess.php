
<div align="center">
<br>
<h3>Estadisticas de cotizaciones <?=$fechaInicial?Utils::fechaMes($fechaInicial):""?> <?=$fechaFinal?Utils::fechaMes($fechaFinal):""?> <br>
<?
if( isset($usuario) && $usuario ){
	echo "Vendedor: ".$usuario->getCaNombre();
}
if( isset($sucursal) && $sucursal ){
	echo " Sucursal: ".$sucursal;
}

if( $est ){
    if( $est=="SIN"){
        echo "Sin seguimientos";
    }else{
        echo " Estado: ".$estados[$est];
    }
}

?>
</h3>
Datos basados en <?=count($cotizaciones)?> cotizaciones 
<br />
<br />
<table width="80%" border="1" class="tableList">
				<tr>
                    <th scope="col">No Cotizacion</th>		
					<th scope="col">Fecha</th>					
                    <th scope="col">Usuario</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Origen</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Fecha Ultimo Seguimiento</th>
                    <th scope="col">Ultimo Seguimiento</th>
                    <th scope="col">Etapa</th>
				</tr>
				<?
				$total = 0;
				$total2 = 0;
				
				foreach( $cotizaciones as $cot ){   
                    //if( $cot["ca_consecutivo"]=="9970-2011"){
                        
                    $prods = $cot["CotProducto"];
                    $c = count( $prods );
                    
                    //Debido a que la etapa esta en la tabla cotizaciones y producto, a veces la consulta muestra 
                    //registros con la etapa incorrecta.
                    if( $c>0 && $est && $est!="SIN"){  
                        $flag = false;
                        foreach( $prods as $prod ){
                            if( $prod["ca_etapa"]==$est ){                                
                                $flag=true;
                            }                            
                        }
                        if( !$flag ){                            
                            continue;
                        }
                    }
                    
                    $fchSeg = null;
                    $lastSeg = null;
                    $etapaSeg = null;
                    if( $c==0 ){
                        $seg = $cot["CotSeguimiento"];
                        if( count($seg)>0 ){
                            $fchSeg = $seg[0]["ca_fchseguimiento"];
                            $lastSeg = $seg[0]["ca_seguimiento"];                            
                        }
                    }
				?>
				<tr class="row0">
                    <td><?=link_to($cot["ca_consecutivo"]."-V".$cot["ca_version"], "cotseguimientos/verSeguimiento?idcotizacion=".$cot["ca_idcotizacion"], array("target"=>"_blank"))?></td>
					<td><?=Utils::fechaMes($cot["ca_fchcreado"])?></td>                    
					<td><?=$cot["Usuario"]["ca_nombre"]?></td>
                    <td><?=$cot["Usuario"]["Sucursal"]["ca_nombre"]?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?=$fchSeg?Utils::fechaMes( $fchSeg ):"&nbsp;"?></td>
                    <td><?=$lastSeg?$lastSeg:"&nbsp;"?></td>
                    <td><?=$cot["ca_etapa"]&&$c==0?$estados[$cot["ca_etapa"]]:"&nbsp;"?></td>					
				</tr>                
                    <?
                     
                     
                    foreach( $prods as $prod ){
                        $fchSeg = null;
                        $lastSeg = null;                        
                        
                        $seg = $prod["CotSeguimiento"];
                        
                        if( count($seg)>0 ){                           
                            $fchSeg = $seg[0]["ca_fchseguimiento"];
                            $lastSeg = $seg[0]["ca_seguimiento"];                                
                        }
                        
                        
                    ?>
                    <tr >
                        <td colspan="4">                            
                            &nbsp;</td>
                        <td ><?=$prod["Origen"]["ca_ciudad"]?></td>
                        <td ><?=$prod["Destino"]["ca_ciudad"]?></td>
                        <td><?=$fchSeg?Utils::fechaMes( $fchSeg ):"&nbsp;"?></td>
                        <td><?=$lastSeg?$lastSeg:"&nbsp;"?></td>
                        <td><?=$prod["ca_etapa"]?$estados[$prod["ca_etapa"]]:"&nbsp;"?></td>							
                    </tr>     
                    <?
                    
                    }
				}
				?>				
			</table>


</div>
